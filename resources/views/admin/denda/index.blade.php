<x-layouts.app title="Kelola Denda">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    @php
        $shownDenda = $dendas->count();
        $aktifDenda = $dendas->where('is_active', true)->count();
        $nonaktifDenda = max($shownDenda - $aktifDenda, 0);
        $maksDenda = $dendas->max('jumlah_denda') ?: 0;
    @endphp

    <!-- Header Banner -->
    <div class="mb-6 rounded-2xl border border-emerald-200/50 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 px-5 py-6 shadow-lg shadow-emerald-300/30 sm:px-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="inline-flex items-center rounded-full bg-white/20 px-3 py-1 text-xs font-semibold text-white ring-1 ring-white/40">
                    Pengaturan Denda
                </p>
                <h1 class="mt-3 text-2xl font-bold text-white sm:text-3xl">Kelola Denda</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Atur nominal denda harian untuk keterlambatan pengembalian.</p>
            </div>

            @if($canCreate)
                <a href="{{ route('admin.denda.create') }}" class="inline-flex items-center justify-center rounded-xl border border-white/35 bg-white/15 px-4 py-2.5 text-sm font-semibold text-white backdrop-blur-sm transition-all hover:-translate-y-0.5 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/60 focus:ring-offset-2 focus:ring-offset-emerald-500">
                    <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Denda
                </a>
            @else
                <button disabled class="inline-flex cursor-not-allowed items-center justify-center rounded-xl border border-white/25 bg-white/15 px-4 py-2.5 text-sm font-semibold text-white/70" title="Denda sudah ada, hanya bisa ada 1 denda dalam sistem">
                    <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Denda
                </button>
            @endif
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-teal-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Total Konfigurasi</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $dendaCount }}</p>
            <p class="mt-1 text-xs text-slate-500">Maksimal 1 konfigurasi aktif</p>
        </div>

        <div class="rounded-xl border border-cyan-200 bg-gradient-to-br from-cyan-50 to-sky-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-cyan-700">Data Ditampilkan</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $shownDenda }}</p>
            <p class="mt-1 text-xs text-slate-500">Data pada halaman ini</p>
        </div>

        <div class="rounded-xl border border-lime-200 bg-gradient-to-br from-lime-50 to-emerald-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-lime-700">Status Aktif</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $aktifDenda }}</p>
            <p class="mt-1 text-xs text-slate-500">Konfigurasi siap dipakai</p>
        </div>

        <div class="rounded-xl border border-amber-200 bg-gradient-to-br from-amber-50 to-orange-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-amber-700">Denda Tertinggi</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">Rp {{ number_format($maksDenda, 0, ',', '.') }}</p>
            <p class="mt-1 text-xs text-slate-500">Per hari keterlambatan</p>
        </div>
    </div>

    @if($dendaCount > 0)
        <div class="mb-5 flex items-start rounded-xl border border-blue-200 bg-blue-50 p-4">
            <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="ml-3 text-sm text-blue-800">Sistem memiliki <strong>{{ $dendaCount }}</strong> konfigurasi denda. Hanya satu denda yang dapat disimpan. Anda bisa edit atau hapus konfigurasi yang ada.</p>
        </div>
    @endif

    <x-card class="mb-5 border border-emerald-100 bg-gradient-to-r from-emerald-50/70 via-white to-cyan-50/70 shadow-sm">
        <div class="relative">
            <svg class="absolute left-4 top-3 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
                type="text"
                id="search-input"
                placeholder="Cari nama denda atau deskripsi di halaman ini..."
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
                <table class="min-w-full" id="denda-table">
                    <thead>
                        <tr class="border-b border-slate-200 bg-gradient-to-r from-slate-50 via-emerald-50/40 to-slate-50">
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">No</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Nama Denda</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Jumlah/Hari</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Deskripsi</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Status</th>
                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="table-body">
                        @forelse($dendas as $index => $denda)
                            <tr
                                class="denda-row transition-colors hover:bg-emerald-50/40"
                                data-nama="{{ strtolower($denda->nama_denda) }}"
                                data-deskripsi="{{ strtolower($denda->deskripsi ?? '') }}"
                            >
                                <td class="whitespace-nowrap px-5 py-3.5 text-sm text-slate-500">
                                    {{ $dendas->firstItem() + $index }}
                                </td>

                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 text-white shadow">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-semibold text-slate-800">{{ $denda->nama_denda }}</p>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <span class="inline-flex items-center rounded-lg bg-emerald-100 px-3 py-1.5 text-sm font-semibold text-emerald-700">
                                        Rp {{ number_format($denda->jumlah_denda, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td class="px-5 py-3.5 text-sm text-slate-600">
                                    {{ Str::limit($denda->deskripsi ?? 'Tidak ada deskripsi', 70) }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5">
                                    @if($denda->is_active)
                                        <span class="inline-flex items-center rounded-lg bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.denda.edit', $denda) }}" class="rounded-lg bg-amber-50/80 p-2 text-amber-500 transition-colors duration-200 hover:bg-amber-100 hover:text-amber-700" title="Edit Denda">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.denda.destroy', $denda) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="button"
                                                class="delete-btn rounded-lg bg-rose-50/80 p-2 text-rose-500 transition-colors duration-200 hover:bg-rose-100 hover:text-rose-700"
                                                title="Hapus Denda"
                                                data-denda-name="{{ $denda->nama_denda }}"
                                            >
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-14 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                                            <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                            </svg>
                                        </div>
                                        <p class="mb-1 font-medium text-slate-500">Belum ada konfigurasi denda</p>
                                        <p class="mb-4 text-sm text-slate-400">Tambahkan denda untuk mengaktifkan perhitungan keterlambatan.</p>
                                        @if($canCreate)
                                            <a href="{{ route('admin.denda.create') }}" class="inline-flex items-center rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-emerald-700">
                                                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Tambah Denda
                                            </a>
                                        @endif
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
                    <p class="text-sm text-slate-400">Coba kata kunci lain.</p>
                </div>
            </div>
        </div>

        @if($dendas->hasPages())
            <div class="border-t border-slate-100 px-5 py-4">
                {{ $dendas->links() }}
            </div>
        @endif
    </x-card>

    <!-- Delete Modal -->
    <div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-sm rounded-lg bg-white shadow-xl">
            <div class="border-b border-slate-100 p-6">
                <h3 class="flex items-center gap-3 text-lg font-bold text-slate-800">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-rose-100">
                        <svg class="h-6 w-6 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    Hapus Denda?
                </h3>
            </div>
            <div class="p-6">
                <p class="mb-2 text-slate-600">Yakin ingin menghapus <strong id="delete-denda-name" class="text-slate-800">denda ini</strong>?</p>
                <p class="text-sm text-slate-500">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="flex justify-end gap-3 border-t border-slate-100 p-6">
                <button type="button" id="cancel-delete" class="rounded-lg border border-slate-300 px-4 py-2 font-semibold text-slate-700 transition-colors hover:bg-slate-50">
                    Batal
                </button>
                <button type="button" id="confirm-delete" class="rounded-lg bg-rose-600 px-4 py-2 font-semibold text-white transition-colors hover:bg-rose-700">
                    Hapus
                </button>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div id="success-toast" class="fixed bottom-4 right-4 z-40 hidden items-center gap-3 rounded-lg bg-emerald-500 px-6 py-4 text-white shadow-lg">
        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <span id="success-toast-message">Operasi berhasil</span>
    </div>

    <div id="error-toast" class="fixed bottom-4 right-4 z-40 hidden items-center gap-3 rounded-lg bg-rose-500 px-6 py-4 text-white shadow-lg">
        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-4a1 1 0 112 0 1 1 0 01-2 0zm2-8a1 1 0 10-2 0v6a1 1 0 102 0V6z" clip-rule="evenodd" />
        </svg>
        <span id="error-toast-message">Terjadi kesalahan</span>
    </div>

    <script>
        const searchInput = document.getElementById('search-input');
        const clearSearchBtn = document.getElementById('clear-search');
        const tableBody = document.getElementById('table-body');
        const rows = document.querySelectorAll('.denda-row');
        const noResults = document.getElementById('no-results');

        function runSearchFilter() {
            if (!searchInput || rows.length === 0) {
                return;
            }

            const keyword = searchInput.value.toLowerCase().trim();
            let visible = 0;

            rows.forEach((row) => {
                const nama = row.dataset.nama || '';
                const deskripsi = row.dataset.deskripsi || '';
                const match = keyword === '' || nama.includes(keyword) || deskripsi.includes(keyword);

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

        const deleteModal = document.getElementById('delete-modal');
        const deleteDendaName = document.getElementById('delete-denda-name');
        const cancelDeleteBtn = document.getElementById('cancel-delete');
        const confirmDeleteBtn = document.getElementById('confirm-delete');
        let pendingDeleteForm = null;

        document.querySelectorAll('.delete-btn').forEach((button) => {
            button.addEventListener('click', function() {
                deleteDendaName.textContent = this.dataset.dendaName || 'denda ini';
                pendingDeleteForm = this.closest('form');
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            });
        });

        if (cancelDeleteBtn) {
            cancelDeleteBtn.addEventListener('click', function() {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
                pendingDeleteForm = null;
            });
        }

        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', function() {
                if (pendingDeleteForm) {
                    pendingDeleteForm.submit();
                }
            });
        }

        if (deleteModal) {
            deleteModal.addEventListener('click', function(event) {
                if (event.target === deleteModal && cancelDeleteBtn) {
                    cancelDeleteBtn.click();
                }
            });
        }

        @if(session('success'))
            const successToast = document.getElementById('success-toast');
            const successToastMessage = document.getElementById('success-toast-message');
            successToastMessage.textContent = @json(session('success'));
            successToast.classList.remove('hidden');

            setTimeout(() => {
                successToast.classList.add('hidden');
            }, 4000);
        @endif

        @if(session('error'))
            const errorToast = document.getElementById('error-toast');
            const errorToastMessage = document.getElementById('error-toast-message');
            errorToastMessage.textContent = @json(session('error'));
            errorToast.classList.remove('hidden');

            setTimeout(() => {
                errorToast.classList.add('hidden');
            }, 4500);
        @endif
    </script>
</x-layouts.app>
