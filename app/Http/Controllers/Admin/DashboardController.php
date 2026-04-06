<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use App\Services\AlatService;
use App\Services\PeminjamanService;
use App\Services\UserService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected PeminjamanService $peminjamanService,
        protected AlatService $alatService,
        protected UserService $userService
    ) {}

    /**
     * Show admin dashboard.
     */
    public function index(): View
    {
        $statistics = $this->peminjamanService->getStatistics();
        $recentLogs = LogAktivitas::with('user')
            ->latest()
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact('statistics', 'recentLogs'));
    }
}
