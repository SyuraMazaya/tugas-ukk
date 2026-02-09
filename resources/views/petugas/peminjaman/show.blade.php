<x-layouts.app title="Detail Peminjaman">
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
            <a href="{{ route('petugas.peminjaman.index') }}" class="hover:text-indigo-600 transition-colors">Peminjaman</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-slate-700 font-medium">Detail</span>
        </nav>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Detail Peminjaman</h1>
                <p class="mt-1 text-slate-500 font-mono bg-slate-100 inline-flex px-2 py-0.5 rounded">#{{ str_pad($peminjaman->id_peminjaman, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <a href="{{ route('petugas.peminjaman.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Info Peminjaman -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
                <div class="flex items-center px-6 py-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="ml-3 text-lg font-semibold text-slate-800">Informasi Peminjaman</h3>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-slate-50 rounded-xl p-4">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Peminjam</dt>
                            <dd class="mt-1 flex items-center">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-xs font-bold mr-2">
                                    {{ strtoupper(substr($peminjaman->user->name, 0, 2)) }}
                                </div>
                                <span class="text-sm font-medium text-slate-800">{{ $peminjaman->user->name }}</span>
                            </dd>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Username</dt>
                            <dd class="mt-1 text-sm font-mono text-slate-800">{{ $peminjaman->user->username }}</dd>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Pinjam</dt>
                            <dd class="mt-1 text-sm font-medium text-slate-800 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $peminjaman->tanggal_pinjam->format('d M Y') }}
                            </dd>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Rencana Kembali</dt>
                            <dd class="mt-1 text-sm font-medium text-slate-800 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}
                            </dd>
                        </div>
                        <div class="bg-slate-50 rounded-xl p-4">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</dt>
                            <dd class="mt-1"><x-badge :status="$peminjaman->status" /></dd>
                        </div>
                        @if($peminjaman->petugas)
                            <div class="bg-slate-50 rounded-xl p-4">
                                <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Diproses Oleh</dt>
                                <dd class="mt-1 text-sm font-medium text-slate-800">{{ $peminjaman->petugas->name }}</dd>
                            </div>
                        @endif
                    </dl>
                    
                    @if($peminjaman->catatan)
                        <div class="mt-4 pt-4 border-t border-slate-200">
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Catatan</dt>
                            <dd class="mt-2 text-sm text-slate-700 bg-slate-50 rounded-xl p-4">{{ $peminjaman->catatan }}</dd>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
                <div class="flex items-center px-6 py-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="ml-3 text-lg font-semibold text-slate-800">Alat yang Dipinjam</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Kode</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">Jumlah</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">Stok Tersedia</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($peminjaman->detailPeminjaman as $detail)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-slate-800">{{ $detail->alat->nama_alat }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-500 font-mono">{{ $detail->alat->kode_alat }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm font-semibold bg-indigo-100 text-indigo-800">{{ $detail->jumlah }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm font-semibold {{ $detail->alat->stok >= $detail->jumlah ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                            {{ $detail->alat->stok }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Action Card -->
        <div class="space-y-6">
            @if($peminjaman->isPending())
                <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
                    <div class="flex items-center px-6 py-4 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-slate-800">Aksi</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <form method="POST" action="{{ route('petugas.peminjaman.approve', $peminjaman->id_peminjaman) }}"
                              onsubmit="return confirm('Yakin ingin menyetujui peminjaman ini?')">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-3 text-sm font-semibold text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Setujui Peminjaman
                            </button>
                        </form>
                        
                        <div x-data="{ showReject: false }">
                            <button @click="showReject = !showReject" type="button" class="w-full inline-flex items-center justify-center px-4 py-3 text-sm font-semibold text-white bg-rose-600 rounded-xl hover:bg-rose-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Tolak Peminjaman
                            </button>
                            
                            <form x-show="showReject" x-cloak method="POST" action="{{ route('petugas.peminjaman.reject', $peminjaman->id_peminjaman) }}" class="mt-4" x-transition>
                                @csrf
                                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Alasan Penolakan</label>
                                <textarea 
                                    name="catatan" 
                                    rows="3" 
                                    class="w-full px-4 py-3 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500"
                                    placeholder="Tuliskan alasan penolakan (opsional)"
                                ></textarea>
                                <button type="submit" class="mt-3 w-full inline-flex items-center justify-center px-4 py-3 text-sm font-semibold text-white bg-rose-600 rounded-xl hover:bg-rose-700 transition-colors">
                                    Konfirmasi Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @elseif($peminjaman->isDisetujui())
                <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
                    <div class="flex items-center px-6 py-4 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-slate-800">Aksi</h3>
                    </div>
                    <div class="p-6">
                        <a href="{{ route('petugas.pengembalian.create', $peminjaman->id_peminjaman) }}" class="w-full inline-flex items-center justify-center px-4 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Proses Pengembalian
                        </a>
                    </div>
                </div>
            @endif
            
            @if($peminjaman->pengembalian)
                <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
                    <div class="flex items-center px-6 py-4 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-slate-800">Info Pengembalian</h3>
                    </div>
                    <div class="p-6">
                        <dl class="space-y-4">
                            <div class="bg-slate-50 rounded-xl p-4">
                                <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Kembali</dt>
                                <dd class="mt-1 text-sm font-medium text-slate-800">{{ $peminjaman->pengembalian->tanggal_kembali_real->format('d M Y') }}</dd>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4">
                                <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Denda</dt>
                                <dd class="mt-1 text-lg font-bold {{ $peminjaman->pengembalian->denda > 0 ? 'text-rose-600' : 'text-emerald-600' }}">
                                    Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}
                                </dd>
                            </div>
                            @if($peminjaman->pengembalian->catatan_kondisi)
                                <div class="bg-slate-50 rounded-xl p-4">
                                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Catatan Kondisi</dt>
                                    <dd class="mt-1 text-sm text-slate-700">{{ $peminjaman->pengembalian->catatan_kondisi }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>