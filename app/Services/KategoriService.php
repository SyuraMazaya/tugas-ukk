<?php

namespace App\Services;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class KategoriService
{
    public function __construct(
        protected LogAktivitasService $logService
    ) {}

    /**
     * Get all kategori.
     */
    public function getAll(): Collection
    {
        return Kategori::orderBy('nama_kategori')->get();
    }

    /**
     * Get all kategori with pagination.
     */
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Kategori::withCount('alat')
            ->orderBy('nama_kategori')
            ->paginate($perPage);
    }

    /**
     * Find kategori by ID.
     */
    public function findById(int $id): ?Kategori
    {
        return Kategori::find($id);
    }

    /**
     * Create new kategori.
     */
    public function create(array $data): Kategori
    {
        $kategori = Kategori::create($data);

        $this->logService->log('Membuat kategori baru', [
            'kategori_id' => $kategori->id_kategori,
            'nama_kategori' => $kategori->nama_kategori,
        ]);

        return $kategori;
    }

    /**
     * Update kategori.
     */
    public function update(Kategori $kategori, array $data): Kategori
    {
        $oldData = $kategori->toArray();

        $kategori->update($data);

        $this->logService->log('Mengupdate kategori', [
            'kategori_id' => $kategori->id_kategori,
            'before' => $oldData,
            'after' => $kategori->fresh()->toArray(),
        ]);

        return $kategori->fresh();
    }

    /**
     * Delete kategori.
     */
    public function delete(Kategori $kategori): bool
    {
        // Check if kategori has alat
        if ($kategori->alat()->exists()) {
            throw new \Exception('Kategori tidak dapat dihapus karena masih memiliki alat.');
        }

        $this->logService->log('Menghapus kategori', [
            'kategori_id' => $kategori->id_kategori,
            'nama_kategori' => $kategori->nama_kategori,
        ]);

        return $kategori->delete();
    }
}
