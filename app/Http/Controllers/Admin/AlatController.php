<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlatRequest;
use App\Http\Requests\UpdateAlatRequest;
use App\Services\AlatService;
use App\Services\KategoriService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlatController extends Controller
{
    public function __construct(
        protected AlatService $alatService,
        protected KategoriService $kategoriService
    ) {}

    /**
     * Display a listing of alat.
     */
    public function index(Request $request): View
    {
        $kategoriId = $request->get('kategori_id');
        $kondisi = $request->get('kondisi');
        
        $alats = $this->alatService->getAll($kategoriId, $kondisi);
        $kategoris = $this->kategoriService->getAll();

        return view('admin.alat.index', compact('alats', 'kategoris', 'kategoriId', 'kondisi'));
    }

    /**
     * Show the form for creating a new alat.
     */
    public function create(): View
    {
        $kategoris = $this->kategoriService->getAll();

        return view('admin.alat.create', compact('kategoris'));
    }

    /**
     * Store a newly created alat.
     */
    public function store(StoreAlatRequest $request): RedirectResponse
    {
        $gambar = $request->hasFile('gambar') ? $request->file('gambar') : null;
        
        $this->alatService->create($request->validated(), $gambar);

        return redirect()
            ->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan.');
    }

    /**
     * Display the specified alat.
     */
    public function show(int $id): View
    {
        $alat = $this->alatService->findById($id);

        if (!$alat) {
            abort(404);
        }

        return view('admin.alat.show', compact('alat'));
    }

    /**
     * Show the form for editing the specified alat.
     */
    public function edit(int $id): View
    {
        $alat = $this->alatService->findById($id);

        if (!$alat) {
            abort(404);
        }

        $kategoris = $this->kategoriService->getAll();

        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    /**
     * Update the specified alat.
     */
    public function update(UpdateAlatRequest $request, int $id): RedirectResponse
    {
        $alat = $this->alatService->findById($id);

        if (!$alat) {
            abort(404);
        }

        $gambar = $request->hasFile('gambar') ? $request->file('gambar') : null;
        
        $this->alatService->update($alat, $request->validated(), $gambar);

        return redirect()
            ->route('admin.alat.index')
            ->with('success', 'Alat berhasil diperbarui.');
    }

    /**
     * Remove the specified alat.
     */
    public function destroy(int $id): RedirectResponse
    {
        $alat = $this->alatService->findById($id);

        if (!$alat) {
            abort(404);
        }

        try {
            $this->alatService->delete($alat);
            return redirect()
                ->route('admin.alat.index')
                ->with('success', 'Alat berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.alat.index')
                ->with('error', $e->getMessage());
        }
    }
}
