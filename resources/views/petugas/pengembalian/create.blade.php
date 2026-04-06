<x-layouts.app title="Proses Pengembalian">
    <x-slot:sidebar>
        @include('partials.petugas-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8">
        <nav class="flex items-center text-sm text-slate-500 mb-4">
            <a href="{{ route('petugas.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('petugas.pengembalian.index') }}" class="hover:text-indigo-600 transition-colors">Pengembalian</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-slate-700 font-medium">Proses</span>
        </nav>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Proses Pengembalian</h1>
                <p class="mt-1 text-slate-500 font-mono bg-slate-100 inline-flex px-2 py-0.5 rounded">Peminjaman #{{ str_pad($peminjaman->id_peminjaman, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Info Peminjaman -->
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="flex items-center px-6 py-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="ml-3 text-lg font-semibold text-slate-800">Informasi Peminjaman</h3>
            </div>
            <div class="p-6">
                <dl class="space-y-4">
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Peminjam</dt>
                        <dd class="mt-1 flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold mr-2">
                                {{ strtoupper(substr($peminjaman->user->name, 0, 2)) }}
                            </div>
                            <span class="text-sm font-medium text-slate-800">{{ $peminjaman->user->name }}</span>
                        </dd>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Pinjam</dt>
                        <dd class="mt-1 text-sm font-medium text-slate-800 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $peminjaman->tanggal_pinjam->format('d M Y') }}
                        </dd>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Rencana Kembali</dt>
                        <dd class="mt-1 text-sm font-medium text-slate-800 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}
                        </dd>
                    </div>
                    <div class="border-t border-slate-200 pt-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Alat Dipinjam</dt>
                        <dd class="space-y-2">
                            @foreach($peminjaman->detailPeminjaman as $detail)
                                <div class="flex items-center justify-between bg-slate-50 rounded-lg p-3">
                                    <span class="text-sm font-medium text-slate-800">{{ $detail->alat->nama_alat }}</span>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-indigo-100 text-indigo-700">{{ $detail->jumlah }} unit</span>
                                </div>
                            @endforeach
                        </dd>
                    </div>
                </dl>
                
                @if($estimatedDenda > 0)
                    <div class="mt-6 p-4 bg-rose-50 border border-rose-200 rounded-xl">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-rose-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm font-semibold text-rose-800">Peminjaman ini terlambat</p>
                                <p class="text-sm text-rose-700 mt-1">Estimasi denda: <span class="font-bold">Rp {{ number_format($estimatedDenda, 0, ',', '.') }}</span></p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Form Pengembalian -->
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="flex items-center px-6 py-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="ml-3 text-lg font-semibold text-slate-800">Form Pengembalian</h3>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('petugas.pengembalian.store', $peminjaman->id_peminjaman) }}">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Tanggal Pengembalian <span class="text-rose-500">*</span></label>
                            <input type="date" name="tanggal_kembali_real" value="{{ now()->format('Y-m-d') }}" required
                                   class="w-full px-4 py-3 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        </div>
                        
                        <!-- Kondisi Alat per Item -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Kondisi Alat Saat Dikembalikan</label>
                            <div class="space-y-3">
                                @foreach($peminjaman->detailPeminjaman as $detail)
                                    <div class="bg-slate-50 rounded-xl p-4">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-sm font-medium text-slate-800">{{ $detail->alat->nama_alat }}</span>
                                            <span class="text-xs text-slate-500">{{ $detail->jumlah }} unit</span>
                                        </div>
                                        <div class="flex flex-wrap gap-2">
                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="kondisi_alat[{{ $detail->alat_id }}]" value="baik" class="peer sr-only" {{ $detail->alat->kondisi === 'baik' ? 'checked' : '' }}>
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold border-2 border-transparent bg-white ring-1 ring-slate-200 peer-checked:ring-2 peer-checked:ring-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 transition-all">
                                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Baik
                                                </span>
                                            </label>
                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="kondisi_alat[{{ $detail->alat_id }}]" value="rusak_ringan" class="peer sr-only" {{ $detail->alat->kondisi === 'rusak_ringan' ? 'checked' : '' }}>
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold border-2 border-transparent bg-white ring-1 ring-slate-200 peer-checked:ring-2 peer-checked:ring-amber-500 peer-checked:bg-amber-50 peer-checked:text-amber-700 transition-all">
                                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                    </svg>
                                                    Rusak Ringan
                                                </span>
                                            </label>
                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="kondisi_alat[{{ $detail->alat_id }}]" value="rusak" class="peer sr-only">
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold border-2 border-transparent bg-white ring-1 ring-slate-200 peer-checked:ring-2 peer-checked:ring-rose-500 peer-checked:bg-rose-50 peer-checked:text-rose-700 transition-all">
                                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Rusak
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Custom Denda -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Nominal Denda Custom</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm">Rp</span>
                                <input type="number" name="custom_denda" min="0" step="1000" 
                                       placeholder="{{ $estimatedDenda > 0 ? number_format($estimatedDenda, 0, '', '') : '0' }}"
                                       class="w-full pl-10 pr-4 py-3 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 placeholder-slate-400">
                            </div>
                            <p class="mt-1.5 text-xs text-slate-400">
                                Kosongkan untuk menggunakan denda otomatis
                                @if($estimatedDenda > 0)
                                    (Rp {{ number_format($estimatedDenda, 0, ',', '.') }})
                                @else
                                    (Rp 0 - tidak terlambat)
                                @endif
                            </p>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Catatan Kondisi Alat</label>
                            <textarea name="catatan_kondisi" rows="3" 
                                      placeholder="Tuliskan kondisi alat saat dikembalikan (opsional)"
                                      class="w-full px-4 py-3 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 placeholder-slate-400 resize-none"></textarea>
                            <p class="mt-1.5 text-xs text-slate-400">Catat jika ada kerusakan atau perubahan kondisi alat</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-100">
                        <a href="{{ route('petugas.peminjaman.show', $peminjaman->id_peminjaman) }}" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Proses Pengembalian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>