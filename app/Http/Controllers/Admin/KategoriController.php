<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Services\KategoriService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function __construct(
        protected KategoriService $kategoriService
    ) {}

    /**
     * Display a listing of kategori.
     */
    public function index(): View
    {
        $kategoris = $this->kategoriService->getAllPaginated();

        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new kategori.
     */
    public function create(): View
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created kategori.
     */
    public function store(StoreKategoriRequest $request): RedirectResponse
    {
        $this->kategoriService->create($request->validated());

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified kategori.
     */
    public function edit(int $id): View
    {
        $kategori = $this->kategoriService->findById($id);

        if (!$kategori) {
            abort(404);
        }

        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified kategori.
     */
    public function update(UpdateKategoriRequest $request, int $id): RedirectResponse
    {
        $kategori = $this->kategoriService->findById($id);

        if (!$kategori) {
            abort(404);
        }

        $this->kategoriService->update($kategori, $request->validated());

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified kategori.
     */
    public function destroy(int $id): RedirectResponse
    {
        $kategori = $this->kategoriService->findById($id);

        if (!$kategori) {
            abort(404);
        }

        try {
            $this->kategoriService->delete($kategori);
            return redirect()
                ->route('admin.kategori.index')
                ->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.kategori.index')
                ->with('error', $e->getMessage());
        }
    }
}
