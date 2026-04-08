<x-layouts.app title="Manajemen Alat">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    @php
        $totalAlat = $alats->total();
        $shownAlat = $alats->count();
        $stokKosong = $alats->where('stok', '<=', 0)->count();
        $rusakRingan = $alats->where('kondisi', 'rusak_ringan')->count();
    @endphp

    <!-- Header Banner -->
    <div class="mb-6 rounded-2xl border border-sky-200/60 bg-gradient-to-r from-cyan-500 via-sky-500 to-blue-600 px-5 py-6 shadow-lg shadow-sky-300/30 sm:px-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="inline-flex items-center rounded-full bg-white/20 px-3 py-1 text-xs font-semibold text-white ring-1 ring-white/40">
                    Dashboard Alat
                </p>
                <h1 class="mt-3 text-2xl font-bold text-white sm:text-3xl">Manajemen Alat</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Kelola data alat agar stok, kondisi, dan kategori selalu akurat.</p>
            </div>
            <a href="{{ route('admin.alat.create') }}" class="inline-flex items-center justify-center rounded-xl border border-white/35 bg-white/15 px-4 py-2.5 text-sm font-semibold text-white backdrop-blur-sm transition-all hover:-translate-y-0.5 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/60 focus:ring-offset-2 focus:ring-offset-sky-500">
                <svg class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Alat
            </a>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-cyan-200 bg-gradient-to-br from-cyan-50 to-sky-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-cyan-700">Total Alat</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $totalAlat }}</p>
            <p class="mt-1 text-xs text-slate-500">Keseluruhan data alat</p>
        </div>

        <div class="rounded-xl border border-indigo-200 bg-gradient-to-br from-indigo-50 to-blue-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-indigo-700">Data Ditampilkan</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $shownAlat }}</p>
            <p class="mt-1 text-xs text-slate-500">Data pada halaman ini</p>
        </div>

        <div class="rounded-xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-teal-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Stok Tersedia</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ max($shownAlat - $stokKosong, 0) }}</p>
            <p class="mt-1 text-xs text-slate-500">Alat dengan stok lebih dari 0</p>
        </div>

        <div class="rounded-xl border border-amber-200 bg-gradient-to-br from-amber-50 to-orange-50 p-4 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-amber-700">Rusak Ringan</p>
            <p class="mt-2 text-2xl font-bold text-slate-800">{{ $rusakRingan }}</p>
            <p class="mt-1 text-xs text-slate-500">Perlu perhatian pemeliharaan</p>
        </div>
    </div>

    <!-- Filter and Search -->
    <x-card class="mb-5 border border-sky-100 bg-gradient-to-r from-sky-50/70 via-white to-cyan-50/70 shadow-sm">
        <form method="GET" class="grid grid-cols-1 gap-4 lg:grid-cols-12">
            <div class="lg:col-span-4">
                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-600">Kategori</label>
                <select name="kategori_id" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 shadow-sm transition-colors focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ (string) $kategoriId === (string) $kategori->id_kategori ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="lg:col-span-4">
                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-600">Kondisi</label>
                <select name="kondisi" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 shadow-sm transition-colors focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20">
                    <option value="">Semua Kondisi</option>
                    <option value="baik" {{ $kondisi === 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="rusak_ringan" {{ $kondisi === 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="rusak" {{ $kondisi === 'rusak' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
            </div>

            <div class="lg:col-span-4 lg:self-end">
                <div class="flex flex-wrap gap-2">
                    <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-sky-600 to-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition-all hover:from-sky-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                        <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Terapkan Filter
                    </button>
                    @if(request()->hasAny(['kategori_id', 'kondisi']))
                        <a href="{{ route('admin.alat.index') }}" class="inline-flex items-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition-colors hover:bg-slate-50">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <div class="mt-4" id="search-container">
            <div class="relative">
                <svg class="absolute left-4 top-3 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    type="text"
                    id="search-input"
                    placeholder="Cari nama alat, kode, atau kategori di halaman ini..."
                    class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-11 text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20"
                />
                <button id="clear-search" class="absolute right-3 top-3 hidden text-slate-400 transition-colors hover:text-slate-600" title="Hapus pencarian" type="button">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </x-card>

    <!-- Table -->
    <x-card class="overflow-hidden border border-slate-100 shadow-sm">
        <div class="h-1.5 bg-gradient-to-r from-cyan-400 via-sky-400 to-blue-500"></div>

        <div id="table-container">
            <div class="overflow-x-auto">
                <table class="min-w-full" id="alat-table">
                    <thead>
                        <tr class="border-b border-slate-200 bg-gradient-to-r from-slate-50 via-cyan-50/40 to-slate-50">
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">No</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Alat</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Kode</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Kategori</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Stok</th>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Kondisi</th>
                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="table-body">
                        @forelse($alats as $index => $alat)
                            <tr
                                class="alat-row transition-colors hover:bg-cyan-50/40"
                                data-nama="{{ strtolower($alat->nama_alat) }}"
                                data-kode="{{ strtolower($alat->kode_alat) }}"
                                data-kategori="{{ strtolower($alat->kategori->nama_kategori) }}"
                            >
                                <td class="whitespace-nowrap px-5 py-3.5 text-sm text-slate-500">
                                    {{ $alats->firstItem() + $index }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        @if($alat->gambar)
                                            <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama_alat }}" class="h-12 w-12 rounded-xl object-cover ring-1 ring-slate-200">
                                        @else
                                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 ring-1 ring-slate-200">
                                                <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif

                                        <div>
                                            <div class="text-sm font-semibold text-slate-800">{{ $alat->nama_alat }}</div>
                                            <p class="mt-0.5 text-xs text-slate-500">ID: {{ $alat->id_alat }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <span class="rounded-md bg-slate-100 px-2 py-1 font-mono text-xs text-slate-700">{{ $alat->kode_alat }}</span>
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5 text-sm text-slate-600">
                                    {{ $alat->kategori->nama_kategori }}
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <span class="inline-flex items-center rounded-lg px-2.5 py-1 text-sm font-semibold {{ $alat->stok > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                        {{ $alat->stok }} unit
                                    </span>
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5">
                                    <x-badge :status="$alat->kondisi" />
                                </td>

                                <td class="whitespace-nowrap px-5 py-3.5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.alat.show', $alat->id_alat) }}" class="rounded-lg bg-slate-100/70 p-2 text-slate-500 transition-colors duration-200 hover:bg-slate-200 hover:text-slate-700" title="Detail Alat">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('admin.alat.edit', $alat->id_alat) }}" class="rounded-lg bg-indigo-50/70 p-2 text-indigo-500 transition-colors duration-200 hover:bg-indigo-100 hover:text-indigo-700" title="Edit Alat">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form method="POST" action="{{ route('admin.alat.destroy', $alat->id_alat) }}" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="button"
                                                class="delete-btn rounded-lg bg-rose-50/70 p-2 text-rose-500 transition-colors duration-200 hover:bg-rose-100 hover:text-rose-700"
                                                title="Hapus Alat"
                                                data-alat-name="{{ $alat->nama_alat }}"
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
                                <td colspan="7" class="px-5 py-14 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                                            <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                            </svg>
                                        </div>
                                        <p class="mb-1 font-medium text-slate-500">Tidak ada data alat</p>
                                        <p class="mb-4 text-sm text-slate-400">Mulai dengan menambahkan alat pertama.</p>
                                        <a href="{{ route('admin.alat.create') }}" class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-indigo-700">
                                            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Tambah Alat
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
                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-cyan-100">
                        <svg class="h-8 w-8 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <p class="mb-1 font-medium text-slate-500">Tidak ada hasil pencarian</p>
                    <p class="text-sm text-slate-400">Gunakan kata kunci yang berbeda.</p>
                </div>
            </div>
        </div>

        @if($alats->hasPages())
            <div class="border-t border-slate-100 px-5 py-4">
                {{ $alats->appends(request()->query())->links() }}
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
                    Hapus Alat?
                </h3>
            </div>
            <div class="p-6">
                <p class="mb-2 text-slate-600">Yakin ingin menghapus alat <strong id="delete-alat-name" class="text-slate-800">ini</strong>?</p>
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
        const rows = document.querySelectorAll('.alat-row');
        const noResults = document.getElementById('no-results');

        function runSearchFilter() {
            if (!searchInput || rows.length === 0) {
                return;
            }

            const keyword = searchInput.value.toLowerCase().trim();
            let visible = 0;

            rows.forEach((row) => {
                const nama = row.dataset.nama || '';
                const kode = row.dataset.kode || '';
                const kategori = row.dataset.kategori || '';
                const match = keyword === '' || nama.includes(keyword) || kode.includes(keyword) || kategori.includes(keyword);

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
        const deleteAlatName = document.getElementById('delete-alat-name');
        const cancelDeleteBtn = document.getElementById('cancel-delete');
        const confirmDeleteBtn = document.getElementById('confirm-delete');
        let pendingDeleteForm = null;

        document.querySelectorAll('.delete-btn').forEach((button) => {
            button.addEventListener('click', function() {
                deleteAlatName.textContent = this.dataset.alatName || 'ini';
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