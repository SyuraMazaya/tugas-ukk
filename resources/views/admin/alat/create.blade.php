<x-layouts.app title="Tambah Alat">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    <!-- Header -->
    <div class="mb-6 rounded-2xl border border-sky-200/50 bg-gradient-to-r from-sky-500 via-cyan-500 to-blue-500 p-6 shadow-lg">
        <nav class="flex items-center text-sm text-white/85">
            <a href="{{ route('admin.alat.index') }}" class="font-medium transition-colors hover:text-white">Manajemen Alat</a>
            <svg class="mx-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="font-semibold text-white">Tambah Alat</span>
        </nav>

        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white sm:text-3xl">Tambah Alat Baru</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Masukkan data alat untuk memperkaya inventaris jurusan.</p>
            </div>
            <div class="inline-flex items-center gap-2 rounded-xl border border-white/25 bg-white/15 px-4 py-2 text-white backdrop-blur-sm">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-sm font-semibold">Input Inventaris</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
        <x-card class="border border-sky-100/80 shadow-md xl:col-span-2">
            <form method="POST" action="{{ route('admin.alat.store') }}" enctype="multipart/form-data" id="create-alat-form" class="space-y-6">
                @csrf

                <div class="rounded-xl border border-sky-100 bg-gradient-to-r from-sky-50 to-cyan-50 px-4 py-3">
                    <p class="text-sm font-semibold text-sky-800">Informasi Utama Alat</p>
                    <p class="mt-0.5 text-xs text-sky-600">Isi data dasar alat, lalu lengkapi gambar agar lebih mudah dikenali.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Kategori <span class="text-rose-500">*</span></label>
                        <select
                            name="kategori_id"
                            id="kategori_id"
                            required
                            class="w-full rounded-lg border @error('kategori_id') border-rose-500 @else border-slate-200 @enderror bg-white px-4 py-3 text-sm text-slate-700 shadow-sm transition-colors focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20"
                        >
                            <option value="">Pilih kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}" {{ (string) old('kategori_id') === (string) $kategori->id_kategori ? 'selected' : '' }}>
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
                            class="w-full rounded-lg border @error('kondisi') border-rose-500 @else border-slate-200 @enderror bg-white px-4 py-3 text-sm text-slate-700 shadow-sm transition-colors focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20"
                        >
                            <option value="">Pilih kondisi</option>
                            <option value="baik" {{ old('kondisi') === 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusak_ringan" {{ old('kondisi') === 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
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
                        value="{{ old('nama_alat') }}"
                        required
                        placeholder="Contoh: Bor Tangan Listrik"
                        class="w-full rounded-lg border @error('nama_alat') border-rose-500 @else border-slate-200 @enderror px-4 py-3 text-slate-700 shadow-sm transition-colors focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20"
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
                            value="{{ old('kode_alat') }}"
                            required
                            placeholder="Contoh: ELK-001"
                            class="w-full rounded-lg border @error('kode_alat') border-rose-500 @else border-slate-200 @enderror px-4 py-3 font-mono text-slate-700 shadow-sm transition-colors focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20"
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
                            value="{{ old('stok', 0) }}"
                            min="0"
                            required
                            class="w-full rounded-lg border @error('stok') border-rose-500 @else border-slate-200 @enderror px-4 py-3 text-slate-700 shadow-sm transition-colors focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20"
                        />
                        @error('stok')
                            <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Gambar Alat</label>
                    <div class="rounded-xl border-2 border-dashed @error('gambar') border-rose-300 @else border-slate-200 @enderror bg-slate-50/60 p-5 transition-colors hover:border-sky-400 hover:bg-sky-50/50">
                        <div class="mb-4 flex items-start justify-between gap-4">
                            <div class="flex items-start gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-sky-100 text-sky-600">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-700">Unggah Foto Alat</p>
                                    <p class="text-xs text-slate-500">JPG, PNG, GIF. Maksimal 2MB.</p>
                                </div>
                            </div>

                            <img id="image-preview" src="" alt="Preview gambar" class="hidden h-16 w-16 rounded-lg object-cover ring-1 ring-slate-200" />
                        </div>

                        <input
                            type="file"
                            name="gambar"
                            id="gambar"
                            accept="image/*"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:rounded-lg file:border-0 file:bg-sky-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-sky-700 hover:file:bg-sky-200"
                        />
                        <p id="file-name" class="mt-2 text-xs text-slate-500">Belum ada file dipilih</p>
                    </div>
                    @error('gambar')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-6">
                    <a href="{{ route('admin.alat.index') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-colors hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit" id="submit-btn" class="inline-flex items-center rounded-lg bg-gradient-to-r from-sky-600 to-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition-all hover:from-sky-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                        <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span id="submit-text">Simpan Alat</span>
                    </button>
                </div>
            </form>
        </x-card>

        <div class="space-y-5">
            <x-card class="border border-cyan-100 bg-gradient-to-br from-cyan-50 via-sky-50 to-white shadow-sm">
                <h3 class="text-sm font-bold text-cyan-900">Tips Input Cepat</h3>
                <div class="mt-3 space-y-2 text-sm text-cyan-700">
                    <p>Gunakan kode unik untuk memudahkan pelacakan alat.</p>
                    <p>Pilih kategori paling spesifik agar pencarian lebih akurat.</p>
                    <p>Unggah foto yang jelas untuk mempercepat identifikasi.</p>
                </div>
            </x-card>

            <x-card class="border border-indigo-100 bg-gradient-to-br from-indigo-50 via-blue-50 to-white shadow-sm">
                <h3 class="text-sm font-bold text-indigo-900">Preview Data</h3>
                <div class="mt-3 space-y-2 rounded-lg border border-white/70 bg-white/80 p-3">
                    <p class="text-xs uppercase tracking-wider text-slate-500">Nama Alat</p>
                    <p id="preview-nama" class="text-sm font-semibold text-slate-800">Belum diisi</p>

                    <p class="pt-2 text-xs uppercase tracking-wider text-slate-500">Kode</p>
                    <p id="preview-kode" class="text-sm font-mono text-slate-700">Belum diisi</p>

                    <p class="pt-2 text-xs uppercase tracking-wider text-slate-500">Kategori</p>
                    <p id="preview-kategori" class="text-sm text-slate-700">Belum dipilih</p>

                    <p class="pt-2 text-xs uppercase tracking-wider text-slate-500">Kondisi dan Stok</p>
                    <p id="preview-kondisi-stok" class="text-sm text-slate-700">-</p>
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
        const imagePreview = document.getElementById('image-preview');
        const fileName = document.getElementById('file-name');

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
                    fileName.textContent = 'Belum ada file dipilih';
                    imagePreview.classList.add('hidden');
                    imagePreview.src = '';
                    return;
                }

                fileName.textContent = file.name;

                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            });
        }

        const createAlatForm = document.getElementById('create-alat-form');
        createAlatForm.addEventListener('submit', function() {
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = true;
            document.getElementById('submit-text').textContent = 'Menyimpan...';
        });

        updatePreview();
    </script>
</x-layouts.app>