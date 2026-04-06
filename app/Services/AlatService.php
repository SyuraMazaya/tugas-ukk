<?php

namespace App\Services;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class AlatService
{
    public function __construct(
        protected LogAktivitasService $logService
    ) {}

    /**
     * Get all alat with optional filtering.
     */
    public function getAll(?int $kategoriId = null, ?string $kondisi = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = Alat::with('kategori');

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        if ($kondisi) {
            $query->where('kondisi', $kondisi);
        }

        return $query->orderBy('nama_alat')->paginate($perPage);
    }

    /**
     * Get alat for katalog (with stock available).
     */
    public function getKatalog(?int $kategoriId = null, int $perPage = 12): LengthAwarePaginator
    {
        $query = Alat::with('kategori')
            ->where('stok', '>', 0)
            ->where('kondisi', 'baik');

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        return $query->orderBy('nama_alat')->paginate($perPage);
    }

    /**
     * Get alat for katalog with search.
     */
    public function getKatalogWithSearch(?string $search = null, ?int $kategoriId = null, int $perPage = 12): LengthAwarePaginator
    {
        $query = Alat::with('kategori')
            ->where('stok', '>', 0)
            ->where('kondisi', 'baik');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_alat', 'like', "%{$search}%")
                  ->orWhere('kode_alat', 'like', "%{$search}%");
            });
        }

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        return $query->orderBy('nama_alat')->paginate($perPage);
    }

    /**
     * Find alat by ID.
     */
    public function findById(int $id): ?Alat
    {
        return Alat::with('kategori')->find($id);
    }

    /**
     * Create new alat.
     */
    public function create(array $data, ?UploadedFile $gambar = null): Alat
    {
        if ($gambar) {
            $data['gambar'] = $this->uploadGambar($gambar);
        }

        $alat = Alat::create($data);

        $this->logService->log('Membuat alat baru', [
            'alat_id' => $alat->id_alat,
            'nama_alat' => $alat->nama_alat,
            'kode_alat' => $alat->kode_alat,
        ]);

        return $alat;
    }

    /**
     * Update alat.
     */
    public function update(Alat $alat, array $data, ?UploadedFile $gambar = null): Alat
    {
        $oldData = $alat->toArray();

        if ($gambar) {
            // Delete old image if exists
            if ($alat->gambar) {
                $this->deleteGambar($alat->gambar);
            }
            $data['gambar'] = $this->uploadGambar($gambar);
        }

        $alat->update($data);

        $this->logService->log('Mengupdate alat', [
            'alat_id' => $alat->id_alat,
            'before' => $oldData,
            'after' => $alat->fresh()->toArray(),
        ]);

        return $alat->fresh();
    }

    /**
     * Delete alat.
     */
    public function delete(Alat $alat): bool
    {
        // Check if alat has active peminjaman
        $activePeminjaman = $alat->detailPeminjaman()
            ->whereHas('peminjaman', function ($q) {
                $q->whereIn('status', ['pending', 'disetujui']);
            })
            ->exists();

        if ($activePeminjaman) {
            throw new \Exception('Alat tidak dapat dihapus karena masih ada peminjaman aktif.');
        }

        if ($alat->gambar) {
            $this->deleteGambar($alat->gambar);
        }

        $this->logService->log('Menghapus alat', [
            'alat_id' => $alat->id_alat,
            'nama_alat' => $alat->nama_alat,
            'kode_alat' => $alat->kode_alat,
        ]);

        return $alat->delete();
    }

    /**
     * Upload gambar.
     */
    protected function uploadGambar(UploadedFile $file): string
    {
        return $file->store('alat', 'public');
    }

    /**
     * Delete gambar.
     */
    protected function deleteGambar(string $path): bool
    {
        return Storage::disk('public')->delete($path);
    }

    /**
     * Check stock availability.
     */
    public function isStokTersedia(int $alatId, int $jumlah): bool
    {
        $alat = $this->findById($alatId);
        return $alat && $alat->stok >= $jumlah;
    }

    /**
     * Reduce stock.
     */
    public function kurangiStok(int $alatId, int $jumlah): void
    {
        $alat = Alat::find($alatId);
        $alat->decrement('stok', $jumlah);
    }

    /**
     * Add stock.
     */
    public function tambahStok(int $alatId, int $jumlah): void
    {
        $alat = Alat::find($alatId);
        $alat->increment('stok', $jumlah);
    }

    /**
     * Update kondisi alat.
     */
    public function updateKondisi(int $alatId, string $kondisi): void
    {
        $alat = Alat::find($alatId);
        if ($alat && in_array($kondisi, ['baik', 'rusak_ringan', 'rusak'])) {
            $oldKondisi = $alat->kondisi;
            $alat->update(['kondisi' => $kondisi]);
            
            if ($oldKondisi !== $kondisi) {
                $this->logService->log('Mengubah kondisi alat', [
                    'alat_id' => $alat->id_alat,
                    'nama_alat' => $alat->nama_alat,
                    'kondisi_lama' => $oldKondisi,
                    'kondisi_baru' => $kondisi,
                ]);
            }
        }
    }
}
