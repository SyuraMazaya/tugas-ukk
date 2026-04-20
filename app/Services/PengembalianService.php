<?php

namespace App\Services;

use App\Models\Denda;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengembalianService
{
    // Denda per hari keterlambatan default (dalam rupiah)
    public const DENDA_PER_HARI = 1000;

    public const STATUS_MENUNGGU_APPROVAL = 'menunggu_approval';

    public const STATUS_MENUNGGU_PEMBAYARAN = 'menunggu_pembayaran';

    public const STATUS_MENUNGGU_VERIFIKASI = 'menunggu_verifikasi_pembayaran';

    public const STATUS_SELESAI = 'selesai';

    public function __construct(
        protected AlatService $alatService,
        protected LogAktivitasService $logService
    ) {}

    /**
     * Get all pengembalian with pagination.
     */
    public function getAll(int $perPage = 10, ?string $status = null): LengthAwarePaginator
    {
        $query = Pengembalian::with([
            'peminjaman.user',
            'peminjaman.detailPeminjaman.alat',
            'petugas',
            'verifikator',
        ]);

        if ($status) {
            $query->where('status', $status);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Find pengembalian by ID.
     */
    public function findById(int $id): ?Pengembalian
    {
        return Pengembalian::with([
            'peminjaman.user',
            'peminjaman.detailPeminjaman.alat',
            'petugas',
            'verifikator',
        ])
            ->find($id);
    }

    /**
     * Calculate late fee.
     */
    public function hitungDenda(Carbon $tanggalRencana, Carbon $tanggalKembali): float
    {
        if ($tanggalKembali->lte($tanggalRencana)) {
            return 0;
        }

        // Get active denda from database, fallback to constant if not found
        $dendaAktif = Denda::where('is_active', true)->first();
        $dendaPerHari = $dendaAktif ? $dendaAktif->jumlah_denda : self::DENDA_PER_HARI;

        // Calculate days late (ensure positive value)
        $selisihHari = $tanggalRencana->diffInDays($tanggalKembali);

        return abs($selisihHari * $dendaPerHari);
    }

    /**
     * Peminjam submits return request.
     *
     * @throws \Exception
     */
    public function ajukanOlehPeminjam(
        Peminjaman $peminjaman,
        User $peminjam,
        Carbon $tanggalKembali,
        ?string $catatanPeminjam = null
    ): Pengembalian {
        if ($peminjaman->user_id !== $peminjam->id) {
            throw new \Exception('Anda tidak memiliki akses untuk mengajukan pengembalian ini.');
        }

        if (! $peminjaman->canBeReturned()) {
            throw new \Exception('Peminjaman belum bisa diajukan pengembalian.');
        }

        return DB::transaction(function () use ($peminjaman, $peminjam, $tanggalKembali, $catatanPeminjam) {
            $estimasiDenda = $this->hitungDenda(
                $peminjaman->tanggal_kembali_rencana,
                $tanggalKembali
            );

            $pengembalian = Pengembalian::create([
                'peminjaman_id' => $peminjaman->id_peminjaman,
                'tanggal_kembali_real' => $tanggalKembali,
                'denda' => $estimasiDenda,
                'denda_lunas' => false,
                'status' => self::STATUS_MENUNGGU_APPROVAL,
                'catatan_peminjam' => $catatanPeminjam,
                'petugas_id' => null,
            ]);

            $this->logService->log('Mengajukan pengembalian', [
                'pengembalian_id' => $pengembalian->id,
                'peminjaman_id' => $peminjaman->id_peminjaman,
                'tanggal_kembali' => $tanggalKembali->toDateString(),
                'estimasi_denda' => $estimasiDenda,
            ], $peminjam);

            return $pengembalian->load([
                'peminjaman.user',
                'peminjaman.detailPeminjaman.alat',
                'petugas',
                'verifikator',
            ]);
        });
    }

    /**
     * Petugas approves return condition and decides next state.
     *
     * @throws \Exception
     */
    public function approvePengembalian(
        Pengembalian $pengembalian,
        User $petugas,
        string $statusApproval,
        ?string $catatanKondisi = null,
        ?string $catatanApproval = null,
        ?float $customDenda = null,
        ?array $kondisiAlat = null
    ): Pengembalian {
        if (! $pengembalian->isMenungguApproval()) {
            throw new \Exception('Pengembalian ini tidak berada pada status menunggu approval.');
        }

        if (! in_array($statusApproval, [self::STATUS_SELESAI, self::STATUS_MENUNGGU_PEMBAYARAN], true)) {
            throw new \Exception('Status approval tidak valid.');
        }

        return DB::transaction(function () use ($pengembalian, $petugas, $statusApproval, $catatanKondisi, $catatanApproval, $customDenda, $kondisiAlat) {
            $pengembalian->loadMissing(['peminjaman.detailPeminjaman.alat', 'peminjaman.user']);

            $denda = $customDenda;
            if ($denda === null) {
                $denda = $this->hitungDenda(
                    $pengembalian->peminjaman->tanggal_kembali_rencana,
                    Carbon::parse($pengembalian->tanggal_kembali_real)
                );
            }

            if ($statusApproval === self::STATUS_SELESAI) {
                $denda = 0;
            }

            if ($statusApproval === self::STATUS_MENUNGGU_PEMBAYARAN && $denda <= 0) {
                throw new \Exception('Status menunggu pembayaran membutuhkan nominal denda lebih dari 0.');
            }

            foreach ($pengembalian->peminjaman->detailPeminjaman as $detail) {
                $this->alatService->tambahStok($detail->alat_id, $detail->jumlah);

                if ($kondisiAlat && isset($kondisiAlat[$detail->alat_id])) {
                    $this->alatService->updateKondisi($detail->alat_id, $kondisiAlat[$detail->alat_id]);
                }
            }

            $updateData = [
                'petugas_id' => $petugas->id,
                'catatan_kondisi' => $catatanKondisi,
                'catatan_approval' => $catatanApproval,
                'denda' => $denda,
                'status' => $statusApproval,
                'denda_lunas' => $statusApproval === self::STATUS_SELESAI,
            ];

            if ($statusApproval === self::STATUS_SELESAI) {
                $updateData['diverifikasi_oleh'] = $petugas->id;
                $updateData['tanggal_verifikasi'] = Carbon::now();
            }

            $pengembalian->update($updateData);

            if ($statusApproval === self::STATUS_SELESAI) {
                $pengembalian->peminjaman->update(['status' => 'selesai']);
            }

            $this->logService->log('Approval pengembalian', [
                'pengembalian_id' => $pengembalian->id,
                'peminjaman_id' => $pengembalian->peminjaman_id,
                'status' => $statusApproval,
                'denda' => $denda,
                'peminjam' => $pengembalian->peminjaman->user->name,
            ], $petugas);

            return $pengembalian->fresh([
                'peminjaman.user',
                'peminjaman.detailPeminjaman.alat',
                'petugas',
                'verifikator',
            ]);
        });
    }

    /**
     * Peminjam submits payment for outstanding denda.
     *
     * @throws \Exception
     */
    public function submitPembayaran(
        Pengembalian $pengembalian,
        User $peminjam,
        string $metodePembayaran,
        ?UploadedFile $buktiPembayaran = null
    ): Pengembalian {
        if (! $pengembalian->isMenungguPembayaran()) {
            throw new \Exception('Pengembalian ini belum masuk tahap pembayaran denda.');
        }

        if ($pengembalian->peminjaman->user_id !== $peminjam->id) {
            throw new \Exception('Anda tidak memiliki akses untuk mengirim pembayaran denda ini.');
        }

        if (! in_array($metodePembayaran, ['tunai', 'qris'], true)) {
            throw new \Exception('Metode pembayaran tidak valid.');
        }

        if ($metodePembayaran === 'qris' && $buktiPembayaran === null) {
            throw new \Exception('Bukti pembayaran QRIS wajib dilampirkan.');
        }

        return DB::transaction(function () use ($pengembalian, $peminjam, $metodePembayaran, $buktiPembayaran) {
            $buktiPath = null;

            if ($pengembalian->bukti_pembayaran) {
                Storage::disk('public')->delete($pengembalian->bukti_pembayaran);
            }

            if ($metodePembayaran === 'qris' && $buktiPembayaran !== null) {
                $buktiPath = $buktiPembayaran->store('bukti-pembayaran', 'public');
            }

            $pengembalian->update([
                'status' => self::STATUS_MENUNGGU_VERIFIKASI,
                'metode_pembayaran' => $metodePembayaran,
                'bukti_pembayaran' => $buktiPath,
                'tanggal_pembayaran' => Carbon::now(),
                'denda_lunas' => false,
                'diverifikasi_oleh' => null,
                'tanggal_verifikasi' => null,
            ]);

            $this->logService->log('Mengirim pembayaran denda', [
                'pengembalian_id' => $pengembalian->id,
                'peminjaman_id' => $pengembalian->peminjaman_id,
                'metode' => $metodePembayaran,
                'nominal' => $pengembalian->denda,
            ], $peminjam);

            return $pengembalian->fresh([
                'peminjaman.user',
                'peminjaman.detailPeminjaman.alat',
                'petugas',
                'verifikator',
            ]);
        });
    }

    /**
     * Petugas verifies payment submission.
     *
     * @throws \Exception
     */
    public function verifikasiPembayaran(
        Pengembalian $pengembalian,
        User $petugas,
        bool $isDisetujui,
        ?string $catatanApproval = null
    ): Pengembalian {
        if (! $pengembalian->isMenungguVerifikasiPembayaran()) {
            throw new \Exception('Pengembalian ini tidak berada pada status verifikasi pembayaran.');
        }

        return DB::transaction(function () use ($pengembalian, $petugas, $isDisetujui, $catatanApproval) {
            $pengembalian->loadMissing('peminjaman.user');

            if ($isDisetujui) {
                $pengembalian->update([
                    'status' => self::STATUS_SELESAI,
                    'denda_lunas' => true,
                    'catatan_approval' => $catatanApproval,
                    'diverifikasi_oleh' => $petugas->id,
                    'tanggal_verifikasi' => Carbon::now(),
                    'petugas_id' => $pengembalian->petugas_id ?? $petugas->id,
                ]);

                $pengembalian->peminjaman->update(['status' => 'selesai']);

                $this->logService->log('Menyetujui pembayaran denda', [
                    'pengembalian_id' => $pengembalian->id,
                    'peminjaman_id' => $pengembalian->peminjaman_id,
                    'nominal' => $pengembalian->denda,
                    'peminjam' => $pengembalian->peminjaman->user->name,
                ], $petugas);
            } else {
                $pengembalian->update([
                    'status' => self::STATUS_MENUNGGU_PEMBAYARAN,
                    'denda_lunas' => false,
                    'catatan_approval' => $catatanApproval,
                    'diverifikasi_oleh' => $petugas->id,
                    'tanggal_verifikasi' => Carbon::now(),
                    'petugas_id' => $pengembalian->petugas_id ?? $petugas->id,
                ]);

                $this->logService->log('Menolak verifikasi pembayaran denda', [
                    'pengembalian_id' => $pengembalian->id,
                    'peminjaman_id' => $pengembalian->peminjaman_id,
                    'catatan' => $catatanApproval,
                    'peminjam' => $pengembalian->peminjaman->user->name,
                ], $petugas);
            }

            return $pengembalian->fresh([
                'peminjaman.user',
                'peminjaman.detailPeminjaman.alat',
                'petugas',
                'verifikator',
            ]);
        });
    }

    /**
     * Process pengembalian.
     *
     * @throws \Exception
     */
    public function proses(
        Peminjaman $peminjaman,
        User $petugas,
        Carbon $tanggalKembali,
        ?string $catatanKondisi = null,
        ?float $customDenda = null,
        ?array $kondisiAlat = null
    ): Pengembalian {
        if (! $peminjaman->canBeReturned()) {
            throw new \Exception('Peminjaman tidak dapat dikembalikan. Status saat ini: '.$peminjaman->status_label);
        }

        return DB::transaction(function () use ($peminjaman, $petugas, $tanggalKembali, $catatanKondisi, $customDenda, $kondisiAlat) {
            // Use custom denda if provided, otherwise calculate
            if ($customDenda !== null) {
                $denda = $customDenda;
            } else {
                $denda = $this->hitungDenda(
                    $peminjaman->tanggal_kembali_rencana,
                    $tanggalKembali
                );
            }

            // Return stock for each item and update kondisi if specified
            foreach ($peminjaman->detailPeminjaman as $detail) {
                $this->alatService->tambahStok($detail->alat_id, $detail->jumlah);

                // Update kondisi alat if specified
                if ($kondisiAlat && isset($kondisiAlat[$detail->alat_id])) {
                    $this->alatService->updateKondisi($detail->alat_id, $kondisiAlat[$detail->alat_id]);
                }
            }

            // Create pengembalian record
            $pengembalian = Pengembalian::create([
                'peminjaman_id' => $peminjaman->id_peminjaman,
                'tanggal_kembali_real' => $tanggalKembali,
                'denda' => $denda,
                'denda_lunas' => true,
                'status' => self::STATUS_SELESAI,
                'catatan_kondisi' => $catatanKondisi,
                'petugas_id' => $petugas->id,
                'diverifikasi_oleh' => $petugas->id,
                'tanggal_verifikasi' => Carbon::now(),
            ]);

            // Update peminjaman status
            $peminjaman->update(['status' => 'selesai']);

            $this->logService->log('Memproses pengembalian', [
                'pengembalian_id' => $pengembalian->id,
                'peminjaman_id' => $peminjaman->id_peminjaman,
                'peminjam' => $peminjaman->user->name,
                'tanggal_kembali' => $tanggalKembali->toDateString(),
                'denda' => $denda,
            ], $petugas);

            return $pengembalian->load(['peminjaman.user', 'peminjaman.detailPeminjaman.alat', 'petugas']);
        });
    }

    /**
     * Get overdue peminjaman.
     */
    public function getOverdue(): LengthAwarePaginator
    {
        return Peminjaman::with(['user', 'detailPeminjaman.alat'])
            ->where('status', 'disetujui')
            ->where('tanggal_kembali_rencana', '<', Carbon::today())
            ->whereDoesntHave('pengembalian')
            ->orderBy('tanggal_kembali_rencana', 'asc')
            ->paginate(10);
    }

    /**
     * Get pengembalian statistics.
     */
    public function getStatistics(): array
    {
        $today = Carbon::today();

        return [
            'total_pengembalian' => Pengembalian::count(),
            'total_denda' => Pengembalian::sum('denda'),
            'menunggu_approval' => Pengembalian::where('status', self::STATUS_MENUNGGU_APPROVAL)->count(),
            'menunggu_pembayaran' => Pengembalian::where('status', self::STATUS_MENUNGGU_PEMBAYARAN)->count(),
            'menunggu_verifikasi_pembayaran' => Pengembalian::where('status', self::STATUS_MENUNGGU_VERIFIKASI)->count(),
            'denda_belum_lunas' => Pengembalian::where('denda_lunas', false)->sum('denda'),
            'pengembalian_bulan_ini' => Pengembalian::whereMonth('created_at', $today->month)
                ->whereYear('created_at', $today->year)
                ->count(),
            'denda_bulan_ini' => Pengembalian::whereMonth('created_at', $today->month)
                ->whereYear('created_at', $today->year)
                ->sum('denda'),
        ];
    }
}
