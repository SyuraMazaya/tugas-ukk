<?php

namespace App\Services;

use App\Models\Alat;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanService
{
    public function __construct(
        protected AlatService $alatService,
        protected LogAktivitasService $logService
    ) {}

    /**
     * Get all peminjaman with optional filtering.
     */
    public function getAll(?string $status = null, ?int $userId = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = Peminjaman::with(['user', 'petugas', 'detailPeminjaman.alat']);

        if ($status) {
            $query->where('status', $status);
        }

        if ($userId) {
            $query->where('user_id', $userId);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Get peminjaman for current user.
     */
    public function getByUser(User $user, int $perPage = 10): LengthAwarePaginator
    {
        return Peminjaman::with(['detailPeminjaman.alat', 'pengembalian'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get peminjaman for current user with status filter.
     */
    public function getByUserWithFilter(User $user, ?string $status = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = Peminjaman::with(['detailPeminjaman.alat', 'pengembalian'])
            ->where('user_id', $user->id);

        if ($status) {
            $query->where('status', $status);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Get pending peminjaman.
     */
    public function getPending(int $perPage = 10): LengthAwarePaginator
    {
        return $this->getAll('pending', null, $perPage);
    }

    /**
     * Get active peminjaman (disetujui).
     */
    public function getActive(int $perPage = 10): LengthAwarePaginator
    {
        return $this->getAll('disetujui', null, $perPage);
    }

    /**
     * Find peminjaman by ID.
     */
    public function findById(int $id): ?Peminjaman
    {
        return Peminjaman::with(['user', 'petugas', 'detailPeminjaman.alat', 'pengembalian'])
            ->find($id);
    }

    /**
     * Create new peminjaman.
     * 
     * @param array $data ['tanggal_pinjam', 'tanggal_kembali_rencana', 'catatan']
     * @param array $items [['alat_id' => int, 'jumlah' => int], ...]
     * @throws \Exception
     */
    public function create(array $data, array $items): Peminjaman
    {
        return DB::transaction(function () use ($data, $items) {
            // Validate stock availability for all items
            foreach ($items as $item) {
                if (!$this->alatService->isStokTersedia($item['alat_id'], $item['jumlah'])) {
                    $alat = Alat::find($item['alat_id']);
                    throw new \Exception("Stok {$alat->nama_alat} tidak mencukupi. Tersedia: {$alat->stok}");
                }
            }

            // Create peminjaman
            $peminjaman = Peminjaman::create([
                'user_id' => Auth::id(),
                'tanggal_pinjam' => $data['tanggal_pinjam'],
                'tanggal_kembali_rencana' => $data['tanggal_kembali_rencana'],
                'catatan' => $data['catatan'] ?? null,
                'status' => 'pending',
            ]);

            // Create detail peminjaman
            foreach ($items as $item) {
                DetailPeminjaman::create([
                    'peminjaman_id' => $peminjaman->id_peminjaman,
                    'alat_id' => $item['alat_id'],
                    'jumlah' => $item['jumlah'],
                ]);
            }

            $this->logService->log('Mengajukan peminjaman', [
                'peminjaman_id' => $peminjaman->id_peminjaman,
                'tanggal_pinjam' => $data['tanggal_pinjam'],
                'tanggal_kembali_rencana' => $data['tanggal_kembali_rencana'],
                'items' => $items,
            ]);

            return $peminjaman->load('detailPeminjaman.alat');
        });
    }

    /**
     * Approve peminjaman.
     * 
     * @throws \Exception
     */
    public function approve(Peminjaman $peminjaman, User $petugas): Peminjaman
    {
        if (!$peminjaman->isPending()) {
            throw new \Exception('Peminjaman tidak dapat disetujui. Status saat ini: ' . $peminjaman->status_label);
        }

        return DB::transaction(function () use ($peminjaman, $petugas) {
            // Validate stock availability again
            foreach ($peminjaman->detailPeminjaman as $detail) {
                if (!$this->alatService->isStokTersedia($detail->alat_id, $detail->jumlah)) {
                    throw new \Exception("Stok {$detail->alat->nama_alat} tidak mencukupi.");
                }
            }

            // Reduce stock for each item
            foreach ($peminjaman->detailPeminjaman as $detail) {
                $this->alatService->kurangiStok($detail->alat_id, $detail->jumlah);
            }

            // Update peminjaman status
            $peminjaman->update([
                'status' => 'disetujui',
                'petugas_id' => $petugas->id,
            ]);

            $this->logService->log('Menyetujui peminjaman', [
                'peminjaman_id' => $peminjaman->id_peminjaman,
                'peminjam' => $peminjaman->user->name,
            ], $petugas);

            return $peminjaman->fresh(['user', 'petugas', 'detailPeminjaman.alat']);
        });
    }

    /**
     * Reject peminjaman.
     */
    public function reject(Peminjaman $peminjaman, User $petugas, ?string $catatan = null): Peminjaman
    {
        if (!$peminjaman->isPending()) {
            throw new \Exception('Peminjaman tidak dapat ditolak. Status saat ini: ' . $peminjaman->status_label);
        }

        $peminjaman->update([
            'status' => 'ditolak',
            'petugas_id' => $petugas->id,
            'catatan' => $catatan ?? $peminjaman->catatan,
        ]);

        $this->logService->log('Menolak peminjaman', [
            'peminjaman_id' => $peminjaman->id_peminjaman,
            'peminjam' => $peminjaman->user->name,
            'catatan' => $catatan,
        ], $petugas);

        return $peminjaman->fresh(['user', 'petugas', 'detailPeminjaman.alat']);
    }

    /**
     * Cancel peminjaman (by user).
     */
    public function cancel(Peminjaman $peminjaman): Peminjaman
    {
        if (!$peminjaman->isPending()) {
            throw new \Exception('Peminjaman tidak dapat dibatalkan. Status saat ini: ' . $peminjaman->status_label);
        }

        $peminjaman->update(['status' => 'batal']);

        $this->logService->log('Membatalkan peminjaman', [
            'peminjaman_id' => $peminjaman->id_peminjaman,
        ]);

        return $peminjaman->fresh();
    }

    /**
     * Get dashboard statistics.
     */
    public function getStatistics(): array
    {
        return [
            'pending' => Peminjaman::where('status', 'pending')->count(),
            'disetujui' => Peminjaman::where('status', 'disetujui')->count(),
            'selesai' => Peminjaman::where('status', 'selesai')->count(),
            'total' => Peminjaman::count(),
        ];
    }

    /**
     * Get user statistics.
     */
    public function getUserStatistics(User $user): array
    {
        $totalDenda = Peminjaman::where('user_id', $user->id)
            ->where('status', 'selesai')
            ->whereHas('pengembalian')
            ->with('pengembalian')
            ->get()
            ->sum(fn($p) => $p->pengembalian->denda ?? 0);

        return [
            'pending' => Peminjaman::where('user_id', $user->id)->where('status', 'pending')->count(),
            'disetujui' => Peminjaman::where('user_id', $user->id)->where('status', 'disetujui')->count(),
            'selesai' => Peminjaman::where('user_id', $user->id)->where('status', 'selesai')->count(),
            'total' => Peminjaman::where('user_id', $user->id)->count(),
            'total_denda' => $totalDenda,
        ];
    }

    /**
     * Get active peminjaman for user.
     */
    public function getActivePeminjamanByUser(User $user, int $limit = 5): Collection
    {
        return Peminjaman::with(['detailPeminjaman.alat', 'pengembalian'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['pending', 'disetujui'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
