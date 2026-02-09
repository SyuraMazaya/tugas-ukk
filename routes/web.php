<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\DendaController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController;
use App\Http\Controllers\Peminjam\DashboardController as PeminjamDashboardController;
use App\Http\Controllers\Peminjam\PeminjamanController as PeminjamPeminjamanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root based on authentication status
Route::get('/', function () {
    if (auth()->user()) {
        // Redirect authenticated users to their dashboard
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isPetugas()) {
            return redirect()->route('petugas.dashboard');
        } else {
            return redirect()->route('peminjam.dashboard');
        }
    }
    // Redirect unauthenticated users to login
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // User Management
        Route::resource('users', UserController::class);
        
        // Kategori Management
        Route::resource('kategori', KategoriController::class)->except(['show']);
        
        // Alat Management
        Route::resource('alat', AlatController::class);
        
        // Denda Management
        Route::resource('denda', DendaController::class)->except(['show']);
        
        // Log Aktivitas
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log-aktivitas.index');
        
        // Laporan
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/peminjaman', [LaporanController::class, 'peminjaman'])->name('laporan.peminjaman');
        Route::get('/laporan/pengembalian', [LaporanController::class, 'pengembalian'])->name('laporan.pengembalian');
        Route::get('/laporan/peminjaman/print', [LaporanController::class, 'printPeminjaman'])->name('laporan.peminjaman.print');
        Route::get('/laporan/pengembalian/print', [LaporanController::class, 'printPengembalian'])->name('laporan.pengembalian.print');
    });

/*
|--------------------------------------------------------------------------
| Petugas Routes
|--------------------------------------------------------------------------
*/
Route::prefix('petugas')
    ->name('petugas.')
    ->middleware(['auth', 'role:petugas'])
    ->group(function () {
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
        
        // Peminjaman Management
        Route::get('/peminjaman', [PetugasPeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/peminjaman/{id}', [PetugasPeminjamanController::class, 'show'])->name('peminjaman.show');
        Route::post('/peminjaman/{id}/approve', [PetugasPeminjamanController::class, 'approve'])->name('peminjaman.approve');
        Route::post('/peminjaman/{id}/reject', [PetugasPeminjamanController::class, 'reject'])->name('peminjaman.reject');
        
        // Pengembalian Management
        Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
        Route::get('/pengembalian/create/{peminjaman}', [PengembalianController::class, 'create'])->name('pengembalian.create');
        Route::post('/pengembalian/{peminjaman}', [PengembalianController::class, 'store'])->name('pengembalian.store');
        Route::get('/pengembalian/{id}', [PengembalianController::class, 'show'])->name('pengembalian.show');
    });

/*
|--------------------------------------------------------------------------
| Peminjam Routes
|--------------------------------------------------------------------------
*/
Route::prefix('peminjam')
    ->name('peminjam.')
    ->middleware(['auth', 'role:peminjam'])
    ->group(function () {
        Route::get('/dashboard', [PeminjamDashboardController::class, 'index'])->name('dashboard');
        Route::get('/katalog', [PeminjamDashboardController::class, 'katalog'])->name('katalog');
        
        // Peminjaman
        Route::get('/peminjaman', [PeminjamPeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/peminjaman/create', [PeminjamPeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/peminjaman', [PeminjamPeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::get('/peminjaman/{id}', [PeminjamPeminjamanController::class, 'show'])->name('peminjaman.show');
        Route::post('/peminjaman/{id}/cancel', [PeminjamPeminjamanController::class, 'cancel'])->name('peminjaman.cancel');
    });
