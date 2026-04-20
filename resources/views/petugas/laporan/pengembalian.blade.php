<x-layouts.app title="Laporan Pengembalian">
    <x-slot:sidebar>
        @include('partials.petugas-sidebar')
    </x-slot:sidebar>

    @php
        $totalData = $pengembalians->total();
        $shownData = $pengembalians->count();
        $withFine = $pengembalians->where('denda', '>', 0)->count();
        $clearCount = $pengembalians->where('denda_lunas', true)->count();
        $totalFineOnPage = $pengembalians->sum('denda');
    @endphp

    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <nav class="flex items-center text-sm text-slate-500 mb-2">
                <a href="{{ route('petugas.laporan.index') }}" class="hover:text-indigo-600 transition-colors">Laporan</a>
                <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-slate-700 font-medium">Pengembalian</span>
            </nav>
            <h1 class="text-2xl font-bold text-slate-800">Laporan Pengembalian</h1>
            <p class="mt-1 text-slate-500">Mencakup approval kondisi dan status pembayaran denda</p>
        </div>
        <a href="{{ route('petugas.laporan.pengembalian.print', ['status' => $status]) }}" target="_blank" class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold text-sm hover:from-emerald-700 hover:to-teal-700 transition-all duration-200">
            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Cetak Laporan
        </a>
    </div>

    <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-5">
        <div class="rounded-xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-teal-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Total Data</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalData }}</p>
        </div>
        <div class="rounded-xl border border-cyan-200 bg-gradient-to-br from-cyan-50 to-sky-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-cyan-700">Data Ditampilkan</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $shownData }}</p>
        </div>
        <div class="rounded-xl border border-rose-200 bg-gradient-to-br from-rose-50 to-pink-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-rose-700">Dengan Denda</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $withFine }}</p>
        </div>
        <div class="rounded-xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-lime-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Denda Clear</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $clearCount }}</p>
        </div>
        <div class="rounded-xl border border-amber-200 bg-gradient-to-br from-amber-50 to-orange-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-amber-700">Total Denda</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">Rp {{ number_format($totalFineOnPage, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 p-6 mb-6">
        <form method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Filter Status Workflow</label>
                <select name="status" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                    <option value="">Semua Status</option>
                    <option value="menunggu_approval" {{ $status === 'menunggu_approval' ? 'selected' : '' }}>Menunggu Approval</option>
                    <option value="menunggu_pembayaran" {{ $status === 'menunggu_pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                    <option value="menunggu_verifikasi_pembayaran" {{ $status === 'menunggu_verifikasi_pembayaran' ? 'selected' : '' }}>Menunggu Verifikasi Pembayaran</option>
                    <option value="selesai" {{ $status === 'selesai' ? 'selected' : '' }}>Clear</option>
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition-colors">
                    Filter
                </button>
                @if(!empty($status))
                    <a href="{{ route('petugas.laporan.pengembalian') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-slate-700 border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
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
                    <tr class="bg-slate-50/80 border-b border-slate-200">
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Peminjam</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Tgl Kembali</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Denda</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Status Denda</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Metode</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Petugas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengembalians as $index => $pengembalian)
                        <tr class="hover:bg-emerald-50/30 transition-colors duration-150">
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $pengembalians->firstItem() + $index }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-slate-800">{{ $pengembalian->peminjaman->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $pengembalian->tanggal_kembali_real->format('d M Y') }}</td>
                            <td class="px-6 py-4"><x-badge :status="$pengembalian->status" /></td>
                            <td class="px-6 py-4 text-sm font-semibold {{ $pengembalian->denda > 0 ? 'text-rose-700' : 'text-emerald-700' }}">Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if($pengembalian->denda_lunas)
                                    <span class="inline-flex items-center rounded-lg bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Lunas</span>
                                @else
                                    <span class="inline-flex items-center rounded-lg bg-rose-100 px-2.5 py-1 text-xs font-semibold text-rose-700">Belum Lunas</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $pengembalian->metode_pembayaran_label }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $pengembalian->petugas?->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-16 text-center text-slate-500">Tidak ada data pengembalian</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pengembalians->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $pengembalians->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>
