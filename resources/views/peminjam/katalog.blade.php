<x-layouts.app title="Katalog Alat">
    <x-slot:sidebar>
        @include('partials.peminjam-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Katalog Alat</h1>
        <p class="mt-1 text-slate-500">Jelajahi alat-alat yang tersedia untuk dipinjam</p>
    </div>
    
    <!-- Filter & Search -->
    <x-card class="mb-6">
        <form method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Pencarian</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ $search ?? '' }}" 
                           placeholder="Cari nama atau kode alat..." 
                           class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-lg shadow-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">
                </div>
            </div>
            <div class="w-full sm:w-56">
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Kategori</label>
                <select name="kategori" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg shadow-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id_kategori }}" {{ ($kategori ?? '') == $kat->id_kategori ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <x-button type="submit" variant="primary">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari
                </x-button>
            </div>
        </form>
    </x-card>
    
    <!-- Alat Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($alats as $alat)
            <div class="group bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden hover:shadow-lg hover:ring-indigo-200 transition-all duration-300">
                <div class="relative aspect-video bg-gradient-to-br from-slate-100 to-slate-200 overflow-hidden">
                    @if($alat->gambar)
                        <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama_alat }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="flex items-center justify-center w-full h-full">
                            <svg class="w-16 h-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-white/90 backdrop-blur-sm text-slate-700 shadow-sm">
                            {{ $alat->kategori->nama_kategori }}
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-slate-800 line-clamp-1">{{ $alat->nama_alat }}</h3>
                    <p class="text-sm text-slate-400 font-mono mt-0.5">{{ $alat->kode_alat }}</p>
                    @if($alat->deskripsi)
                        <p class="text-sm text-slate-500 mt-2 line-clamp-2">{{ Str::limit($alat->deskripsi, 80) }}</p>
                    @endif
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-slate-100">
                        <div class="flex items-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm font-semibold {{ $alat->stok > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                {{ $alat->stok }}
                            </span>
                        </div>
                        @if($alat->stok > 0)
                            <a href="{{ route('peminjam.peminjaman.create', ['alat' => $alat->id_alat]) }}" 
                               class="inline-flex items-center px-3 py-1.5 text-sm font-semibold bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Pinjam
                            </a>
                        @else
                            <span class="inline-flex items-center px-3 py-1.5 text-sm font-semibold bg-slate-100 text-slate-400 rounded-lg cursor-not-allowed">
                                Habis
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center py-16 px-4">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <p class="text-lg font-medium text-slate-700 mb-1">Tidak ada alat ditemukan</p>
                    <p class="text-slate-500">Coba ubah filter pencarian Anda</p>
                </div>
            </div>
        @endforelse
    </div>
    
    @if($alats->hasPages())
        <div class="mt-8">
            {{ $alats->links() }}
        </div>
    @endif
</x-layouts.app>