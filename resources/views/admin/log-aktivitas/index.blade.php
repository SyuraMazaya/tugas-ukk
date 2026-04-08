<x-layouts.app title="Log Aktivitas">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    @php
        $totalLogs = $logs->total();
        $shownLogs = $logs->count();
        $todayLogs = $logs->filter(fn($log) => $log->created_at->isToday())->count();
        $withDetail = $logs->filter(fn($log) => filled($log->detail_data))->count();
    @endphp

    <!-- Header Banner -->
    <div class="mb-6 rounded-2xl border border-violet-200/60 bg-gradient-to-r from-violet-500 via-fuchsia-500 to-pink-500 px-5 py-6 shadow-lg shadow-violet-300/30 sm:px-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <nav class="mb-3 flex items-center text-sm text-white/85">
                    <a href="{{ route('admin.dashboard') }}" class="font-medium transition-colors hover:text-white">Dashboard</a>
                    <svg class="mx-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="font-semibold text-white">Log Aktivitas</span>
                </nav>
                <h1 class="text-2xl font-bold text-white sm:text-3xl">Log Aktivitas</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Pantau jejak aktivitas pengguna dan aksi sistem secara real-time.</p>
            </div>
            <div class="inline-flex items-center gap-2 rounded-xl border border-white/25 bg-white/15 px-4 py-2 text-white backdrop-blur-sm">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                <span class="text-sm font-semibold">Audit Trail</span>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-violet-200 bg-gradient-to-br from-violet-50 to-fuchsia-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-violet-700">Total Log</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalLogs }}</p>
            <p class="mt-1 text-xs text-slate-500">Keseluruhan aktivitas tersimpan</p>
        </div>

        <div class="rounded-xl border border-cyan-200 bg-gradient-to-br from-cyan-50 to-blue-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-cyan-700">Data Ditampilkan</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $shownLogs }}</p>
            <p class="mt-1 text-xs text-slate-500">Aktivitas pada halaman ini</p>
        </div>

        <div class="rounded-xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-teal-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Aktivitas Hari Ini</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $todayLogs }}</p>
            <p class="mt-1 text-xs text-slate-500">Terjadi pada tanggal ini</p>
        </div>

        <div class="rounded-xl border border-amber-200 bg-gradient-to-br from-amber-50 to-orange-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-amber-700">Dengan Detail</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $withDetail }}</p>
            <p class="mt-1 text-xs text-slate-500">Log yang punya metadata</p>
        </div>
    </div>

    <x-card class="mb-5 border border-violet-100 bg-gradient-to-r from-violet-50/70 via-white to-fuchsia-50/70 shadow-sm">
        <div class="relative">
            <svg class="absolute left-4 top-3 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
                type="text"
                id="search-input"
                placeholder="Cari aktivitas, nama user, atau waktu di halaman ini..."
                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-11 text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-violet-500 focus:outline-none focus:ring-2 focus:ring-violet-500/20"
            />
            <button id="clear-search" class="absolute right-3 top-3 hidden text-slate-400 transition-colors hover:text-slate-600" title="Hapus pencarian" type="button">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </x-card>

    <x-card class="overflow-hidden border border-slate-100 shadow-sm">
        <div class="h-1.5 bg-gradient-to-r from-violet-400 via-fuchsia-400 to-pink-400"></div>

        <div id="table-container">
            <div class="overflow-x-auto">
                <table class="min-w-full" id="log-table">
                    <thead>
                        <tr class="border-b border-slate-200 bg-gradient-to-r from-slate-50 via-violet-50/40 to-slate-50">
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Waktu</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">User</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Aktivitas</th>
                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="table-body">
                        @forelse($logs as $log)
                            @php
                                $userName = $log->user->name ?? 'Sistem';
                                $username = $log->user->username ?? 'system';
                                $aktivitasLower = strtolower($log->aktivitas);

                                $badgeClass = 'bg-slate-100 text-slate-700';

                                if (str_contains($aktivitasLower, 'hapus')) {
                                    $badgeClass = 'bg-rose-100 text-rose-700';
                                } elseif (str_contains($aktivitasLower, 'update') || str_contains($aktivitasLower, 'ubah')) {
                                    $badgeClass = 'bg-blue-100 text-blue-700';
                                } elseif (str_contains($aktivitasLower, 'buat') || str_contains($aktivitasLower, 'tambah')) {
                                    $badgeClass = 'bg-emerald-100 text-emerald-700';
                                }
                            @endphp
                            <tr
                                class="log-row transition-colors hover:bg-violet-50/40"
                                data-user="{{ strtolower($userName) }}"
                                data-aktivitas="{{ strtolower($log->aktivitas) }}"
                                data-waktu="{{ strtolower($log->created_at->format('d M Y H:i:s')) }}"
                            >
                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <div class="flex items-center text-sm">
                                        <svg class="mr-2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="font-medium text-slate-700">{{ $log->created_at->format('d M Y') }}</span>
                                        <span class="ml-1 text-slate-400">{{ $log->created_at->format('H:i:s') }}</span>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <div class="flex items-center">
                                        <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-slate-500 to-slate-700 text-sm font-semibold text-white">
                                            {{ strtoupper(substr($userName, 0, 1)) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-semibold text-slate-800">{{ $userName }}</div>
                                            <div class="font-mono text-xs text-slate-400">{{ $username }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-3.5">
                                    <span class="inline-flex items-center rounded-lg px-2.5 py-1 text-sm font-semibold {{ $badgeClass }}">
                                        {{ $log->aktivitas }}
                                    </span>
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5 text-right">
                                    @if($log->detail_data)
                                        <button
                                            type="button"
                                            class="detail-btn inline-flex items-center rounded-lg bg-violet-50 px-3 py-1.5 text-sm font-semibold text-violet-600 transition-colors hover:bg-violet-100 hover:text-violet-800"
                                            data-title="{{ $log->aktivitas }} - {{ $userName }}"
                                            data-detail='@json($log->detail_data)'
                                        >
                                            <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat
                                        </button>
                                    @else
                                        <span class="text-sm text-slate-400">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-14 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                                            <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                                            </svg>
                                        </div>
                                        <p class="mb-1 font-medium text-slate-500">Tidak ada log aktivitas</p>
                                        <p class="text-sm text-slate-400">Riwayat aktivitas akan ditampilkan di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div id="no-results" class="hidden px-5 py-14 text-center">
                <div class="flex flex-col items-center">
                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-violet-100">
                        <svg class="h-8 w-8 text-violet-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <p class="mb-1 font-medium text-slate-500">Tidak ada hasil pencarian</p>
                    <p class="text-sm text-slate-400">Coba kata kunci lain.</p>
                </div>
            </div>
        </div>

        @if($logs->hasPages())
            <div class="border-t border-slate-100 px-5 py-4">
                {{ $logs->links() }}
            </div>
        @endif
    </x-card>

    <!-- Detail Modal -->
    <div id="detail-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-lg bg-white shadow-xl">
            <div class="flex items-center justify-between border-b border-slate-100 p-5">
                <h3 id="detail-title" class="text-lg font-bold text-slate-800">Detail Aktivitas</h3>
                <button type="button" id="close-detail" class="rounded-lg p-1 text-slate-400 transition-colors hover:bg-slate-100 hover:text-slate-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="max-h-[70vh] overflow-auto p-5">
                <pre id="detail-content" class="overflow-auto rounded-lg bg-slate-900 p-4 text-xs leading-relaxed text-emerald-300"></pre>
            </div>

            <div class="flex justify-end border-t border-slate-100 p-5">
                <button type="button" id="close-detail-footer" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition-colors hover:bg-slate-50">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('search-input');
        const clearSearchBtn = document.getElementById('clear-search');
        const tableBody = document.getElementById('table-body');
        const rows = document.querySelectorAll('.log-row');
        const noResults = document.getElementById('no-results');

        function runSearchFilter() {
            if (!searchInput || rows.length === 0) {
                return;
            }

            const keyword = searchInput.value.toLowerCase().trim();
            let visible = 0;

            rows.forEach((row) => {
                const user = row.dataset.user || '';
                const aktivitas = row.dataset.aktivitas || '';
                const waktu = row.dataset.waktu || '';
                const match = keyword === '' || user.includes(keyword) || aktivitas.includes(keyword) || waktu.includes(keyword);

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

        const detailModal = document.getElementById('detail-modal');
        const detailTitle = document.getElementById('detail-title');
        const detailContent = document.getElementById('detail-content');
        const closeDetailBtn = document.getElementById('close-detail');
        const closeDetailFooterBtn = document.getElementById('close-detail-footer');

        function closeDetailModal() {
            detailModal.classList.add('hidden');
            detailModal.classList.remove('flex');
            detailTitle.textContent = 'Detail Aktivitas';
            detailContent.textContent = '';
        }

        document.querySelectorAll('.detail-btn').forEach((button) => {
            button.addEventListener('click', function() {
                const title = this.dataset.title || 'Detail Aktivitas';
                const rawDetail = this.dataset.detail || '{}';

                let parsedDetail;

                try {
                    parsedDetail = JSON.parse(rawDetail);
                } catch (error) {
                    parsedDetail = { raw: rawDetail };
                }

                detailTitle.textContent = title;
                detailContent.textContent = JSON.stringify(parsedDetail, null, 2);
                detailModal.classList.remove('hidden');
                detailModal.classList.add('flex');
            });
        });

        if (closeDetailBtn) {
            closeDetailBtn.addEventListener('click', closeDetailModal);
        }

        if (closeDetailFooterBtn) {
            closeDetailFooterBtn.addEventListener('click', closeDetailModal);
        }

        if (detailModal) {
            detailModal.addEventListener('click', function(event) {
                if (event.target === detailModal) {
                    closeDetailModal();
                }
            });
        }
    </script>
</x-layouts.app>