<x-layouts.app title="Manajemen Kategori">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    @php
        $totalKategori = $kategoris->total();
        $shownKategori = $kategoris->count();
        $tanpaDeskripsi = $kategoris->filter(fn($kategori) => blank($kategori->deskripsi))->count();
        $totalAlatOnPage = $kategoris->sum('alat_count');
    @endphp

    <!-- Header Banner -->
    <div class="mb-6 rounded-2xl border border-indigo-200/50 bg-gradient-to-r from-indigo-500 via-blue-500 to-fuchsia-500 px-5 py-6 shadow-lg shadow-indigo-300/30 sm:px-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="inline-flex items-center rounded-full bg-white/20 px-3 py-1 text-xs font-semibold text-white ring-1 ring-white/40">
                    Dashboard Kategori
                </p>
                <h1 class="mt-3 text-2xl font-bold text-white sm:text-3xl">Manajemen Kategori</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Kelola kategori alat produktif agar data tetap rapi dan mudah dicari.</p>
            </div>
            <a href="{{ route('admin.kategori.create') }}" class="inline-flex items-center justify-center rounded-xl border border-white/35 bg-white/15 px-4 py-2.5 text-sm font-semibold text-white backdrop-blur-sm transition-all hover:-translate-y-0.5 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/60 focus:ring-offset-2 focus:ring-offset-indigo-500">
                <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Kategori
            </a>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-fuchsia-200 bg-gradient-to-br from-fuchsia-50 to-indigo-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-fuchsia-700">Total Kategori</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalKategori }}</p>
            <p class="mt-1 text-xs text-slate-500">Seluruh kategori terdaftar</p>
        </div>

        <div class="rounded-xl border border-cyan-200 bg-gradient-to-br from-cyan-50 to-blue-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-cyan-700">Kategori Ditampilkan</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $shownKategori }}</p>
            <p class="mt-1 text-xs text-slate-500">Data pada halaman ini</p>
        </div>

        <div class="rounded-xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-teal-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Jumlah Alat</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalAlatOnPage }}</p>
            <p class="mt-1 text-xs text-slate-500">Akumulasi alat halaman ini</p>
        </div>

        <div class="rounded-xl border border-amber-200 bg-gradient-to-br from-amber-50 to-orange-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-amber-700">Tanpa Deskripsi</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $tanpaDeskripsi }}</p>
            <p class="mt-1 text-xs text-slate-500">Kategori yang belum lengkap</p>
        </div>
    </div>

    <!-- Search -->
    <x-card class="mb-5 border border-indigo-100 bg-gradient-to-r from-indigo-50/70 via-white to-fuchsia-50/60 shadow-sm">
        <div id="search-container" class="relative">
            <svg class="absolute left-4 top-3 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
                type="text"
                id="search-input"
                placeholder="Cari nama kategori atau deskripsi di halaman ini..."
                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-11 text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
            />
            <button id="clear-search" class="absolute right-3 top-3 hidden text-slate-400 transition-colors hover:text-slate-600" title="Hapus pencarian">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </x-card>

    <!-- Table -->
    <x-card class="overflow-hidden border border-slate-100 shadow-sm">
        <div class="h-1.5 bg-gradient-to-r from-amber-400 via-orange-400 to-rose-400"></div>

        <div id="table-container">
            <div class="overflow-x-auto">
                <table class="min-w-full" id="kategori-table">
                    <thead>
                        <tr class="border-b border-slate-200 bg-gradient-to-r from-slate-50 via-amber-50/40 to-slate-50">
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">No</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Nama Kategori</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Deskripsi</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Jumlah Alat</th>
                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="table-body">
                        @forelse($kategoris as $index => $kategori)
                            @php
                                $hasDescription = filled($kategori->deskripsi);
                            @endphp
                            <tr
                                class="kategori-row transition-colors hover:bg-amber-50/40"
                                data-kategori-name="{{ strtolower($kategori->nama_kategori) }}"
                                data-kategori-desc="{{ strtolower($kategori->deskripsi ?? '') }}"
                            >
                                <td class="whitespace-nowrap px-5 py-3.5 text-sm text-slate-500">
                                    {{ $kategoris->firstItem() + $index }}
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 text-white shadow">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-800">{{ $kategori->nama_kategori }}</div>
                                            <p class="mt-0.5 text-xs text-slate-500">ID: {{ $kategori->id_kategori }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-sm text-slate-500 max-w-xs">
                                    @if($hasDescription)
                                        <span class="line-clamp-2">{{ $kategori->deskripsi }}</span>
                                    @else
                                        <span class="inline-flex items-center rounded-md bg-amber-100 px-2 py-1 text-xs font-semibold text-amber-700">Belum ada deskripsi</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <span class="inline-flex items-center rounded-lg bg-indigo-50 px-2.5 py-1 text-sm font-semibold text-indigo-700">
                                        {{ $kategori->alat_count }} alat
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-5 py-3.5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.kategori.edit', $kategori->id_kategori) }}" class="rounded-lg bg-indigo-50/60 p-2 text-indigo-500 transition-colors duration-200 hover:bg-indigo-100 hover:text-indigo-700" title="Edit Kategori">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form method="POST" action="{{ route('admin.kategori.destroy', $kategori->id_kategori) }}" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="button"
                                                class="delete-btn rounded-lg bg-rose-50/60 p-2 text-rose-500 transition-colors duration-200 hover:bg-rose-100 hover:text-rose-700"
                                                title="Hapus Kategori"
                                                data-kategori-name="{{ $kategori->nama_kategori }}"
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
                                <td colspan="5" class="px-5 py-14 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                                            <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <p class="mb-1 font-medium text-slate-500">Tidak ada data kategori</p>
                                        <p class="mb-4 text-sm text-slate-400">Mulai dengan menambahkan kategori pertama</p>
                                        <a href="{{ route('admin.kategori.create') }}" class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-indigo-700">
                                            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Tambah Kategori
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div id="no-results" class="hidden px-5 py-14 text-center">
                <div class="flex flex-col items-center">
                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-amber-100">
                        <svg class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <p class="mb-1 font-medium text-slate-500">Tidak ada hasil pencarian</p>
                    <p class="text-sm text-slate-400">Coba kata kunci lain.</p>
                </div>
            </div>
        </div>

        @if($kategoris->hasPages())
            <div class="border-t border-slate-100 px-5 py-4">
                {{ $kategoris->links() }}
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
                    Hapus Kategori?
                </h3>
            </div>
            <div class="p-6">
                <p class="mb-2 text-slate-600">Yakin ingin menghapus kategori <strong id="delete-kategori-name" class="text-slate-800">ini</strong>?</p>
                <p class="text-sm text-slate-500">Tindakan ini tidak bisa dibatalkan.</p>
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
        const rows = document.querySelectorAll('.kategori-row');
        const noResults = document.getElementById('no-results');

        function runSearchFilter() {
            if (!searchInput || rows.length === 0) {
                return;
            }

            const keyword = searchInput.value.toLowerCase().trim();
            let visible = 0;

            rows.forEach((row) => {
                const name = row.dataset.kategoriName || '';
                const desc = row.dataset.kategoriDesc || '';
                const match = keyword === '' || name.includes(keyword) || desc.includes(keyword);

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
        const deleteKategoriName = document.getElementById('delete-kategori-name');
        const cancelDeleteBtn = document.getElementById('cancel-delete');
        const confirmDeleteBtn = document.getElementById('confirm-delete');
        let pendingDeleteForm = null;

        document.querySelectorAll('.delete-btn').forEach((button) => {
            button.addEventListener('click', function() {
                deleteKategoriName.textContent = this.dataset.kategoriName || 'ini';
                pendingDeleteForm = this.closest('form');
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            });
        });

        cancelDeleteBtn.addEventListener('click', function() {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
            pendingDeleteForm = null;
        });

        confirmDeleteBtn.addEventListener('click', function() {
            if (pendingDeleteForm) {
                pendingDeleteForm.submit();
            }
        });

        deleteModal.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                cancelDeleteBtn.click();
            }
        });

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