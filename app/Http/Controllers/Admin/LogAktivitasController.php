<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LogAktivitasService;
use Illuminate\View\View;

class LogAktivitasController extends Controller
{
    public function __construct(
        protected LogAktivitasService $logService
    ) {}

    /**
     * Display a listing of log aktivitas.
     */
    public function index(): View
    {
        $logs = $this->logService->getAllLogs(20);

        return view('admin.log-aktivitas.index', compact('logs'));
    }
}
