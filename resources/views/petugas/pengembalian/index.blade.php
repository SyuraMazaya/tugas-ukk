<x-layouts.app title="Approval Pengembalian">
    <x-slot:sidebar>
        @include('partials.petugas-sidebar')
    </x-slot:sidebar>

    <div class="mb-8">
        <nav class="flex items-center text-sm text-slate-500 mb-4">
            <a href="{{ route('petugas.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-slate-700 font-medium">Approval Pengembalian</span>
        </nav>

        <h1 class="text-2xl font-bold text-slate-800">Approval Pengembalian</h1>
        <p class="mt-1 text-slate-500">Klarifikasi kondisi alat dan verifikasi pembayaran denda</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 p-6 mb-6">
        <form method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Filter Status</label>
                <select name="status" class="w-full px-4 py-2.5 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                    <option value="">Semua Status</option>
                    <option value="menunggu_approval" {{ $status === 'menunggu_approval' ? 'selected' : '' }}>Menunggu Approval</option>
                    <option value="menunggu_pembayaran" {{ $status === 'menunggu_pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="menunggu_verifikasi_pembayaran" {{ $status === 'menunggu_verifikasi_pembayaran' ? 'selected' : '' }}>Menunggu Verifikasi Pembayaran</option>
                    <option value="selesai" {{ $status === 'selesai' ? 'selected' : '' }}>Clear</option>
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors">
                    Filter
                </button>
                @if(!empty($status))
                    <a href="{{ route('petugas.pengembalian.index') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-slate-700 border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Peminjam</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Tgl Kembali</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Denda</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Pembayaran</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengembalians as $index => $pengembalian)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $pengembalians->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-slate-800">{{ $pengembalian->peminjaman->user->name }}</div>
                                <div class="text-xs text-slate-500">#{{ str_pad($pengembalian->peminjaman->id_peminjaman, 6, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $pengembalian->tanggal_kembali_real->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <x-badge :status="$pengembalian->status" />
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold {{ $pengembalian->denda > 0 ? 'text-rose-700' : 'text-emerald-700' }}">
                                Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                {{ $pengembalian->metode_pembayaran_label }}
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <div class="inline-flex items-center justify-center gap-2">
                                    @if($pengembalian->status === 'menunggu_approval')
                                        <a href="{{ route('petugas.pengembalian.approval', $pengembalian->id) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold text-emerald-700 bg-emerald-100 hover:bg-emerald-200 transition-colors" title="Cek Kondisi Peminjaman">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Cek Pengembalian
                                        </a>
                                    @elseif($pengembalian->status === 'menunggu_verifikasi_pembayaran')
                                        <a href="{{ route('petugas.pengembalian.approval', $pengembalian->id) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold text-emerald-700 bg-emerald-100 hover:bg-emerald-200 transition-colors" title="Verifikasi Denda">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Verifikasi Denda
                                        </a>
                                    @endif
                                    
                                    <a href="{{ route('petugas.pengembalian.show', $pengembalian->id) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold text-indigo-700 bg-indigo-50 hover:bg-indigo-100 transition-colors" title="Detail Pengembalian">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <p class="text-slate-600 font-medium">Belum ada data pengembalian</p>
                                <p class="text-sm text-slate-400 mt-1">Data akan muncul setelah peminjam mengajukan pengembalian.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pengembalians->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $pengembalians->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>
