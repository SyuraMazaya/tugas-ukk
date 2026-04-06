<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengembalianRequest;
use App\Services\PeminjamanService;
use App\Services\PengembalianService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PengembalianController extends Controller
{
    public function __construct(
        protected PengembalianService $pengembalianService,
        protected PeminjamanService $peminjamanService
    ) {}

    /**
     * Display a listing of pengembalian.
     */
    public function index(): View
    {
        $pengembalians = $this->pengembalianService->getAll();

        return view('petugas.pengembalian.index', compact('pengembalians'));
    }

    /**
     * Show form to process pengembalian.
     */
    public function create(int $peminjamanId): View
    {
        $peminjaman = $this->peminjamanService->findById($peminjamanId);

        if (!$peminjaman || !$peminjaman->canBeReturned()) {
            abort(404);
        }

        // Calculate estimated fine
        $estimatedDenda = $this->pengembalianService->hitungDenda(
            $peminjaman->tanggal_kembali_rencana,
            Carbon::today()
        );

        return view('petugas.pengembalian.create', compact('peminjaman', 'estimatedDenda'));
    }

    /**
     * Process pengembalian.
     */
    public function store(StorePengembalianRequest $request, int $peminjamanId): RedirectResponse
    {
        $peminjaman = $this->peminjamanService->findById($peminjamanId);

        if (!$peminjaman) {
            abort(404);
        }

        try {
            $tanggalKembali = Carbon::parse($request->tanggal_kembali_real);
            
            // Get custom denda (convert empty string to null)
            $customDenda = $request->filled('custom_denda') ? (float) $request->custom_denda : null;
            
            // Get kondisi alat array
            $kondisiAlat = $request->kondisi_alat;
            
            $this->pengembalianService->proses(
                $peminjaman,
                Auth::user(),
                $tanggalKembali,
                $request->catatan_kondisi,
                $customDenda,
                $kondisiAlat
            );

            return redirect()
                ->route('petugas.pengembalian.index')
                ->with('success', 'Pengembalian berhasil diproses.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Show pengembalian detail.
     */
    public function show(int $id): View
    {
        $pengembalian = $this->pengembalianService->findById($id);

        if (!$pengembalian) {
            abort(404);
        }

        return view('petugas.pengembalian.show', compact('pengembalian'));
    }
}
