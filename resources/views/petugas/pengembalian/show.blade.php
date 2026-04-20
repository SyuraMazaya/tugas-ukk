<x-layouts.app title="Detail Pengembalian">
    <x-slot:sidebar>
        @include('partials.petugas-sidebar')
    </x-slot:sidebar>

    <div class="mb-8">
        <nav class="flex items-center text-sm text-slate-500 mb-4">
            <a href="{{ route('petugas.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('petugas.pengembalian.index') }}" class="hover:text-indigo-600 transition-colors">Approval Pengembalian</a>
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
            <x-badge :status="$pengembalian->status" />
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="text-lg font-semibold text-slate-800">Informasi Pengembalian</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="bg-slate-50 rounded-xl p-4">
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Peminjam</dt>
                    <dd class="mt-1 text-sm font-semibold text-slate-800">{{ $pengembalian->peminjaman->user->name }}</dd>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Kembali Real</dt>
                    <dd class="mt-1 text-sm font-semibold text-slate-800">{{ $pengembalian->tanggal_kembali_real->format('d M Y') }}</dd>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Denda</dt>
                    <dd class="mt-1 text-lg font-bold {{ $pengembalian->denda > 0 ? 'text-rose-700' : 'text-emerald-700' }}">
                        Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                    </dd>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Status Denda</dt>
                    <dd class="mt-1">
                        @if($pengembalian->denda_lunas)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-100 text-emerald-700">Lunas / Clear</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-rose-100 text-rose-700">Belum Lunas</span>
                        @endif
                    </dd>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Diproses Oleh</dt>
                    <dd class="mt-1 text-sm font-medium text-slate-800">{{ $pengembalian->petugas?->name ?? '-' }}</dd>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Diverifikasi Oleh</dt>
                    <dd class="mt-1 text-sm font-medium text-slate-800">{{ $pengembalian->verifikator?->name ?? '-' }}</dd>
                </div>

                @if($pengembalian->catatan_peminjam)
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-blue-700 uppercase tracking-wider">Catatan Peminjam</dt>
                        <dd class="mt-1 text-sm text-blue-800">{{ $pengembalian->catatan_peminjam }}</dd>
                    </div>
                @endif

                @if($pengembalian->catatan_kondisi)
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-amber-700 uppercase tracking-wider">Catatan Kondisi</dt>
                        <dd class="mt-1 text-sm text-amber-800">{{ $pengembalian->catatan_kondisi }}</dd>
                    </div>
                @endif

                @if($pengembalian->catatan_approval)
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Catatan Approval</dt>
                        <dd class="mt-1 text-sm text-slate-700">{{ $pengembalian->catatan_approval }}</dd>
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h3 class="text-lg font-semibold text-slate-800">Pembayaran Denda</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Metode Pembayaran</dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-800">{{ $pengembalian->metode_pembayaran_label }}</dd>
                    </div>

                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Pembayaran</dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-800">{{ $pengembalian->tanggal_pembayaran?->format('d M Y H:i') ?? '-' }}</dd>
                    </div>

                    @if($pengembalian->bukti_pembayaran)
                        <div>
                            <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Bukti Pembayaran</dt>
                            <img src="{{ asset('storage/' . $pengembalian->bukti_pembayaran) }}" alt="Bukti pembayaran" class="w-full rounded-xl border border-slate-200">
                        </div>
                    @endif

                    @if(in_array($pengembalian->status, ['menunggu_approval', 'menunggu_verifikasi_pembayaran']))
                        <a href="{{ route('petugas.pengembalian.approval', $pengembalian->id) }}" class="inline-flex items-center justify-center w-full px-4 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors">
                            Lanjutkan Approval
                        </a>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h3 class="text-lg font-semibold text-slate-800">Alat Dikembalikan</h3>
                </div>
                <div class="p-6 space-y-3">
                    @foreach($pengembalian->peminjaman->detailPeminjaman as $detail)
                        <div class="flex items-center justify-between bg-slate-50 rounded-xl px-4 py-3">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">{{ $detail->alat->nama_alat }}</p>
                                <p class="text-xs text-slate-500">{{ $detail->alat->kode_alat }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-indigo-100 text-indigo-700">
                                {{ $detail->jumlah }} unit
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
