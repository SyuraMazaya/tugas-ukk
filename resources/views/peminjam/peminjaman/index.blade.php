<x-layouts.app title="Riwayat Peminjaman">
    <x-slot:sidebar>
        @include('partials.peminjam-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Riwayat Peminjaman</h1>
            <p class="mt-1 text-slate-500">Daftar semua peminjaman Anda</p>
        </div>
        <a href="{{ route('peminjam.peminjaman.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 text-white rounded-lg font-semibold text-sm hover:bg-indigo-700 shadow-sm hover:shadow transition-all focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Ajukan Peminjaman
        </a>
    </div>
    
    <!-- Filter -->
    <x-card class="mb-6">
        <form method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Filter Status</label>
                <select name="status" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg shadow-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                    <option value="disetujui" {{ $status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="selesai" {{ $status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="flex items-end">
                <x-button type="submit" variant="primary">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter
                </x-button>
            </div>
        </form>
    </x-card>
    
    <!-- Peminjaman List -->
    <div class="space-y-4">
        @forelse($peminjamans as $peminjaman)
            <x-card class="hover:shadow-md transition-shadow">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <x-badge :status="$peminjaman->status" />
                            <span class="text-sm text-slate-400 font-mono bg-slate-100 px-2 py-0.5 rounded">
                                #{{ str_pad($peminjaman->id_peminjaman, 6, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                        <h3 class="font-semibold text-slate-800">
                            {{ $peminjaman->detailPeminjaman->count() }} Alat Dipinjam
                        </h3>
                        <p class="text-sm text-slate-500 mt-1 flex items-center flex-wrap gap-1">
                            <span class="inline-flex items-center">
                                <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $peminjaman->tanggal_pinjam->format('d M Y') }}
                            </span>
                            <span class="text-slate-300">|</span>
                            <span class="inline-flex items-center">
                                <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Kembali: {{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}
                            </span>
                        </p>
                        @if($peminjaman->status === 'disetujui' && $peminjaman->tanggal_kembali_rencana->isPast())
                            <div class="mt-2 inline-flex items-center px-3 py-1 rounded-lg bg-rose-50 text-rose-700 text-sm font-medium">
                                <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                Terlambat {{ $peminjaman->tanggal_kembali_rencana->diffInDays(now()) }} hari 
                                (Est. denda: Rp {{ number_format($peminjaman->tanggal_kembali_rencana->diffInDays(now()) * 1000, 0, ',', '.') }})
                            </div>
                        @endif
                        @if($peminjaman->pengembalian)
                            <div class="mt-2 inline-flex items-center px-3 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-sm font-medium">
                                <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Dikembalikan: {{ $peminjaman->pengembalian->tanggal_kembali_real->format('d M Y') }}
                                @if($peminjaman->pengembalian->denda > 0)
                                    <span class="ml-2 text-rose-600">
                                        (Denda: Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }})
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('peminjam.peminjaman.show', $peminjaman->id_peminjaman) }}" 
                           class="inline-flex items-center px-4 py-2 text-indigo-600 border border-indigo-200 rounded-lg hover:bg-indigo-50 transition-colors font-medium text-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Detail
                        </a>
                    </div>
                </div>
                
                <!-- Preview alat -->
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Alat yang dipinjam:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($peminjaman->detailPeminjaman->take(3) as $detail)
                            <span class="inline-flex items-center text-sm bg-slate-100 text-slate-700 px-3 py-1 rounded-lg">
                                {{ $detail->alat->nama_alat }}
                                <span class="ml-1.5 px-1.5 py-0.5 bg-slate-200 rounded text-slate-600 text-xs">{{ $detail->jumlah }}</span>
                            </span>
                        @endforeach
                        @if($peminjaman->detailPeminjaman->count() > 3)
                            <span class="inline-flex items-center text-sm bg-slate-100 text-slate-500 px-3 py-1 rounded-lg">
                                +{{ $peminjaman->detailPeminjaman->count() - 3 }} lainnya
                            </span>
                        @endif
                    </div>
                </div>
            </x-card>
        @empty
            <x-card>
                <div class="text-center py-16">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <p class="text-lg font-medium text-slate-700 mb-1">Belum ada peminjaman</p>
                    <p class="text-slate-500 mb-6">Mulai dengan mengajukan peminjaman pertama Anda</p>
                    <a href="{{ route('peminjam.peminjaman.create') }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 text-white rounded-lg font-semibold text-sm hover:bg-indigo-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Ajukan Peminjaman Pertama
                    </a>
                </div>
            </x-card>
        @endforelse
    </div>
    
    @if($peminjamans->hasPages())
        <div class="mt-6">
            {{ $peminjamans->links() }}
        </div>
    @endif
</x-layouts.app>