<x-layouts.app title="Katalog Alat">
    <x-slot:sidebar>
        @include('partials.peminjam-sidebar')
    </x-slot:sidebar>

    @php
        $shownAlat = $alats->count();
        $readyAlat = $alats->filter(fn ($alat) => $alat->stok > 0)->count();
        $emptyAlat = $shownAlat - $readyAlat;
        $selectedKategori = $kategoris->firstWhere('id_kategori', $kategori);
    @endphp

    <!-- Header Banner -->
    <div class="mb-6 rounded-2xl border border-indigo-200/60 bg-gradient-to-r from-indigo-500 via-blue-500 to-cyan-500 px-5 py-6 shadow-lg shadow-indigo-300/30 sm:px-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="inline-flex items-center rounded-full bg-white/20 px-3 py-1 text-xs font-semibold text-white ring-1 ring-white/35">Katalog Peminjam</p>
                <h1 class="mt-3 text-2xl font-bold text-white sm:text-3xl">Katalog Alat</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Temukan alat berdasarkan nama, kode, dan kategori sebelum mengajukan peminjaman.</p>
            </div>

            <div class="flex flex-wrap items-center gap-2 text-xs sm:text-sm">
                @if(filled($search))
                    <span class="inline-flex items-center rounded-xl border border-white/30 bg-white/15 px-3 py-2 font-semibold text-white">Pencarian: {{ $search }}</span>
                @endif
                @if($selectedKategori)
                    <span class="inline-flex items-center rounded-xl border border-white/30 bg-white/15 px-3 py-2 font-semibold text-white">Kategori: {{ $selectedKategori->nama_kategori }}</span>
                @endif
                <a href="{{ route('peminjam.peminjaman.create') }}" class="inline-flex items-center rounded-xl border border-white/35 bg-white/20 px-3 py-2 font-semibold text-white transition-all hover:-translate-y-0.5 hover:bg-white/25">
                    <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                    </svg>
                    Ajukan Cepat
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-3">
        <div class="rounded-xl border border-blue-200 bg-gradient-to-br from-blue-50 to-indigo-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-blue-700">Ditampilkan</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $shownAlat }}</p>
            <p class="mt-1 text-xs text-slate-500">Alat pada halaman ini</p>
        </div>
        <div class="rounded-xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-teal-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Siap Dipinjam</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $readyAlat }}</p>
            <p class="mt-1 text-xs text-slate-500">Memiliki stok lebih dari 0</p>
        </div>
        <div class="rounded-xl border border-rose-200 bg-gradient-to-br from-rose-50 to-pink-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-rose-700">Stok Habis</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $emptyAlat }}</p>
            <p class="mt-1 text-xs text-slate-500">Belum tersedia saat ini</p>
        </div>
    </div>

    <!-- Filter & Search -->
    <x-card class="mb-6 border border-indigo-100 bg-gradient-to-r from-indigo-50/70 via-white to-cyan-50/70 shadow-sm">
        <form method="GET" class="grid grid-cols-1 gap-4 lg:grid-cols-12">
            <div class="lg:col-span-6">
                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-600">Pencarian</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Cari nama atau kode alat..."
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-slate-700 shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                    />
                </div>
            </div>

            <div class="lg:col-span-4">
                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-600">Kategori</label>
                <select name="kategori" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-700 shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id_kategori }}" {{ ($kategori ?? '') == $kat->id_kategori ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="lg:col-span-2 lg:self-end">
                <div class="flex gap-2">
                    <button type="submit" class="inline-flex flex-1 items-center justify-center rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition-all hover:from-indigo-700 hover:to-blue-700">
                        <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Cari
                    </button>

                    @if(filled($search) || filled($kategori))
                        <a href="{{ route('peminjam.katalog') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm font-semibold text-slate-700 transition-colors hover:bg-slate-50">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </x-card>

    <!-- Alat Grid -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse($alats as $alat)
            <article class="group overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-indigo-100/60">
                <div class="relative aspect-video overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200">
                    @if($alat->gambar)
                        <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama_alat }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                    @else
                        <div class="flex h-full w-full items-center justify-center">
                            <svg class="h-16 w-16 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif

                    <div class="absolute left-3 top-3">
                        <span class="inline-flex items-center rounded-lg bg-white/90 px-2.5 py-1 text-xs font-semibold text-slate-700 shadow-sm backdrop-blur-sm">
                            {{ $alat->kategori->nama_kategori }}
                        </span>
                    </div>
                </div>

                <div class="p-4">
                    <h3 class="line-clamp-1 text-lg font-semibold text-slate-800">{{ $alat->nama_alat }}</h3>
                    <p class="mt-0.5 font-mono text-sm text-slate-400">{{ $alat->kode_alat }}</p>

                    @if($alat->deskripsi)
                        <p class="mt-2 line-clamp-2 text-sm text-slate-500">{{ Str::limit($alat->deskripsi, 90) }}</p>
                    @endif

                    <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-4">
                        <span class="inline-flex items-center rounded-lg px-2.5 py-1 text-sm font-semibold {{ $alat->stok > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                            <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            {{ $alat->stok }}
                        </span>

                        @if($alat->stok > 0)
                            <a href="{{ route('peminjam.peminjaman.create', ['alat' => $alat->id_alat]) }}" class="inline-flex items-center rounded-lg bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white transition-colors hover:bg-indigo-700">
                                <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                                </svg>
                                Pinjam
                            </a>
                        @else
                            <span class="inline-flex cursor-not-allowed items-center rounded-lg bg-slate-100 px-3 py-1.5 text-sm font-semibold text-slate-400">
                                Habis
                            </span>
                        @endif
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-xl border border-slate-200 bg-white px-4 py-14 text-center shadow-sm">
                <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-slate-100">
                    <svg class="h-10 w-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <p class="mb-1 text-lg font-medium text-slate-700">Tidak ada alat ditemukan</p>
                <p class="text-slate-500">Coba ubah kata kunci atau filter kategori.</p>
            </div>
        @endforelse
    </div>

    @if($alats->hasPages())
        <div class="mt-8">
            {{ $alats->appends(request()->query())->links() }}
        </div>
    @endif
</x-layouts.app>