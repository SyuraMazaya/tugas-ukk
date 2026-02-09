<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        
        return view('admin.dashboard', compact('statistics'));
    }
}
