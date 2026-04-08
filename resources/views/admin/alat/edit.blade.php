<x-layouts.app title="Edit Alat">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    <!-- Header -->
    <div class="mb-6 rounded-2xl border border-indigo-200/50 bg-gradient-to-r from-indigo-500 via-blue-500 to-cyan-500 p-6 shadow-lg">
        <nav class="flex items-center text-sm text-white/85">
            <a href="{{ route('admin.alat.index') }}" class="font-medium transition-colors hover:text-white">Manajemen Alat</a>
            <svg class="mx-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="font-semibold text-white">Edit Alat</span>
        </nav>

        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white sm:text-3xl">Edit Data Alat</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Perbarui informasi untuk <span class="font-semibold text-white">{{ $alat->nama_alat }}</span>.</p>
            </div>
            <div class="inline-flex items-center gap-2 rounded-xl border border-white/25 bg-white/15 px-4 py-2 text-white backdrop-blur-sm">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5" />
                </svg>
                <span class="text-sm font-semibold">Mode Edit</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
        <x-card class="border border-indigo-100/80 shadow-md xl:col-span-2">
            <form method="POST" action="{{ route('admin.alat.update', $alat->id_alat) }}" enctype="multipart/form-data" id="edit-alat-form" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="rounded-xl border border-indigo-100 bg-gradient-to-r from-indigo-50 to-cyan-50 px-4 py-3">
                    <p class="text-sm font-semibold text-indigo-800">Informasi Alat</p>
                    <p class="mt-0.5 text-xs text-indigo-600">Pastikan kategori, kode, dan kondisi tetap konsisten dengan inventaris.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Kategori <span class="text-rose-500">*</span></label>
                        <select
                            name="kategori_id"
                            id="kategori_id"
                            required
                            class="w-full rounded-lg border @error('kategori_id') border-rose-500 @else border-slate-200 @enderror bg-white px-4 py-3 text-sm text-slate-700 shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                        >
                            <option value="">Pilih kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}" {{ (string) old('kategori_id', $alat->kategori_id) === (string) $kategori->id_kategori ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Kondisi <span class="text-rose-500">*</span></label>
                        <select
                            name="kondisi"
                            id="kondisi"
                            required
                            class="w-full rounded-lg border @error('kondisi') border-rose-500 @else border-slate-200 @enderror bg-white px-4 py-3 text-sm text-slate-700 shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                        >
                            <option value="">Pilih kondisi</option>
                            <option value="baik" {{ old('kondisi', $alat->kondisi) === 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusak_ringan" {{ old('kondisi', $alat->kondisi) === 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        </select>
                        @error('kondisi')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Alat <span class="text-rose-500">*</span></label>
                    <input
                        type="text"
                        name="nama_alat"
                        id="nama_alat"
                        value="{{ old('nama_alat', $alat->nama_alat) }}"
                        required
                        placeholder="Contoh: Bor Tangan Listrik"
                        class="w-full rounded-lg border @error('nama_alat') border-rose-500 @else border-slate-200 @enderror px-4 py-3 text-slate-700 shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                    />
                    @error('nama_alat')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Kode Alat <span class="text-rose-500">*</span></label>
                        <input
                            type="text"
                            name="kode_alat"
                            id="kode_alat"
                            value="{{ old('kode_alat', $alat->kode_alat) }}"
                            required
                            placeholder="Contoh: ELK-001"
                            class="w-full rounded-lg border @error('kode_alat') border-rose-500 @else border-slate-200 @enderror px-4 py-3 font-mono text-slate-700 shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                        />
                        @error('kode_alat')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Stok <span class="text-rose-500">*</span></label>
                        <input
                            type="number"
                            name="stok"
                            id="stok"
                            value="{{ old('stok', $alat->stok) }}"
                            min="0"
                            required
                            class="w-full rounded-lg border @error('stok') border-rose-500 @else border-slate-200 @enderror px-4 py-3 text-slate-700 shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                        />
                        @error('stok')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Gambar Alat</label>
                    <div class="rounded-xl border-2 border-dashed @error('gambar') border-rose-300 @else border-slate-200 @enderror bg-slate-50/60 p-5 transition-colors hover:border-indigo-400 hover:bg-indigo-50/50">
                        <div class="mb-4 flex flex-wrap items-start justify-between gap-4">
                            <div class="flex items-start gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-700">Perbarui Foto Alat</p>
                                    <p class="text-xs text-slate-500">Kosongkan bila tidak ingin mengganti gambar.</p>
                                </div>
                            </div>

                            @if($alat->gambar)
                                <img
                                    id="current-image"
                                    src="{{ asset('storage/' . $alat->gambar) }}"
                                    alt="{{ $alat->nama_alat }}"
                                    class="h-16 w-16 rounded-lg object-cover ring-1 ring-slate-200"
                                />
                            @else
                                <img id="current-image" src="" alt="Current image" class="hidden h-16 w-16 rounded-lg object-cover ring-1 ring-slate-200" />
                            @endif

                            <img id="new-image-preview" src="" alt="Preview gambar baru" class="hidden h-16 w-16 rounded-lg object-cover ring-1 ring-indigo-200" />
                        </div>

                        <input
                            type="file"
                            name="gambar"
                            id="gambar"
                            accept="image/*"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-200"
                        />
                        <p id="file-name" class="mt-2 text-xs text-slate-500">Belum ada file baru dipilih</p>
                    </div>
                    @error('gambar')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-6">
                    <a href="{{ route('admin.alat.index') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-colors hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit" id="submit-btn" class="inline-flex items-center rounded-lg bg-gradient-to-r from-indigo-600 to-cyan-600 px-4 py-2.5 text-sm font-semibold text-white transition-all hover:from-indigo-700 hover:to-cyan-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                        <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span id="submit-text">Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </x-card>

        <div class="space-y-5">
            <x-card class="border border-emerald-100 bg-gradient-to-br from-emerald-50 via-teal-50 to-white shadow-sm">
                <h3 class="text-sm font-bold text-emerald-900">Ringkasan Saat Ini</h3>
                <div class="mt-3 space-y-2">
                    <div class="flex items-center justify-between rounded-lg border border-white bg-white/85 px-3 py-2">
                        <span class="text-sm text-slate-600">ID Alat</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $alat->id_alat }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-lg border border-white bg-white/85 px-3 py-2">
                        <span class="text-sm text-slate-600">Kategori</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $alat->kategori->nama_kategori }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-lg border border-white bg-white/85 px-3 py-2">
                        <span class="text-sm text-slate-600">Kode</span>
                        <span class="text-sm font-mono text-slate-800">{{ $alat->kode_alat }}</span>
                    </div>
                </div>
            </x-card>

            <x-card class="border border-indigo-100 bg-gradient-to-br from-indigo-50 via-blue-50 to-white shadow-sm">
                <h3 class="text-sm font-bold text-indigo-900">Preview Perubahan</h3>
                <div class="mt-3 space-y-2 rounded-lg border border-white/70 bg-white/80 p-3">
                    <p class="text-xs uppercase tracking-wider text-slate-500">Nama Alat</p>
                    <p id="preview-nama" class="text-sm font-semibold text-slate-800">{{ old('nama_alat', $alat->nama_alat) }}</p>

                    <p class="pt-2 text-xs uppercase tracking-wider text-slate-500">Kode</p>
                    <p id="preview-kode" class="text-sm font-mono text-slate-700">{{ old('kode_alat', $alat->kode_alat) }}</p>

                    <p class="pt-2 text-xs uppercase tracking-wider text-slate-500">Kategori</p>
                    <p id="preview-kategori" class="text-sm text-slate-700">{{ $alat->kategori->nama_kategori }}</p>

                    <p class="pt-2 text-xs uppercase tracking-wider text-slate-500">Kondisi dan Stok</p>
                    <p id="preview-kondisi-stok" class="text-sm text-slate-700">{{ old('kondisi', $alat->kondisi) === 'baik' ? 'Baik' : 'Rusak Ringan' }} | {{ old('stok', $alat->stok) }} unit</p>
                </div>
            </x-card>
        </div>
    </div>

    <script>
        const namaInput = document.getElementById('nama_alat');
        const kodeInput = document.getElementById('kode_alat');
        const kategoriInput = document.getElementById('kategori_id');
        const kondisiInput = document.getElementById('kondisi');
        const stokInput = document.getElementById('stok');
        const gambarInput = document.getElementById('gambar');

        const previewNama = document.getElementById('preview-nama');
        const previewKode = document.getElementById('preview-kode');
        const previewKategori = document.getElementById('preview-kategori');
        const previewKondisiStok = document.getElementById('preview-kondisi-stok');
        const fileName = document.getElementById('file-name');
        const newImagePreview = document.getElementById('new-image-preview');

        function getConditionLabel(value) {
            if (value === 'baik') {
                return 'Baik';
            }

            if (value === 'rusak_ringan') {
                return 'Rusak Ringan';
            }

            return 'Belum dipilih';
        }

        function updatePreview() {
            const namaValue = (namaInput.value || '').trim();
            const kodeValue = (kodeInput.value || '').trim();
            const kategoriLabel = kategoriInput.options[kategoriInput.selectedIndex]?.text || 'Belum dipilih';
            const kondisiLabel = getConditionLabel(kondisiInput.value || '');
            const stokValue = stokInput.value !== '' ? stokInput.value : '0';

            previewNama.textContent = namaValue || 'Belum diisi';
            previewKode.textContent = kodeValue || 'Belum diisi';
            previewKategori.textContent = kategoriInput.value ? kategoriLabel : 'Belum dipilih';
            previewKondisiStok.textContent = `${kondisiLabel} | ${stokValue} unit`;
        }

        [namaInput, kodeInput, kategoriInput, kondisiInput, stokInput].forEach((element) => {
            element.addEventListener('input', updatePreview);
            element.addEventListener('change', updatePreview);
        });

        if (gambarInput) {
            gambarInput.addEventListener('change', function(event) {
                const file = event.target.files && event.target.files[0];

                if (!file) {
                    fileName.textContent = 'Belum ada file baru dipilih';
                    newImagePreview.classList.add('hidden');
                    newImagePreview.src = '';
                    return;
                }

                fileName.textContent = file.name;

                const reader = new FileReader();
                reader.onload = function(e) {
                    newImagePreview.src = e.target.result;
                    newImagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            });
        }

        const editAlatForm = document.getElementById('edit-alat-form');
        editAlatForm.addEventListener('submit', function() {
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = true;
            document.getElementById('submit-text').textContent = 'Menyimpan...';
        });

        updatePreview();
    </script>
</x-layouts.app>