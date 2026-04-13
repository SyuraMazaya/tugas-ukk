<x-layouts.app title="Laporan Pengembalian">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    @php
        $totalData = $pengembalians->total();
        $shownData = $pengembalians->count();
        $withFine = $pengembalians->where('denda', '>', 0)->count();
        $totalFineOnPage = $pengembalians->sum('denda');
    @endphp

    <!-- Header Banner -->
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
                <p class="mt-1 text-sm text-white/90 sm:text-base">Kelola data pengembalian alat, denda, dan catatan kondisi barang.</p>
            </div>

            <a href="{{ route('admin.laporan.pengembalian.print') }}" target="_blank" class="inline-flex items-center justify-center rounded-xl border border-white/35 bg-white/15 px-4 py-2.5 text-sm font-semibold text-white backdrop-blur-sm transition-all hover:-translate-y-0.5 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/60 focus:ring-offset-2 focus:ring-offset-emerald-500">
                <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Laporan
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-teal-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Total Data</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalData }}</p>
            <p class="mt-1 text-xs text-slate-500">Semua data pengembalian</p>
        </div>

        <div class="rounded-xl border border-cyan-200 bg-gradient-to-br from-cyan-50 to-sky-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-cyan-700">Data Ditampilkan</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $shownData }}</p>
            <p class="mt-1 text-xs text-slate-500">Data pada halaman ini</p>
        </div>

        <div class="rounded-xl border border-rose-200 bg-gradient-to-br from-rose-50 to-pink-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-rose-700">Dengan Denda</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $withFine }}</p>
            <p class="mt-1 text-xs text-slate-500">Pengembalian terkena denda</p>
        </div>

        <div class="rounded-xl border border-amber-200 bg-gradient-to-br from-amber-50 to-orange-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-amber-700">Total Denda</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">Rp {{ number_format($totalFineOnPage, 0, ',', '.') }}</p>
            <p class="mt-1 text-xs text-slate-500">Akumulasi pada halaman ini</p>
        </div>
    </div>

    <x-card class="mb-5 border border-emerald-100 bg-gradient-to-r from-emerald-50/70 via-white to-cyan-50/70 shadow-sm">
        <div class="relative">
            <svg class="absolute left-4 top-3 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
                type="text"
                id="search-input"
                placeholder="Cari peminjam, petugas, tanggal, atau catatan kondisi..."
                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-11 text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
            />
            <button id="clear-search" class="absolute right-3 top-3 hidden text-slate-400 transition-colors hover:text-slate-600" title="Hapus pencarian" type="button">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </x-card>

    <x-card class="overflow-hidden border border-slate-100 shadow-sm">
        <div class="h-1.5 bg-gradient-to-r from-emerald-400 via-teal-400 to-cyan-500"></div>

        <div id="table-container">
            <div class="overflow-x-auto">
                <table class="min-w-full" id="pengembalian-table">
                    <thead>
                        <tr class="border-b border-slate-200 bg-gradient-to-r from-slate-50 via-emerald-50/50 to-slate-50">
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">No</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Peminjam</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Tgl Kembali</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Denda</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Petugas</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="table-body">
                        @forelse($pengembalians as $index => $pengembalian)
                            @php
                                $peminjamName = $pengembalian->peminjaman->user->name ?? 'User Tidak Ditemukan';
                                $petugasName = $pengembalian->petugas->name ?? 'Petugas Tidak Ditemukan';
                                $catatan = $pengembalian->catatan_kondisi ?? '-';
                            @endphp
                            <tr
                                class="pengembalian-row transition-colors hover:bg-emerald-50/40"
                                data-peminjam="{{ strtolower($peminjamName) }}"
                                data-petugas="{{ strtolower($petugasName) }}"
                                data-tanggal="{{ strtolower($pengembalian->tanggal_kembali_real->format('d M Y')) }}"
                                data-catatan="{{ strtolower($catatan) }}"
                                data-denda="{{ strtolower((string) $pengembalian->denda) }}"
                            >
                                <td class="whitespace-nowrap px-5 py-3.5 text-sm text-slate-500">
                                    {{ $pengembalians->firstItem() + $index }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <div class="flex items-center">
                                        <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 text-sm font-semibold text-white">
                                            {{ strtoupper(substr($peminjamName, 0, 1)) }}
                                        </div>
                                        <div class="ml-3 text-sm font-semibold text-slate-800">{{ $peminjamName }}</div>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5 text-sm text-slate-600">
                                    <div class="inline-flex items-center">
                                        <svg class="mr-1.5 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v2m10-2v2M4 10h16M6 7h12a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2z" />
                                        </svg>
                                        {{ $pengembalian->tanggal_kembali_real->format('d M Y') }}
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5">
                                    @if($pengembalian->denda > 0)
                                        <span class="inline-flex items-center rounded-lg bg-rose-50 px-2.5 py-1 text-sm font-semibold text-rose-700">
                                            Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-sm text-slate-500">Rp 0</span>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <span class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700">
                                        {{ $petugasName }}
                                    </span>
                                </td>

                                <td class="max-w-xs px-5 py-3.5 text-sm text-slate-500">
                                    <span class="line-clamp-2">{{ $catatan }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-14 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                                            <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                                            </svg>
                                        </div>
                                        <p class="mb-1 font-medium text-slate-500">Tidak ada data pengembalian</p>
                                        <p class="text-sm text-slate-400">Data pengembalian akan ditampilkan di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div id="no-results" class="hidden px-5 py-14 text-center">
                <div class="flex flex-col items-center">
                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100">
                        <svg class="h-8 w-8 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <p class="mb-1 font-medium text-slate-500">Tidak ada hasil pencarian</p>
                    <p class="text-sm text-slate-400">Gunakan kata kunci lain untuk mencari data pengembalian.</p>
                </div>
            </div>
        </div>

        @if($pengembalians->hasPages())
            <div class="border-t border-slate-100 px-5 py-4">
                {{ $pengembalians->appends(request()->query())->links() }}
            </div>
        @endif
    </x-card>

    <script>
        const searchInput = document.getElementById('search-input');
        const clearSearchBtn = document.getElementById('clear-search');
        const tableBody = document.getElementById('table-body');
        const rows = document.querySelectorAll('.pengembalian-row');
        const noResults = document.getElementById('no-results');

        function runSearchFilter() {
            if (!searchInput || rows.length === 0) {
                return;
            }

            const keyword = searchInput.value.toLowerCase().trim();
            let visible = 0;

            rows.forEach((row) => {
                const peminjam = row.dataset.peminjam || '';
                const petugas = row.dataset.petugas || '';
                const tanggal = row.dataset.tanggal || '';
                const catatan = row.dataset.catatan || '';
                const denda = row.dataset.denda || '';

                const match = keyword === ''
                    || peminjam.includes(keyword)
                    || petugas.includes(keyword)
                    || tanggal.includes(keyword)
                    || catatan.includes(keyword)
                    || denda.includes(keyword);

                if (match) {
                    row.style.display = '';
                    visible++;
                } else {
                    row.style.display = 'none';
                }
            });

            if (visible === 0) {
                tableBody.style.display = 'none';
                noResults.classList.remove('hidden');
            } else {
                tableBody.style.display = '';
                noResults.classList.add('hidden');
            }
        }

        if (searchInput && clearSearchBtn) {
            searchInput.addEventListener('input', function() {
                clearSearchBtn.classList.toggle('hidden', this.value === '');
                runSearchFilter();
            });

            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                clearSearchBtn.classList.add('hidden');
                runSearchFilter();
                searchInput.focus();
            });
        }
    </script>
</x-layouts.app>