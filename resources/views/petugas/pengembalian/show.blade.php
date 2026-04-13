<x-layouts.app title="Detail Pengembalian">
    <x-slot:sidebar>
        @include('partials.petugas-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8">
        <nav class="flex items-center text-sm text-slate-500 mb-4">
            <a href="{{ route('petugas.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('petugas.pengembalian.index') }}" class="hover:text-indigo-600 transition-colors">Pengembalian</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-slate-700 font-medium">Detail</span>
        </nav>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Detail Pengembalian</h1>
                <p class="mt-1 text-slate-500 font-mono bg-slate-100 inline-flex px-2 py-0.5 rounded">#{{ str_pad($pengembalian->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <a href="{{ route('petugas.pengembalian.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="flex items-center px-6 py-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="ml-3 text-lg font-semibold text-slate-800">Informasi Pengembalian</h3>
            </div>
            <div class="p-6">
                <dl class="space-y-4">
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Peminjam</dt>
                        <dd class="mt-1 flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold mr-2">
                                {{ strtoupper(substr($pengembalian->peminjaman->user->name, 0, 2)) }}
                            </div>
                            <span class="text-sm font-medium text-slate-800">{{ $pengembalian->peminjaman->user->name }}</span>
                        </dd>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Kembali</dt>
                        <dd class="mt-1 text-sm font-medium text-slate-800 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v2m10-2v2M4 10h16M6 7h12a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2z"/>
                            </svg>
                            {{ $pengembalian->tanggal_kembali_real->format('d M Y') }}
                        </dd>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Denda</dt>
                        <dd class="mt-1">
                            <span class="text-xl font-bold {{ $pengembalian->denda > 0 ? 'text-rose-600' : 'text-emerald-600' }}">
                                Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                            </span>
                        </dd>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Diproses Oleh</dt>
                        <dd class="mt-1 text-sm font-medium text-slate-800">{{ $pengembalian->petugas->name }}</dd>
                    </div>
                    @if($pengembalian->catatan_kondisi)
                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                            <dt class="text-xs font-semibold text-amber-700 uppercase tracking-wider flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Catatan Kondisi
                            </dt>
                            <dd class="mt-2 text-sm text-amber-800">{{ $pengembalian->catatan_kondisi }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="flex items-center px-6 py-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="ml-3 text-lg font-semibold text-slate-800">Alat yang Dikembalikan</h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @foreach($pengembalian->peminjaman->detailPeminjaman as $detail)
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl">
                            <div>
                                <p class="font-semibold text-slate-800">{{ $detail->alat->nama_alat }}</p>
                                <p class="text-xs text-slate-500 font-mono">{{ $detail->alat->kode_alat }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm font-semibold bg-indigo-100 text-indigo-700">
                                {{ $detail->jumlah }} unit
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>