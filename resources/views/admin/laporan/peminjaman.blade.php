<x-layouts.app title="Laporan Peminjaman">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    @php
        $totalData = $peminjamans->total();
        $shownData = $peminjamans->count();
        $pendingOnPage = $peminjamans->where('status', 'pending')->count();
        $disetujuiOnPage = $peminjamans->where('status', 'disetujui')->count();
    @endphp

    <!-- Header Banner -->
    <div class="mb-6 rounded-2xl border border-indigo-200/60 bg-gradient-to-r from-indigo-500 via-blue-500 to-cyan-500 px-5 py-6 shadow-lg shadow-indigo-300/30 sm:px-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <nav class="mb-3 flex items-center text-sm text-white/85">
                    <a href="{{ route('admin.laporan.index') }}" class="font-medium transition-colors hover:text-white">Laporan</a>
                    <svg class="mx-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="font-semibold text-white">Peminjaman</span>
                </nav>
                <h1 class="text-2xl font-bold text-white sm:text-3xl">Laporan Peminjaman</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Pantau data pengajuan, persetujuan, dan progres peminjaman alat.</p>
            </div>

            <a href="{{ route('admin.laporan.peminjaman.print', ['status' => $status]) }}" target="_blank" class="inline-flex items-center justify-center rounded-xl border border-white/35 bg-white/15 px-4 py-2.5 text-sm font-semibold text-white backdrop-blur-sm transition-all hover:-translate-y-0.5 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/60 focus:ring-offset-2 focus:ring-offset-indigo-500">
                <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Laporan
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-indigo-200 bg-gradient-to-br from-indigo-50 to-blue-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-indigo-700">Total Data</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalData }}</p>
            <p class="mt-1 text-xs text-slate-500">Semua data pada sistem</p>
        </div>

        <div class="rounded-xl border border-cyan-200 bg-gradient-to-br from-cyan-50 to-sky-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-cyan-700">Data Ditampilkan</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $shownData }}</p>
            <p class="mt-1 text-xs text-slate-500">Data pada halaman ini</p>
        </div>

        <div class="rounded-xl border border-amber-200 bg-gradient-to-br from-amber-50 to-orange-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-amber-700">Pending</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $pendingOnPage }}</p>
            <p class="mt-1 text-xs text-slate-500">Menunggu persetujuan</p>
        </div>

        <div class="rounded-xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-teal-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Disetujui</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $disetujuiOnPage }}</p>
            <p class="mt-1 text-xs text-slate-500">Peminjaman aktif berjalan</p>
        </div>
    </div>

    <!-- Filter and Search -->
    <x-card class="mb-5 border border-indigo-100 bg-gradient-to-r from-indigo-50/70 via-white to-cyan-50/70 shadow-sm">
        <form method="GET" class="grid grid-cols-1 gap-4 lg:grid-cols-12">
            <div class="lg:col-span-6">
                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-600">Filter Status</label>
                <select name="status" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="disetujui" {{ $status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ $status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="selesai" {{ $status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="lg:col-span-6 lg:self-end">
                <div class="flex flex-wrap gap-2">
                    <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition-all hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Terapkan Filter
                    </button>
                    @if(request()->has('status') && request('status') !== '')
                        <a href="{{ route('admin.laporan.peminjaman') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition-colors hover:bg-slate-50">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <div class="mt-4 relative">
            <svg class="absolute left-4 top-3 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
                type="text"
                id="search-input"
                placeholder="Cari peminjam, status, atau nama alat di halaman ini..."
                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-11 text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
            />
            <button id="clear-search" class="absolute right-3 top-3 hidden text-slate-400 transition-colors hover:text-slate-600" title="Hapus pencarian" type="button">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </x-card>

    <x-card class="overflow-hidden border border-slate-100 shadow-sm">
        <div class="h-1.5 bg-gradient-to-r from-indigo-400 via-blue-400 to-cyan-500"></div>

        <div id="table-container">
            <div class="overflow-x-auto">
                <table class="min-w-full" id="peminjaman-table">
                    <thead>
                        <tr class="border-b border-slate-200 bg-gradient-to-r from-slate-50 via-indigo-50/40 to-slate-50">
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">No</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Peminjam</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Tanggal Pinjam</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Tanggal Kembali</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Alat</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="table-body">
                        @forelse($peminjamans as $index => $peminjaman)
                            @php
                                $userName = $peminjaman->user->name ?? 'User Tidak Ditemukan';
                                $userUsername = $peminjaman->user->username ?? '-';
                                $alatNames = $peminjaman->detailPeminjaman->pluck('alat.nama_alat')->filter()->implode(' ');
                            @endphp
                            <tr
                                class="peminjaman-row transition-colors hover:bg-indigo-50/30"
                                data-user="{{ strtolower($userName) }}"
                                data-status="{{ strtolower($peminjaman->status) }}"
                                data-alat="{{ strtolower($alatNames) }}"
                                data-tanggal-pinjam="{{ strtolower($peminjaman->tanggal_pinjam->format('d M Y')) }}"
                                data-tanggal-kembali="{{ strtolower($peminjaman->tanggal_kembali_rencana->format('d M Y')) }}"
                            >
                                <td class="whitespace-nowrap px-5 py-3.5 text-sm text-slate-500">
                                    {{ $peminjamans->firstItem() + $index }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <div class="flex items-center">
                                        <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 text-sm font-semibold text-white">
                                            {{ strtoupper(substr($userName, 0, 1)) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-semibold text-slate-800">{{ $userName }}</div>
                                            <div class="font-mono text-xs text-slate-400">{{ $userUsername }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5 text-sm text-slate-600">
                                    <div class="inline-flex items-center">
                                        <svg class="mr-1.5 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v2m10-2v2M4 10h16M6 7h12a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2z" />
                                        </svg>
                                        {{ $peminjaman->tanggal_pinjam->format('d M Y') }}
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5 text-sm text-slate-600">
                                    <div class="inline-flex items-center">
                                        <svg class="mr-1.5 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v2m10-2v2M4 10h16M6 7h12a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2z" />
                                        </svg>
                                        {{ $peminjaman->tanggal_kembali_rencana->format('d M Y') }}
                                    </div>
                                </td>

                                <td class="px-5 py-3.5">
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($peminjaman->detailPeminjaman as $detail)
                                            <span class="inline-flex items-center rounded-md bg-slate-100 px-2 py-1 text-xs font-medium text-slate-700">
                                                {{ $detail->alat->nama_alat }}
                                                <span class="ml-1.5 rounded bg-slate-200 px-1.5 py-0.5 text-slate-600">{{ $detail->jumlah }}</span>
                                            </span>
                                        @endforeach
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <x-badge :status="$peminjaman->status" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-14 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                                            <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                                            </svg>
                                        </div>
                                        <p class="mb-1 font-medium text-slate-500">Tidak ada data peminjaman</p>
                                        <p class="text-sm text-slate-400">Coba ubah filter untuk melihat data lainnya.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div id="no-results" class="hidden px-5 py-14 text-center">
                <div class="flex flex-col items-center">
                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-indigo-100">
                        <svg class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <p class="mb-1 font-medium text-slate-500">Tidak ada hasil pencarian</p>
                    <p class="text-sm text-slate-400">Gunakan kata kunci yang berbeda.</p>
                </div>
            </div>
        </div>

        @if($peminjamans->hasPages())
            <div class="border-t border-slate-100 px-5 py-4">
                {{ $peminjamans->appends(request()->query())->links() }}
            </div>
        @endif
    </x-card>

    <script>
        const searchInput = document.getElementById('search-input');
        const clearSearchBtn = document.getElementById('clear-search');
        const tableBody = document.getElementById('table-body');
        const rows = document.querySelectorAll('.peminjaman-row');
        const noResults = document.getElementById('no-results');

        function runSearchFilter() {
            if (!searchInput || rows.length === 0) {
                return;
            }

            const keyword = searchInput.value.toLowerCase().trim();
            let visible = 0;

            rows.forEach((row) => {
                const user = row.dataset.user || '';
                const status = row.dataset.status || '';
                const alat = row.dataset.alat || '';
                const tanggalPinjam = row.dataset.tanggalPinjam || '';
                const tanggalKembali = row.dataset.tanggalKembali || '';

                const match = keyword === ''
                    || user.includes(keyword)
                    || status.includes(keyword)
                    || alat.includes(keyword)
                    || tanggalPinjam.includes(keyword)
                    || tanggalKembali.includes(keyword);

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