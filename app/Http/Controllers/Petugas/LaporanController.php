<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Services\PeminjamanService;
use App\Services\PengembalianService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function __construct(
        protected PeminjamanService $peminjamanService,
        protected PengembalianService $pengembalianService
    ) {}

    /**
     * Show laporan page.
     */
    public function index(): View
    {
        $peminjamanStats = $this->peminjamanService->getStatistics();
        $pengembalianStats = $this->pengembalianService->getStatistics();

        return view('petugas.laporan.index', compact('peminjamanStats', 'pengembalianStats'));
    }

    /**
     * Show peminjaman report.
     */
    public function peminjaman(Request $request): View
    {
        $status = $request->get('status');
        $peminjamans = $this->peminjamanService->getAll($status, null, 20);

        return view('petugas.laporan.peminjaman', compact('peminjamans', 'status'));
    }

    /**
     * Show pengembalian report.
     */
    public function pengembalian(): View
    {
        $pengembalians = $this->pengembalianService->getAll(20);

        return view('petugas.laporan.pengembalian', compact('pengembalians'));
    }

    /**
     * Print peminjaman report.
     */
    public function printPeminjaman(Request $request): View
    {
        $status = $request->get('status');
        $peminjamans = $this->peminjamanService->getAll($status, null, 100);

        return view('petugas.laporan.print-peminjaman', compact('peminjamans', 'status'));
    }

    /**
     * Print pengembalian report.
     */
    public function printPengembalian(): View
    {
        $pengembalians = $this->pengembalianService->getAll(100);

        return view('petugas.laporan.print-pengembalian', compact('pengembalians'));
    }
}
