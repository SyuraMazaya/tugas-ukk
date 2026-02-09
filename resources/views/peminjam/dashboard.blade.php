<x-layouts.app title="Dashboard Peminjam">
    <x-slot:sidebar>
        @include('partials.peminjam-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Dashboard Peminjam</h1>
                <p class="mt-1 text-slate-500">Selamat datang kembali, <span class="font-medium text-slate-700">{{ Auth::user()->name }}</span>!</p>
            </div>
            <div class="flex items-center text-sm text-slate-500">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <x-stat-card 
            label="Menunggu Persetujuan" 
            :value="$statistics['pending']" 
            color="yellow"
        />
        
        <x-stat-card 
            label="Sedang Dipinjam" 
            :value="$statistics['disetujui']" 
            color="blue"
        />
        
        <x-stat-card 
            label="Selesai" 
            :value="$statistics['selesai']" 
            color="green"
        />
        
        <x-stat-card 
            label="Total Denda" 
            :value="'Rp ' . number_format($statistics['total_denda'], 0, ',', '.')" 
            color="red"
        />
    </div>
    
    <!-- Quick Actions Section -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Aksi Cepat</h2>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <x-card>
            <div class="flex items-start">
                <div class="flex-shrink-0 p-3 bg-blue-50 rounded-xl">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-base font-semibold text-slate-800">Lihat Katalog Alat</h3>
                    <p class="mt-1 text-sm text-slate-500">Cari dan lihat alat yang tersedia.</p>
                </div>
            </div>
            <x-slot:footer>
                <a href="{{ route('peminjam.katalog') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                    Lihat Katalog
                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </x-slot:footer>
        </x-card>
        
        <x-card>
            <div class="flex items-start">
                <div class="flex-shrink-0 p-3 bg-emerald-50 rounded-xl">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-base font-semibold text-slate-800">Ajukan Peminjaman Baru</h3>
                    <p class="mt-1 text-sm text-slate-500">Buat permintaan peminjaman alat.</p>
                </div>
            </div>
            <x-slot:footer>
                <a href="{{ route('peminjam.peminjaman.create') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                    Ajukan Peminjaman
                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </x-slot:footer>
        </x-card>
        
        <x-card>
            <div class="flex items-start">
                <div class="flex-shrink-0 p-3 bg-violet-50 rounded-xl">
                    <svg class="w-6 h-6 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-base font-semibold text-slate-800">Riwayat Peminjaman</h3>
                    <p class="mt-1 text-sm text-slate-500">Lihat semua riwayat peminjaman Anda.</p>
                </div>
            </div>
            <x-slot:footer>
                <a href="{{ route('peminjam.peminjaman.index') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                    Lihat Riwayat
                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </x-slot:footer>
        </x-card>
    </div>
    
    <!-- Active Loans Section -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Peminjaman Aktif</h2>
    </div>
    
    <x-card>
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
                            <a href="{{ route('peminjam.peminjaman.show', $peminjaman->id_peminjaman) }}" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="text-center py-8">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <p class="text-slate-500 font-medium">Tidak ada peminjaman aktif</p>
                <p class="text-slate-400 text-sm mt-1">Ajukan peminjaman baru untuk memulai</p>
            </div>
        @endif
    </x-card>
</x-layouts.app>