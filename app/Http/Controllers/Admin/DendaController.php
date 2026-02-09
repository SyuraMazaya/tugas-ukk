<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Denda;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    /**
     * Display a listing of all denda.
     */
    public function index()
    {
        $dendas = Denda::orderBy('created_at', 'desc')->paginate(10);
        $dendaCount = Denda::count();
        
        return view('admin.denda.index', [
            'dendas' => $dendas,
            'dendaCount' => $dendaCount,
            'canCreate' => $dendaCount < 1,
        ]);
    }

    /**
     * Show the form for creating a new denda.
     */
    public function create()
    {
        // Check if denda already exists
        if (Denda::count() > 0) {
            return redirect()->route('admin.denda.index')
                ->with('error', 'Sistem hanya bisa memiliki 1 konfigurasi denda. Edit denda yang ada atau hapus terlebih dahulu.');
        }
        
        return view('admin.denda.create');
    }

    /**
     * Store a newly created denda in storage.
     */
    public function store(Request $request)
    {
        // Check if denda already exists
        if (Denda::count() > 0) {
            return redirect()->route('admin.denda.index')
                ->with('error', 'Sistem hanya bisa memiliki 1 konfigurasi denda.');
        }
        
        $request->validate([
            'nama_denda' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah_denda' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        Denda::create([
            'nama_denda' => $request->nama_denda,
            'deskripsi' => $request->deskripsi,
            'jumlah_denda' => $request->jumlah_denda,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.denda.index')
            ->with('success', 'Denda berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified denda.
     */
    public function edit(Denda $denda)
    {
        return view('admin.denda.edit', [
            'denda' => $denda,
        ]);
    }

    /**
     * Update the specified denda in storage.
     */
    public function update(Request $request, Denda $denda)
    {
        $request->validate([
            'nama_denda' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah_denda' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $denda->update([
            'nama_denda' => $request->nama_denda,
            'deskripsi' => $request->deskripsi,
            'jumlah_denda' => $request->jumlah_denda,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.denda.index')
            ->with('success', 'Denda berhasil diperbarui');
    }

    /**
     * Remove the specified denda from storage.
     */
    public function destroy(Denda $denda)
    {
        $denda->delete();

        return redirect()->route('admin.denda.index')
            ->with('success', 'Denda berhasil dihapus');
    }
}
