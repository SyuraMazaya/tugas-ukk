<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengembalianRequest;
use App\Services\PengembalianService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PengembalianController extends Controller
{
    public function __construct(
        protected PengembalianService $pengembalianService
    ) {}

    /**
     * Display a listing of pengembalian.
     */
    public function index(Request $request): View
    {
        $status = $request->get('status');
        $pengembalians = $this->pengembalianService->getAll(10, $status);

        return view('petugas.pengembalian.index', compact('pengembalians', 'status'));
    }

    /**
     * Show approval page for pengembalian.
     */
    public function approval(int $id): View
    {
        $pengembalian = $this->pengembalianService->findById($id);

        if (! $pengembalian) {
            abort(404);
        }

        $estimatedDenda = $this->pengembalianService->hitungDenda(
            $pengembalian->peminjaman->tanggal_kembali_rencana,
            Carbon::parse($pengembalian->tanggal_kembali_real)
        );

        return view('petugas.pengembalian.approval', compact('pengembalian', 'estimatedDenda'));
    }

    /**
     * Process initial return approval.
     */
    public function prosesApproval(StorePengembalianRequest $request, int $id): RedirectResponse
    {
        $pengembalian = $this->pengembalianService->findById($id);

        if (! $pengembalian) {
            abort(404);
        }

        try {
            $customDenda = $request->filled('custom_denda') ? (float) $request->custom_denda : null;
            $kondisiAlat = $request->kondisi_alat;

            $this->pengembalianService->approvePengembalian(
                $pengembalian,
                Auth::user(),
                $request->status_approval,
                $request->catatan_kondisi,
                $request->catatan_approval,
                $customDenda,
                $kondisiAlat
            );

            return redirect()
                ->route('petugas.pengembalian.index')
                ->with('success', 'Approval pengembalian berhasil diproses.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Verify denda payment submission.
     */
    public function verifikasiPembayaran(Request $request, int $id): RedirectResponse
    {
        $pengembalian = $this->pengembalianService->findById($id);

        if (! $pengembalian) {
            abort(404);
        }

        $validated = $request->validate([
            'aksi' => ['required', 'in:setujui,tolak'],
            'catatan_approval' => ['nullable', 'string', 'max:1000'],
        ]);

        try {
            $isDisetujui = $validated['aksi'] === 'setujui';

            $this->pengembalianService->verifikasiPembayaran(
                $pengembalian,
                Auth::user(),
                $isDisetujui,
                $validated['catatan_approval'] ?? null
            );

            return redirect()
                ->route('petugas.pengembalian.show', $id)
                ->with('success', $isDisetujui
                    ? 'Pembayaran denda disetujui. Status pengembalian clear.'
                    : 'Pembayaran denda ditolak. Menunggu pengiriman ulang pembayaran.');
        } catch (\Exception $e) {
            return redirect()
                ->route('petugas.pengembalian.show', $id)
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Show pengembalian detail.
     */
    public function show(int $id): View
    {
        $pengembalian = $this->pengembalianService->findById($id);

        if (! $pengembalian) {
            abort(404);
        }

        return view('petugas.pengembalian.show', compact('pengembalian'));
    }
}
