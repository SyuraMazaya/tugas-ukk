<x-layouts.app title="Dashboard Admin">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Headers -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Dashboard Admin</h1>
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
            label="Peminjaman Pending" 
            :value="$statistics['pending']" 
            color="yellow"
        />
        
        <x-stat-card 
            label="Peminjaman Aktif" 
            :value="$statistics['disetujui']" 
            color="blue"
        />
        
        <x-stat-card 
            label="Peminjaman Selesai" 
            :value="$statistics['selesai']" 
            color="green"
        />
        
        <x-stat-card 
            label="Total Peminjaman" 
            :value="$statistics['total']" 
            color="purple"
        />
    </div>
    
    <!-- Quick Actions Section -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Aksi Cepat</h2>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <x-card>
            <div class="flex items-start">
                <div class="flex-shrink-0 p-3 bg-indigo-50 rounded-xl">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-base font-semibold text-slate-800">Kelola User</h3>
                    <p class="mt-1 text-sm text-slate-500">Tambah, edit, atau hapus user sistem.</p>
                </div>
            </div>
            <x-slot:footer>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                    Kelola User
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-base font-semibold text-slate-800">Kelola Alat</h3>
                    <p class="mt-1 text-sm text-slate-500">Tambah, edit, atau hapus alat produktif.</p>
                </div>
            </div>
            <x-slot:footer>
                <a href="{{ route('admin.alat.index') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                    Kelola Alat
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
                    <h3 class="text-base font-semibold text-slate-800">Lihat Laporan</h3>
                    <p class="mt-1 text-sm text-slate-500">Lihat dan cetak laporan peminjaman.</p>
                </div>
            </div>
            <x-slot:footer>
                <a href="{{ route('admin.laporan.index') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                    Lihat Laporan
                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </x-slot:footer>
        </x-card>
    </div>
</x-layouts.app>
