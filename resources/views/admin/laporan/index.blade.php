<x-layouts.app title="Laporan">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    @php
        $totalPeminjaman = $peminjamanStats['total'] ?? 0;
        $totalDisetujui = $peminjamanStats['disetujui'] ?? 0;
        $totalPending = $peminjamanStats['pending'] ?? 0;
        $totalSelesai = $peminjamanStats['selesai'] ?? 0;
        $totalPengembalian = $pengembalianStats['total_pengembalian'] ?? 0;
        $totalDenda = $pengembalianStats['total_denda'] ?? 0;
        $pengembalianBulanIni = $pengembalianStats['pengembalian_bulan_ini'] ?? 0;
        $dendaBulanIni = $pengembalianStats['denda_bulan_ini'] ?? 0;
    @endphp

    <!-- Header Banner -->
    <div class="mb-6 rounded-2xl border border-blue-200/60 bg-gradient-to-r from-blue-500 via-cyan-500 to-teal-500 px-5 py-6 shadow-lg shadow-blue-300/30 sm:px-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="inline-flex items-center rounded-full bg-white/20 px-3 py-1 text-xs font-semibold text-white ring-1 ring-white/40">
                    Dashboard Laporan
                </p>
                <h1 class="mt-3 text-2xl font-bold text-white sm:text-3xl">Laporan</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Ringkasan data operasional dan akses cepat cetak laporan.</p>
            </div>

            <div class="inline-flex items-center rounded-xl border border-white/25 bg-white/15 px-4 py-2 text-sm font-semibold text-white backdrop-blur-sm">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-indigo-200 bg-gradient-to-br from-indigo-50 to-blue-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-indigo-700">Total Peminjaman</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalPeminjaman }}</p>
            <p class="mt-1 text-xs text-slate-500">Seluruh histori peminjaman</p>
        </div>

        <div class="rounded-xl border border-amber-200 bg-gradient-to-br from-amber-50 to-orange-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-amber-700">Peminjaman Aktif</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalDisetujui }}</p>
            <p class="mt-1 text-xs text-slate-500">Status disetujui berjalan</p>
        </div>

        <div class="rounded-xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-teal-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Total Pengembalian</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalPengembalian }}</p>
            <p class="mt-1 text-xs text-slate-500">Semua transaksi kembali</p>
        </div>

        <div class="rounded-xl border border-rose-200 bg-gradient-to-br from-rose-50 to-pink-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-rose-700">Total Denda</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">Rp {{ number_format($totalDenda, 0, ',', '.') }}</p>
            <p class="mt-1 text-xs text-slate-500">Akumulasi keseluruhan</p>
        </div>
    </div>

    <!-- Report Cards -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-card class="overflow-hidden border border-indigo-100 shadow-sm transition-shadow hover:shadow-lg">
            <div class="h-1.5 bg-gradient-to-r from-indigo-400 to-blue-500"></div>
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-blue-600 text-white shadow-lg shadow-indigo-300/40">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>

                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-slate-800">Laporan Peminjaman</h3>
                        <p class="mt-1.5 text-sm leading-relaxed text-slate-500">Pantau semua pengajuan, persetujuan, dan status akhir peminjaman alat.</p>

                        <div class="mt-4 grid grid-cols-3 gap-2 text-xs">
                            <div class="rounded-lg bg-indigo-50 px-3 py-2 text-center">
                                <p class="font-semibold text-indigo-700">{{ $totalPeminjaman }}</p>
                                <p class="text-indigo-500">Total</p>
                            </div>
                            <div class="rounded-lg bg-amber-50 px-3 py-2 text-center">
                                <p class="font-semibold text-amber-700">{{ $totalPending }}</p>
                                <p class="text-amber-500">Pending</p>
                            </div>
                            <div class="rounded-lg bg-emerald-50 px-3 py-2 text-center">
                                <p class="font-semibold text-emerald-700">{{ $totalSelesai }}</p>
                                <p class="text-emerald-500">Selesai</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3 border-t border-slate-100 bg-slate-50/80 px-6 py-4">
                <a href="{{ route('admin.laporan.peminjaman') }}" class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-indigo-700">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Lihat Laporan
                </a>

                <a href="{{ route('admin.laporan.peminjaman.print') }}" target="_blank" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition-colors hover:bg-slate-50">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak
                </a>
            </div>
        </x-card>

        <x-card class="overflow-hidden border border-emerald-100 shadow-sm transition-shadow hover:shadow-lg">
            <div class="h-1.5 bg-gradient-to-r from-emerald-400 to-teal-500"></div>
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white shadow-lg shadow-emerald-300/40">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-slate-800">Laporan Pengembalian</h3>
                        <p class="mt-1.5 text-sm leading-relaxed text-slate-500">Lihat pengembalian alat, nominal denda, dan kondisi alat saat kembali.</p>

                        <div class="mt-4 grid grid-cols-2 gap-2 text-xs">
                            <div class="rounded-lg bg-emerald-50 px-3 py-2 text-center">
                                <p class="font-semibold text-emerald-700">{{ $pengembalianBulanIni }}</p>
                                <p class="text-emerald-500">Bulan Ini</p>
                            </div>
                            <div class="rounded-lg bg-rose-50 px-3 py-2 text-center">
                                <p class="font-semibold text-rose-700">Rp {{ number_format($dendaBulanIni, 0, ',', '.') }}</p>
                                <p class="text-rose-500">Denda Bulan Ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3 border-t border-slate-100 bg-slate-50/80 px-6 py-4">
                <a href="{{ route('admin.laporan.pengembalian') }}" class="inline-flex items-center rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-emerald-700">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Lihat Laporan
                </a>

                <a href="{{ route('admin.laporan.pengembalian.print') }}" target="_blank" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition-colors hover:bg-slate-50">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak
                </a>
            </div>
        </x-card>
    </div>

    <x-card class="mt-6 border border-cyan-100 bg-gradient-to-r from-cyan-50 to-blue-50 shadow-sm">
        <div class="flex items-start gap-3">
            <div class="mt-0.5 flex h-8 w-8 items-center justify-center rounded-lg bg-cyan-100 text-cyan-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01" />
                </svg>
            </div>
            <div>
                <h4 class="text-sm font-semibold text-cyan-900">Tips Penggunaan Laporan</h4>
                <p class="mt-1 text-sm text-cyan-800">Gunakan halaman detail laporan untuk memfilter data lebih spesifik, lalu gunakan tombol cetak untuk dokumen administrasi yang rapi.</p>
            </div>
        </div>
    </x-card>
</x-layouts.app>