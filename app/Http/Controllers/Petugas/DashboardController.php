<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Services\PeminjamanService;
use App\Services\PengembalianService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected PeminjamanService $peminjamanService,
        protected PengembalianService $pengembalianService
    ) {}

    /**
     * Show petugas dashboard.
     */
    public function index(): View
    {
        $statistics = $this->peminjamanService->getStatistics();
        $pendingList = $this->peminjamanService->getPending(5);
        $activeList = $this->peminjamanService->getActive(5);
        $overdueList = $this->pengembalianService->getOverdue();

        return view('petugas.dashboard', compact('statistics', 'pendingList', 'activeList', 'overdueList'));
    }
}
