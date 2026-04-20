<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePembayaranDendaRequest;
use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\StorePengajuanPengembalianRequest;
use App\Services\AlatService;
use App\Services\KategoriService;
use App\Services\PeminjamanService;
use App\Services\PengembalianService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PeminjamanController extends Controller
{
    public function __construct(
        protected PeminjamanService $peminjamanService,
        protected AlatService $alatService,
        protected KategoriService $kategoriService,
        protected PengembalianService $pengembalianService
    ) {}

    /**
     * Display a listing of user's peminjaman.
     */
    public function index(Request $request): View
    {
        $status = $request->get('status');
        $peminjamans = $this->peminjamanService->getByUserWithFilter(Auth::user(), $status);

        return view('peminjam.peminjaman.index', compact('peminjamans', 'status'));
    }

    /**
     * Show the form for creating a new peminjaman.
     */
    public function create(): View
    {
        $alats = $this->alatService->getKatalog(null, 100);
        $kategoris = $this->kategoriService->getAll();

        return view('peminjam.peminjaman.create', compact('alats', 'kategoris'));
    }

    /**
     * Store a newly created peminjaman.
     */
    public function store(StorePeminjamanRequest $request): RedirectResponse
    {
        try {
            $data = $request->only(['tanggal_pinjam', 'tanggal_kembali_rencana', 'catatan']);

            // Transform alat input to items format
            $alatInput = $request->input('alat', []);
            $items = [];
            foreach ($alatInput as $alatId => $jumlah) {
                if ($jumlah > 0) {
                    $items[] = [
                        'alat_id' => (int) $alatId,
                        'jumlah' => (int) $jumlah,
                    ];
                }
            }

            if (empty($items)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Pilih minimal satu alat untuk dipinjam.');
            }

            $this->peminjamanService->create($data, $items);

            return redirect()
                ->route('peminjam.peminjaman.index')
                ->with('success', 'Peminjaman berhasil diajukan. Menunggu persetujuan petugas.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified peminjaman.
     */
    public function show(int $id): View
    {
        $peminjaman = $this->peminjamanService->findById($id);

        if (! $peminjaman || $peminjaman->user_id !== Auth::id()) {
            abort(404);
        }

        return view('peminjam.peminjaman.show', compact('peminjaman'));
    }

    /**
     * Cancel peminjaman.
     */
    public function cancel(int $id): RedirectResponse
    {
        $peminjaman = $this->peminjamanService->findById($id);

        if (! $peminjaman || $peminjaman->user_id !== Auth::id()) {
            abort(404);
        }

        try {
            $this->peminjamanService->cancel($peminjaman);

            return redirect()
                ->route('peminjam.peminjaman.index')
                ->with('success', 'Peminjaman berhasil dibatalkan.');
        } catch (\Exception $e) {
            return redirect()
                ->route('peminjam.peminjaman.show', $id)
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Submit return request by peminjam.
     */
    public function ajukanPengembalian(StorePengajuanPengembalianRequest $request, int $id): RedirectResponse
    {
        $peminjaman = $this->peminjamanService->findById($id);

        if (! $peminjaman || $peminjaman->user_id !== Auth::id()) {
            abort(404);
        }

        try {
            $this->pengembalianService->ajukanOlehPeminjam(
                $peminjaman,
                Auth::user(),
                Carbon::parse($request->tanggal_kembali_real),
                $request->catatan_peminjam
            );

            return redirect()
                ->route('peminjam.peminjaman.show', $id)
                ->with('success', 'Pengajuan pengembalian berhasil dikirim. Menunggu approval petugas.');
        } catch (\Exception $e) {
            return redirect()
                ->route('peminjam.peminjaman.show', $id)
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Submit denda payment proof by peminjam.
     */
    public function submitPembayaranDenda(StorePembayaranDendaRequest $request, int $id): RedirectResponse
    {
        $peminjaman = $this->peminjamanService->findById($id);

        if (! $peminjaman || $peminjaman->user_id !== Auth::id() || ! $peminjaman->pengembalian) {
            abort(404);
        }

        try {
            $this->pengembalianService->submitPembayaran(
                $peminjaman->pengembalian,
                Auth::user(),
                $request->metode_pembayaran,
                $request->file('bukti_pembayaran')
            );

            return redirect()
                ->route('peminjam.peminjaman.show', $id)
                ->with('success', 'Pembayaran denda berhasil dikirim. Menunggu verifikasi petugas.');
        } catch (\Exception $e) {
            return redirect()
                ->route('peminjam.peminjaman.show', $id)
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Download payment receipt as PDF.
     */
    public function downloadPembayaranPdf(int $id): Response|RedirectResponse
    {
        $peminjaman = $this->peminjamanService->findById($id);

        if (! $peminjaman || $peminjaman->user_id !== Auth::id() || ! $peminjaman->pengembalian) {
            abort(404);
        }

        $pengembalian = $peminjaman->pengembalian;
        $metodeValid = in_array($pengembalian->metode_pembayaran, ['tunai', 'qris'], true);

        if (! $pengembalian->isSelesai() || ! $pengembalian->denda_lunas || ! $metodeValid) {
            return redirect()
                ->route('peminjam.peminjaman.show', $id)
                ->with('error', 'Bukti pembayaran PDF hanya tersedia setelah pembayaran sukses diverifikasi.');
        }

        $buktiPembayaranDataUri = null;
        if ($pengembalian->bukti_pembayaran && Storage::disk('public')->exists($pengembalian->bukti_pembayaran)) {
            $imageBinary = Storage::disk('public')->get($pengembalian->bukti_pembayaran);
            $extension = strtolower((string) pathinfo($pengembalian->bukti_pembayaran, PATHINFO_EXTENSION));
            $mimeType = match ($extension) {
                'png' => 'image/png',
                'webp' => 'image/webp',
                'jpg', 'jpeg' => 'image/jpeg',
                default => 'image/jpeg',
            };
            $buktiPembayaranDataUri = 'data:'.$mimeType.';base64,'.base64_encode($imageBinary);
        }

        $pdf = Pdf::loadView('peminjam.peminjaman.payment-receipt-pdf', [
            'peminjaman' => $peminjaman,
            'pengembalian' => $pengembalian,
            'buktiPembayaranDataUri' => $buktiPembayaranDataUri,
        ])->setPaper('a4');

        $fileName = 'bukti-pembayaran-'.str_pad((string) $peminjaman->id_peminjaman, 6, '0', STR_PAD_LEFT).'.pdf';

        return $pdf->download($fileName);
    }
}
