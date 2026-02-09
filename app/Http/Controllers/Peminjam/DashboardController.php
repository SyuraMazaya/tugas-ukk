<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Services\AlatService;
use App\Services\KategoriService;
use App\Services\PeminjamanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected PeminjamanService $peminjamanService,
        protected AlatService $alatService,
        protected KategoriService $kategoriService
    ) {}

    /**
     * Show peminjam dashboard.
     */
    public function index(): View
    {
        $statistics = $this->peminjamanService->getUserStatistics(Auth::user());
        $activePeminjaman = $this->peminjamanService->getActivePeminjamanByUser(Auth::user(), 5);

        return view('peminjam.dashboard', compact('statistics', 'activePeminjaman'));
    }

    /**
     * Show katalog alat.
     */
    public function katalog(Request $request): View
    {
        $search = $request->get('search');
        $kategori = $request->get('kategori');
        $alats = $this->alatService->getKatalogWithSearch($search, $kategori);
        $kategoris = $this->kategoriService->getAll();

        return view('peminjam.katalog', compact('alats', 'kategoris', 'search', 'kategori'));
    }
}
