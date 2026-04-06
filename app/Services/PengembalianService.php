<?php

namespace App\Services;

use App\Models\Denda;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PengembalianService
{
    // Denda per hari keterlambatan default (dalam rupiah)
    public const DENDA_PER_HARI = 1000;

    public function __construct(
        protected AlatService $alatService,
        protected LogAktivitasService $logService
    ) {}

    /**
     * Get all pengembalian with pagination.
     */
    public function getAll(int $perPage = 10): LengthAwarePaginator
    {
        return Pengembalian::with(['peminjaman.user', 'peminjaman.detailPeminjaman.alat', 'petugas'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Find pengembalian by ID.
     */
    public function findById(int $id): ?Pengembalian
    {
        return Pengembalian::with(['peminjaman.user', 'peminjaman.detailPeminjaman.alat', 'petugas'])
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
        if (!$peminjaman->canBeReturned()) {
            throw new \Exception('Peminjaman tidak dapat dikembalikan. Status saat ini: ' . $peminjaman->status_label);
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
                'catatan_kondisi' => $catatanKondisi,
                'petugas_id' => $petugas->id,
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
            'pengembalian_bulan_ini' => Pengembalian::whereMonth('created_at', $today->month)
                ->whereYear('created_at', $today->year)
                ->count(),
            'denda_bulan_ini' => Pengembalian::whereMonth('created_at', $today->month)
                ->whereYear('created_at', $today->year)
                ->sum('denda'),
        ];
    }
}
