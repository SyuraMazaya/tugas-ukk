<x-layouts.app title="Laporan Pengembalian">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    @php
        $totalData = $pengembalians->total();
        $shownData = $pengembalians->count();
        $withFine = $pengembalians->where('denda', '>', 0)->count();
        $clearCount = $pengembalians->where('denda_lunas', true)->count();
        $totalFineOnPage = $pengembalians->sum('denda');
    @endphp

    <div class="mb-6 rounded-2xl border border-emerald-200/70 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 px-5 py-6 shadow-lg shadow-emerald-300/30 sm:px-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <nav class="mb-3 flex items-center text-sm text-white/85">
                    <a href="{{ route('admin.laporan.index') }}" class="font-medium transition-colors hover:text-white">Laporan</a>
                    <svg class="mx-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="font-semibold text-white">Pengembalian</span>
                </nav>
                <h1 class="text-2xl font-bold text-white sm:text-3xl">Laporan Pengembalian</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Termasuk approval pengembalian, pembayaran denda, dan status clear.</p>
            </div>

            <a href="{{ route('admin.laporan.pengembalian.print', ['status' => $status]) }}" target="_blank" class="inline-flex items-center justify-center rounded-xl border border-white/35 bg-white/15 px-4 py-2.5 text-sm font-semibold text-white backdrop-blur-sm transition-all hover:-translate-y-0.5 hover:bg-white/20">
                <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Laporan
            </a>
        </div>
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
                    <a href="{{ route('admin.laporan.pengembalian') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-slate-700 border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <x-card class="overflow-hidden border border-slate-100 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-slate-200 bg-gradient-to-r from-slate-50 via-emerald-50/50 to-slate-50">
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">No</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Peminjam</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Tgl Kembali</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Denda</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Status Denda</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Metode</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Petugas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pengembalians as $index => $pengembalian)
                        <tr class="hover:bg-emerald-50/40 transition-colors">
                            <td class="px-5 py-3.5 text-sm text-slate-500">{{ $pengembalians->firstItem() + $index }}</td>
                            <td class="px-5 py-3.5 text-sm font-semibold text-slate-800">{{ $pengembalian->peminjaman->user->name }}</td>
                            <td class="px-5 py-3.5 text-sm text-slate-600">{{ $pengembalian->tanggal_kembali_real->format('d M Y') }}</td>
                            <td class="px-5 py-3.5"><x-badge :status="$pengembalian->status" /></td>
                            <td class="px-5 py-3.5 text-sm font-semibold {{ $pengembalian->denda > 0 ? 'text-rose-700' : 'text-emerald-700' }}">Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
                            <td class="px-5 py-3.5">
                                @if($pengembalian->denda_lunas)
                                    <span class="inline-flex items-center rounded-lg bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">Lunas</span>
                                @else
                                    <span class="inline-flex items-center rounded-lg bg-rose-100 px-2.5 py-1 text-xs font-semibold text-rose-700">Belum Lunas</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-sm text-slate-600">{{ $pengembalian->metode_pembayaran_label }}</td>
                            <td class="px-5 py-3.5 text-sm text-slate-600">{{ $pengembalian->petugas?->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-14 text-center text-slate-500">
                                Tidak ada data pengembalian
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pengembalians->hasPages())
            <div class="border-t border-slate-100 px-5 py-4">
                {{ $pengembalians->appends(request()->query())->links() }}
            </div>
        @endif
    </x-card>
</x-layouts.app>
