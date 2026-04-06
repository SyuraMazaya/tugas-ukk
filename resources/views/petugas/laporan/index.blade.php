<x-layouts.app title="Laporan">
    <x-slot:sidebar>
        @include('partials.petugas-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Laporan</h1>
                <p class="mt-1 text-slate-500">Ringkasan data dan cetak laporan sistem</p>
            </div>
            <div class="flex items-center text-sm text-slate-500 bg-white px-4 py-2 rounded-lg shadow-sm ring-1 ring-slate-200/50">
                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>
    
    <!-- Statistics Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200/50 p-6 hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 text-white shadow-lg shadow-indigo-500/30 ring-4 ring-indigo-100">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div class="ml-5 flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-500 truncate">Total Peminjaman</p>
                    <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $peminjamanStats['total'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200/50 p-6 hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 rounded-xl bg-gradient-to-br from-amber-400 to-amber-500 text-white shadow-lg shadow-amber-500/30 ring-4 ring-amber-100">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-5 flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-500 truncate">Peminjaman Aktif</p>
                    <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $peminjamanStats['disetujui'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200/50 p-6 hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white shadow-lg shadow-emerald-500/30 ring-4 ring-emerald-100">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-5 flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-500 truncate">Total Pengembalian</p>
                    <p class="text-2xl font-bold text-slate-800 mt-0.5">{{ $pengembalianStats['total_pengembalian'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200/50 p-6 hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 rounded-xl bg-gradient-to-br from-rose-500 to-rose-600 text-white shadow-lg shadow-rose-500/30 ring-4 ring-rose-100">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-5 flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-500 truncate">Total Denda</p>
                    <p class="text-2xl font-bold text-slate-800 mt-0.5">Rp {{ number_format($pengembalianStats['total_denda'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Report Links -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Laporan Peminjaman Card -->
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200/50 overflow-hidden group hover:shadow-xl hover:ring-indigo-200 transition-all duration-300">
            <div class="p-6">
                <div class="flex items-start">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white flex-shrink-0 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <div class="ml-5 flex-1">
                        <h3 class="text-lg font-bold text-slate-800 group-hover:text-indigo-700 transition-colors">Laporan Peminjaman</h3>
                        <p class="mt-1.5 text-sm text-slate-500 leading-relaxed">Lihat detail dan cetak laporan semua transaksi peminjaman alat</p>
                        <div class="mt-4 flex items-center gap-4 text-xs text-slate-400">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ $peminjamanStats['total'] }} data
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $peminjamanStats['pending'] }} pending
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 px-6 py-4 bg-slate-50/80 border-t border-slate-100">
                <a href="{{ route('petugas.laporan.peminjaman') }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 text-white rounded-lg font-semibold text-sm hover:bg-indigo-700 shadow-sm hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Lihat Laporan
                </a>
                <a href="{{ route('petugas.laporan.peminjaman.print') }}" target="_blank" class="inline-flex items-center px-4 py-2.5 border border-slate-300 text-slate-700 rounded-lg font-semibold text-sm hover:bg-white hover:border-slate-400 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak
                </a>
            </div>
        </div>
        
        <!-- Laporan Pengembalian Card -->
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200/50 overflow-hidden group hover:shadow-xl hover:ring-emerald-200 transition-all duration-300">
            <div class="p-6">
                <div class="flex items-start">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white flex-shrink-0 shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-5 flex-1">
                        <h3 class="text-lg font-bold text-slate-800 group-hover:text-emerald-700 transition-colors">Laporan Pengembalian</h3>
                        <p class="mt-1.5 text-sm text-slate-500 leading-relaxed">Lihat detail dan cetak laporan semua transaksi pengembalian alat</p>
                        <div class="mt-4 flex items-center gap-4 text-xs text-slate-400">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ $pengembalianStats['total_pengembalian'] }} data
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Rp {{ number_format($pengembalianStats['total_denda'], 0, ',', '.') }} denda
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 px-6 py-4 bg-slate-50/80 border-t border-slate-100">
                <a href="{{ route('petugas.laporan.pengembalian') }}" class="inline-flex items-center px-4 py-2.5 bg-emerald-600 text-white rounded-lg font-semibold text-sm hover:bg-emerald-700 shadow-sm hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Lihat Laporan
                </a>
                <a href="{{ route('petugas.laporan.pengembalian.print') }}" target="_blank" class="inline-flex items-center px-4 py-2.5 border border-slate-300 text-slate-700 rounded-lg font-semibold text-sm hover:bg-white hover:border-slate-400 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Tips -->
    <div class="mt-8 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl p-6 ring-1 ring-indigo-100">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h4 class="text-sm font-semibold text-indigo-900">Tips Penggunaan Laporan</h4>
                <p class="mt-1 text-sm text-indigo-700">Gunakan filter pada halaman laporan untuk melihat data yang spesifik. Klik tombol "Cetak" untuk mencetak laporan dalam format yang rapi untuk dokumentasi.</p>
            </div>
        </div>
    </div>
</x-layouts.app>
