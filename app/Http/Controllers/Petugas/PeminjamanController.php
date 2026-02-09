<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Services\PeminjamanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PeminjamanController extends Controller
{
    public function __construct(
        protected PeminjamanService $peminjamanService
    ) {}

    /**
     * Display a listing of peminjaman.
     */
    public function index(Request $request): View
    {
        $status = $request->get('status');
        $peminjamans = $this->peminjamanService->getAll($status);

        return view('petugas.peminjaman.index', compact('peminjamans', 'status'));
    }

    /**
     * Display the specified peminjaman.
     */
    public function show(int $id): View
    {
        $peminjaman = $this->peminjamanService->findById($id);

        if (!$peminjaman) {
            abort(404);
        }

        return view('petugas.peminjaman.show', compact('peminjaman'));
    }

    /**
     * Approve peminjaman.
     */
    public function approve(int $id): RedirectResponse
    {
        $peminjaman = $this->peminjamanService->findById($id);

        if (!$peminjaman) {
            abort(404);
        }

        try {
            $this->peminjamanService->approve($peminjaman, Auth::user());
            return redirect()
                ->route('petugas.peminjaman.index')
                ->with('success', 'Peminjaman berhasil disetujui.');
        } catch (\Exception $e) {
            return redirect()
                ->route('petugas.peminjaman.show', $id)
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Reject peminjaman.
     */
    public function reject(Request $request, int $id): RedirectResponse
    {
        $peminjaman = $this->peminjamanService->findById($id);

        if (!$peminjaman) {
            abort(404);
        }

        try {
            $catatan = $request->input('catatan');
            $this->peminjamanService->reject($peminjaman, Auth::user(), $catatan);
            return redirect()
                ->route('petugas.peminjaman.index')
                ->with('success', 'Peminjaman berhasil ditolak.');
        } catch (\Exception $e) {
            return redirect()
                ->route('petugas.peminjaman.show', $id)
                ->with('error', $e->getMessage());
        }
    }
}
