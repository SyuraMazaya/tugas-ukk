<x-layouts.app title="Dashboard Admin">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header with Greeting -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-gradient-to-r from-indigo-400 via-blue-400 to-purple-400 rounded-2xl px-6 sm:px-8 py-8 shadow-lg border border-purple-200/50">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-white to-purple-100 flex items-center justify-center text-transparent bg-clip-text">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white drop-shadow-md">Dashboard Admin</h1>
                        <p class="text-white/90 text-sm mt-1 drop-shadow-sm">Kelola sistem peminjaman alat Anda</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-end gap-2 text-right">
                <div class="inline-flex items-center px-4 py-2 bg-white/30 text-white rounded-lg border border-white/40 backdrop-blur-sm hover:bg-white/40 transition-all duration-300">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54-2.11-2.66c-.15-.19-.39-.31-.65-.31-.27 0-.51.13-.66.31L6.5 17h11l-3.54-4.71c-.15-.2-.39-.32-.65-.32-.26 0-.51.12-.66.32z"/>
                    </svg>
                    <span class="text-sm font-semibold">{{ now()->translatedFormat('l, d F Y') }}</span>
                </div>
                <p class="text-white/90 text-sm drop-shadow-sm">Selamat datang kembali, <span class="font-semibold text-white">{{ Auth::user()->name }}</span>! 👋</p>
            </div>
        </div>
    </div>
    
    <!-- Statistics Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Pending Card -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-200/30 p-6 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-amber-500/5 to-orange-500/5"></div>
            <div class="relative">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold text-amber-600 uppercase tracking-wide mb-1">Peminjaman Pending</p>
                        <p class="text-4xl font-bold text-amber-900">{{ $statistics['pending'] }}</p>
                    </div>
                    <div class="p-3 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-amber-600 mt-4 font-medium">Menunggu persetujuan admin</p>
            </div>
        </div>

        <!-- Active Card -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-200/30 p-6 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-blue-500/5 to-cyan-500/5"></div>
            <div class="relative">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide mb-1">Peminjaman Aktif</p>
                        <p class="text-4xl font-bold text-blue-900">{{ $statistics['disetujui'] }}</p>
                    </div>
                    <div class="p-3 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-xl shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-blue-600 mt-4 font-medium">Sedang dalam peminjaman</p>
            </div>
        </div>

        <!-- Completed Card -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-50 to-teal-50 border border-emerald-200/30 p-6 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-emerald-500/5 to-teal-500/5"></div>
            <div class="relative">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wide mb-1">Peminjaman Selesai</p>
                        <p class="text-4xl font-bold text-emerald-900">{{ $statistics['selesai'] }}</p>
                    </div>
                    <div class="p-3 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-xl shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-emerald-600 mt-4 font-medium">Peminjaman yang telah selesai</p>
            </div>
        </div>

        <!-- Total Card -->
        <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-violet-50 to-purple-50 border border-violet-200/30 p-6 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-violet-500/5 to-purple-500/5"></div>
            <div class="relative">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-xs font-semibold text-violet-600 uppercase tracking-wide mb-1">Total Peminjaman</p>
                        <p class="text-4xl font-bold text-violet-900">{{ $statistics['total'] }}</p>
                    </div>
                    <div class="p-3 bg-gradient-to-br from-violet-400 to-purple-500 rounded-xl shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-violet-600 mt-4 font-medium">Seluruh peminjaman</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions and Recent Activity - Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Quick Actions - Left Column -->
        <div class="lg:col-span-2">
            <div class="mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white shadow-lg">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">Aksi Cepat</h2>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- User Management Card -->
                <div class="group relative overflow-hidden rounded-xl bg-white border border-slate-200 hover:border-slate-300 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 p-6">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-indigo-100 to-transparent opacity-50 rounded-bl-full"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-gradient-to-br from-indigo-100 to-indigo-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-indigo-400 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-800 mb-1">Kelola User</h3>
                        <p class="text-sm text-slate-500 mb-4">Tambah, edit, atau hapus user sistem.</p>
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors group/link">
                            Buka Halaman
                            <svg class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Equipment Management Card -->
                <div class="group relative overflow-hidden rounded-xl bg-white border border-slate-200 hover:border-slate-300 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 p-6">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-emerald-100 to-transparent opacity-50 rounded-bl-full"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                            </div>
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-emerald-400 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-800 mb-1">Kelola Alat</h3>
                        <p class="text-sm text-slate-500 mb-4">Tambah, edit, atau hapus alat produktif.</p>
                        <a href="{{ route('admin.alat.index') }}" class="inline-flex items-center text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition-colors group/link">
                            Buka Halaman
                            <svg class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Reports Card -->
                <div class="group relative overflow-hidden rounded-xl bg-white border border-slate-200 hover:border-slate-300 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 p-6">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-violet-100 to-transparent opacity-50 rounded-bl-full"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-gradient-to-br from-violet-100 to-violet-50 rounded-lg group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-violet-400 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-800 mb-1">Lihat Laporan</h3>
                        <p class="text-sm text-slate-500 mb-4">Lihat dan cetak laporan peminjaman.</p>
                        <a href="{{ route('admin.laporan.index') }}" class="inline-flex items-center text-sm font-semibold text-violet-600 hover:text-violet-700 transition-colors group/link">
                            Buka Halaman
                            <svg class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats Summary - Right Column -->
        <div class="flex flex-col gap-5">
            <!-- System Status Card -->
            <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-cyan-50 to-blue-50 border border-cyan-200/50 p-6 shadow-lg">
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-300 rounded-full blur-3xl"></div>
                </div>
                <div class="relative">
                    <h3 class="text-sm font-bold text-cyan-900 uppercase tracking-wide mb-4">Status Sistem</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-cyan-700 font-medium">Server</span>
                            </div>
                            <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-2.5 py-1 rounded-full">Aktif</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-cyan-700 font-medium">Database</span>
                            </div>
                            <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-2.5 py-1 rounded-full">Aktif</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-cyan-700 font-medium">API</span>
                            </div>
                            <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-2.5 py-1 rounded-full">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-orange-50 to-rose-50 border border-orange-200/50 p-6 shadow-sm">
                <h3 class="text-sm font-bold text-orange-900 uppercase tracking-wide mb-3">Info Penting</h3>
                <ul class="space-y-2 text-sm text-orange-700">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Sistem berjalan normal</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Backup terkini</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Keamanan terjaga</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-rose-50 via-pink-50 to-violet-50 px-6 py-5 border-b border-slate-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-rose-400 to-pink-500 flex items-center justify-center text-white shadow-lg">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Aktivitas Terbaru</h2>
                    <p class="text-xs text-slate-500">5 log aktivitas terakhir di sistem</p>
                </div>
            </div>
        </div>

        <div class="overflow-y-auto max-h-80">
            <div class="divide-y divide-slate-200">
                @forelse($recentLogs as $index => $log)
                    <div class="px-6 py-3 hover:bg-rose-50/30 transition-colors duration-200 group">
                        <div class="flex items-start gap-3">
                            <!-- Timeline indicator -->
                            <div class="flex flex-col items-center flex-shrink-0 pt-1">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br {{ 
                                    match(true) {
                                        str_contains($log->aktivitas, 'Ditambahkan') => 'from-emerald-100 to-teal-100',
                                        str_contains($log->aktivitas, 'Diubah') => 'from-blue-100 to-cyan-100',
                                        str_contains($log->aktivitas, 'Dihapus') => 'from-red-100 to-pink-100',
                                        default => 'from-slate-100 to-slate-100'
                                    }
                                }} flex items-center justify-center text-xs font-bold {{ 
                                    match(true) {
                                        str_contains($log->aktivitas, 'Ditambahkan') => 'text-emerald-700',
                                        str_contains($log->aktivitas, 'Diubah') => 'text-blue-700',
                                        str_contains($log->aktivitas, 'Dihapus') => 'text-red-700',
                                        default => 'text-slate-600'
                                    }
                                }}">
                                    {{ $index + 1 }}
                                </div>
                                @if (!$loop->last)
                                    <div class="w-0.5 h-8 bg-gradient-to-b from-slate-200/50 to-transparent mt-1"></div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0 py-0.5">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex-1">
                                        <h3 class="text-sm font-bold text-slate-900 leading-tight">{{ $log->aktivitas }}</h3>
                                        <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">
                                            @if($log->detail_data && is_array($log->detail_data))
                                                {{ implode(', ', array_filter(array_values($log->detail_data), 'is_string')) }}
                                            @else
                                                Aktivitas sistem
                                            @endif
                                        </p>
                                    </div>
                                    <div class="flex flex-col items-end gap-0.5 flex-shrink-0">
                                        <div class="inline-flex items-center px-2 py-0.5 bg-slate-100 rounded text-xs font-medium text-slate-700 whitespace-nowrap">
                                            <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            {{ Str::limit($log->user->name, 12) }}
                                        </div>
                                        <span class="text-xs text-slate-400">{{ $log->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center">
                        <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-slate-500 text-sm">Belum ada aktivitas tercatat</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- View All Link -->
        <div class="px-6 py-3 bg-slate-50/50 border-t border-slate-200">
            <a href="{{ route('admin.log-aktivitas.index') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors group">
                Lihat semua aktivitas
                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</x-layouts.app>
