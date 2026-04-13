<x-layouts.app title="Dashboard Peminjam">
    <x-slot:sidebar>
        @include('partials.peminjam-sidebar')
    </x-slot:sidebar>

    @php
        $pending = (int) ($statistics['pending'] ?? 0);
        $disetujui = (int) ($statistics['disetujui'] ?? 0);
        $selesai = (int) ($statistics['selesai'] ?? 0);
        $totalDenda = (int) ($statistics['total_denda'] ?? 0);
    @endphp

    <!-- Header Banner -->
    <div class="mb-6 rounded-2xl border border-sky-200/70 bg-gradient-to-r from-sky-500 via-cyan-500 to-teal-500 px-5 py-6 shadow-lg shadow-sky-300/30 sm:px-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="inline-flex items-center rounded-full bg-white/20 px-3 py-1 text-xs font-semibold text-white ring-1 ring-white/35">Area Peminjam</p>
                <h1 class="mt-3 text-2xl font-bold text-white sm:text-3xl">Dashboard Peminjam</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Selamat datang, {{ Auth::user()->name }}. Kelola peminjaman alat Anda lebih cepat dari sini.</p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center rounded-xl border border-white/30 bg-white/15 px-4 py-2 text-sm font-semibold text-white backdrop-blur-sm">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v2m10-2v2M4 10h16M6 7h12a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2z" />
                    </svg>
                    {{ now()->translatedFormat('l, d F Y') }}
                </span>
                <a href="{{ route('peminjam.peminjaman.create') }}" class="inline-flex items-center rounded-xl border border-white/35 bg-white/20 px-4 py-2 text-sm font-semibold text-white transition-all hover:-translate-y-0.5 hover:bg-white/25">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                    </svg>
                    Ajukan Peminjaman
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-amber-200 bg-gradient-to-br from-amber-50 to-orange-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-amber-700">Menunggu</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $pending }}</p>
            <p class="mt-1 text-xs text-slate-500">Permintaan belum diproses</p>
        </div>

        <div class="rounded-xl border border-blue-200 bg-gradient-to-br from-blue-50 to-indigo-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-blue-700">Sedang Dipinjam</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $disetujui }}</p>
            <p class="mt-1 text-xs text-slate-500">Alat aktif pada Anda</p>
        </div>

        <div class="rounded-xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-teal-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Selesai</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $selesai }}</p>
            <p class="mt-1 text-xs text-slate-500">Peminjaman yang ditutup</p>
        </div>

        <div class="rounded-xl border border-rose-200 bg-gradient-to-br from-rose-50 to-pink-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-rose-700">Total Denda</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">Rp {{ number_format($totalDenda, 0, ',', '.') }}</p>
            <p class="mt-1 text-xs text-slate-500">Akumulasi histori denda</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-6 grid grid-cols-1 gap-5 lg:grid-cols-3">
        <x-card class="overflow-hidden border border-sky-100 shadow-sm transition-shadow hover:shadow-lg">
            <div class="h-1.5 bg-gradient-to-r from-sky-400 to-blue-500"></div>
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-sky-100 text-sky-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Jelajahi Katalog</h3>
                        <p class="mt-1 text-sm text-slate-500">Lihat daftar alat dan stok terbaru sebelum meminjam.</p>
                    </div>
                </div>
            </div>
            <x-slot:footer>
                <a href="{{ route('peminjam.katalog') }}" class="inline-flex items-center text-sm font-semibold text-sky-700 transition-colors hover:text-sky-900">
                    Buka Katalog
                    <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </x-slot:footer>
        </x-card>

        <x-card class="overflow-hidden border border-indigo-100 shadow-sm transition-shadow hover:shadow-lg">
            <div class="h-1.5 bg-gradient-to-r from-indigo-400 to-violet-500"></div>
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Peminjaman Baru</h3>
                        <p class="mt-1 text-sm text-slate-500">Ajukan alat yang dibutuhkan dengan proses cepat.</p>
                    </div>
                </div>
            </div>
            <x-slot:footer>
                <a href="{{ route('peminjam.peminjaman.create') }}" class="inline-flex items-center text-sm font-semibold text-indigo-700 transition-colors hover:text-indigo-900">
                    Ajukan Sekarang
                    <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </x-slot:footer>
        </x-card>

        <x-card class="overflow-hidden border border-emerald-100 shadow-sm transition-shadow hover:shadow-lg">
            <div class="h-1.5 bg-gradient-to-r from-emerald-400 to-teal-500"></div>
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17a1 1 0 102 0v-6a1 1 0 10-2 0v6zm-7 0a1 1 0 102 0V7a1 1 0 10-2 0v10zm14 0a1 1 0 102 0v-4a1 1 0 10-2 0v4z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Riwayat Peminjaman</h3>
                        <p class="mt-1 text-sm text-slate-500">Pantau status semua peminjaman dan pengembalian Anda.</p>
                    </div>
                </div>
            </div>
            <x-slot:footer>
                <a href="{{ route('peminjam.peminjaman.index') }}" class="inline-flex items-center text-sm font-semibold text-emerald-700 transition-colors hover:text-emerald-900">
                    Lihat Riwayat
                    <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </x-slot:footer>
        </x-card>
    </div>

    <!-- Active Loans -->
    <x-card class="overflow-hidden border border-slate-100 shadow-sm">
        <div class="h-1.5 bg-gradient-to-r from-indigo-400 via-cyan-400 to-teal-500"></div>
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
            <h2 class="text-base font-semibold text-slate-800">Peminjaman Aktif</h2>
            <a href="{{ route('peminjam.peminjaman.index') }}" class="text-sm font-semibold text-indigo-600 transition-colors hover:text-indigo-800">Lihat Semua</a>
        </div>

        @if($activePeminjaman->count() > 0)
            <ul class="divide-y divide-slate-100 px-5 py-2">
                @foreach($activePeminjaman as $peminjaman)
                    <li class="py-3">
                        <div class="flex items-center justify-between gap-3">
                            <div class="min-w-0 flex-1">
                                <div class="mb-1.5 flex flex-wrap items-center gap-2">
                                    <p class="font-semibold text-slate-800">{{ $peminjaman->detailPeminjaman->count() }} alat dipinjam</p>
                                    <x-badge :status="$peminjaman->status" />
                                </div>
                                <p class="flex flex-wrap items-center gap-1 text-sm text-slate-500">
                                    <span class="inline-flex items-center">
                                        <svg class="mr-1 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v2m10-2v2M4 10h16M6 7h12a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2z" />
                                        </svg>
                                        Kembali: {{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}
                                    </span>

                                    @if($peminjaman->status === 'disetujui' && $peminjaman->tanggal_kembali_rencana->isPast())
                                        <span class="inline-flex items-center rounded-full bg-rose-100 px-2 py-0.5 text-xs font-semibold text-rose-700">
                                            Terlambat {{ $peminjaman->tanggal_kembali_rencana->diffInDays(now()) }} hari
                                        </span>
                                    @endif
                                </p>
                            </div>

                            <a href="{{ route('peminjam.peminjaman.show', $peminjaman->id_peminjaman) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition-colors hover:bg-slate-100 hover:text-slate-700">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="px-5 py-12 text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                    <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                    </svg>
                </div>
                <p class="font-medium text-slate-600">Belum ada peminjaman aktif</p>
                <p class="mt-1 text-sm text-slate-400">Ajukan peminjaman baru untuk mulai menggunakan alat.</p>
            </div>
        @endif
    </x-card>
</x-layouts.app>