<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePeminjamanRequest;
use App\Services\AlatService;
use App\Services\KategoriService;
use App\Services\PeminjamanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PeminjamanController extends Controller
{
    public function __construct(
        protected PeminjamanService $peminjamanService,
        protected AlatService $alatService,
        protected KategoriService $kategoriService
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

        if (!$peminjaman || $peminjaman->user_id !== Auth::id()) {
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

        if (!$peminjaman || $peminjaman->user_id !== Auth::id()) {
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
}
