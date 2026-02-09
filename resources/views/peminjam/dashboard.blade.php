<x-layouts.app title="Dashboard Peminjam">
    <x-slot:sidebar>
        @include('partials.peminjam-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Dashboard Peminjam</h1>
                <p class="mt-1 text-slate-500">Selamat datang kembali, <span class="font-medium text-slate-700">{{ Auth::user()->name }}</span>!</p>
            </div>
            <div class="hidden sm:flex items-center gap-2 text-sm text-slate-500">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stat-card 
            label="Menunggu Persetujuan" 
            :value="$statistics['pending']" 
            color="amber"
            icon="clock"
        />
        <x-stat-card 
            label="Sedang Dipinjam" 
            :value="$statistics['disetujui']" 
            color="blue"
            icon="hand"
        />
        <x-stat-card 
            label="Selesai" 
            :value="$statistics['selesai']" 
            color="emerald"
            icon="check-circle"
        />
        <x-stat-card 
            label="Total Denda" 
            :value="'Rp ' . number_format($statistics['total_denda'], 0, ',', '.')" 
            color="rose"
            icon="cash"
        />
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Active Loans -->
        <x-card>
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="ml-3 text-lg font-semibold text-slate-800">Peminjaman Aktif</h3>
            </div>
            
            @if($activePeminjaman->count() > 0)
                <ul class="divide-y divide-slate-100">
                    @foreach($activePeminjaman as $peminjaman)
                        <li class="py-4 first:pt-0 last:pb-0">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <p class="font-semibold text-slate-800">
                                            {{ $peminjaman->detailPeminjaman->count() }} alat
                                        </p>
                                        <x-badge :status="$peminjaman->status" />
                                    </div>
                                    <p class="text-sm text-slate-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Kembali: {{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}
                                        @if($peminjaman->status === 'disetujui' && $peminjaman->tanggal_kembali_rencana->isPast())
                                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-700">
                                                Terlambat {{ $peminjaman->tanggal_kembali_rencana->diffInDays(now()) }} hari
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <a href="{{ route('peminjam.peminjaman.show', $peminjaman->id_peminjaman) }}" class="p-2 text-indigo-500 hover:text-indigo-700 hover:bg-indigo-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="text-center py-6">
                    <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                    </div>
                    <p class="text-slate-500">Tidak ada peminjaman aktif</p>
                </div>
            @endif
            
            <div class="mt-4 pt-4 border-t border-slate-100">
                <a href="{{ route('peminjam.peminjaman.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                    Lihat Semua Peminjaman
                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </x-card>
        
        <!-- Quick Actions -->
        <x-card>
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="ml-3 text-lg font-semibold text-slate-800">Aksi Cepat</h3>
            </div>
            
            <div class="space-y-3">
                <a href="{{ route('peminjam.katalog') }}" class="block w-full px-4 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100 hover:border-blue-200 hover:shadow-sm transition-all group">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center text-white group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold text-slate-800">Lihat Katalog Alat</p>
                            <p class="text-sm text-slate-500">Cari dan lihat alat yang tersedia</p>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('peminjam.peminjaman.create') }}" class="block w-full px-4 py-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border border-emerald-100 hover:border-emerald-200 hover:shadow-sm transition-all group">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-lg bg-emerald-500 flex items-center justify-center text-white group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold text-slate-800">Ajukan Peminjaman Baru</p>
                            <p class="text-sm text-slate-500">Buat permintaan peminjaman alat</p>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('peminjam.peminjaman.index') }}" class="block w-full px-4 py-4 bg-gradient-to-r from-purple-50 to-violet-50 rounded-xl border border-purple-100 hover:border-purple-200 hover:shadow-sm transition-all group">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-lg bg-purple-500 flex items-center justify-center text-white group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold text-slate-800">Riwayat Peminjaman</p>
                            <p class="text-sm text-slate-500">Lihat semua riwayat peminjaman</p>
                        </div>
                    </div>
                </a>
            </div>
        </x-card>
    </div>
</x-layouts.app>