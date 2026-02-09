<x-layouts.app title="Dashboard Petugas">
    <x-slot:sidebar>
        @include('partials.petugas-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Dashboard Petugas</h1>
                <p class="mt-1 text-slate-500">Selamat datang kembali, <span class="font-medium text-slate-700">{{ Auth::user()->name }}</span>!</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-slate-500">{{ now()->translatedFormat('l, d F Y') }}</p>
                <p class="text-xs text-slate-400">{{ now()->format('H:i') }} WIB</p>
            </div>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl ring-1 ring-slate-200 shadow-sm hover:shadow-lg transition-all duration-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white shadow-lg shadow-amber-500/30">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-slate-800">{{ $statistics['pending'] }}</p>
                    <p class="text-sm text-slate-500">Menunggu Persetujuan</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl ring-1 ring-slate-200 shadow-sm hover:shadow-lg transition-all duration-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-slate-800">{{ $statistics['disetujui'] }}</p>
                    <p class="text-sm text-slate-500">Peminjaman Aktif</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl ring-1 ring-slate-200 shadow-sm hover:shadow-lg transition-all duration-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-slate-800">{{ $statistics['selesai'] }}</p>
                    <p class="text-sm text-slate-500">Peminjaman Selesai</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl ring-1 ring-slate-200 shadow-sm hover:shadow-lg transition-all duration-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-violet-500/30">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-slate-800">{{ $statistics['total'] }}</p>
                    <p class="text-sm text-slate-500">Total Peminjaman</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Pending Peminjaman -->
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="ml-3 text-lg font-semibold text-slate-800">Menunggu Persetujuan</h3>
                </div>
                <a href="{{ route('petugas.peminjaman.index', ['status' => 'pending']) }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                    Lihat Semua
                </a>
            </div>
            <div class="p-6">
                @if($pendingList->count() > 0)
                    <div class="space-y-3">
                        @foreach($pendingList as $peminjaman)
                            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl hover:bg-slate-100 transition-colors">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-sm font-bold">
                                        {{ strtoupper(substr($peminjaman->user->name, 0, 2)) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-semibold text-slate-800">{{ $peminjaman->user->name }}</p>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <span class="text-xs text-slate-500">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</span>
                                            <span class="text-slate-300">•</span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-indigo-100 text-indigo-700">
                                                {{ $peminjaman->detailPeminjaman->count() }} alat
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('petugas.peminjaman.show', $peminjaman->id_peminjaman) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-slate-500">Tidak ada peminjaman pending</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Overdue Peminjaman -->
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="flex items-center px-6 py-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-500 to-pink-600 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="ml-3 text-lg font-semibold text-slate-800">Peminjaman Terlambat</h3>
            </div>
            <div class="p-6">
                @if($overdueList->count() > 0)
                    <div class="space-y-3">
                        @foreach($overdueList as $peminjaman)
                            <div class="flex items-center justify-between p-4 bg-rose-50 rounded-xl border border-rose-100 hover:bg-rose-100 transition-colors">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-rose-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-semibold text-slate-800">{{ $peminjaman->user->name }}</p>
                                        <p class="text-sm text-rose-600 font-medium">
                                            <svg class="w-3.5 h-3.5 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/>
                                            </svg>
                                            Terlambat {{ now()->diffInDays($peminjaman->tanggal_kembali_rencana) }} hari
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ route('petugas.pengembalian.create', $peminjaman->id_peminjaman) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-white bg-rose-600 rounded-lg hover:bg-rose-700 transition-colors">
                                    Proses
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-slate-500">Tidak ada peminjaman terlambat</p>
                        <p class="text-xs text-slate-400 mt-1">Semua peminjaman tepat waktu</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>