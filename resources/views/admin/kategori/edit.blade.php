<x-layouts.app title="Edit Kategori">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    <!-- Header -->
    <div class="mb-6 rounded-2xl border border-cyan-200/50 bg-gradient-to-r from-cyan-500 via-blue-500 to-indigo-500 p-6 shadow-lg">
        <nav class="flex items-center text-sm text-white/85">
            <a href="{{ route('admin.kategori.index') }}" class="font-medium hover:text-white transition-colors">Manajemen Kategori</a>
            <svg class="mx-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="font-semibold text-white">Edit Kategori</span>
        </nav>

        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white sm:text-3xl">Edit Kategori</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Perbarui data kategori: <span class="font-semibold text-white">{{ $kategori->nama_kategori }}</span></p>
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
        <x-card class="xl:col-span-2 border border-cyan-100/80 shadow-md">
            <form method="POST" action="{{ route('admin.kategori.update', $kategori->id_kategori) }}" id="edit-kategori-form" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="rounded-xl border border-cyan-100 bg-gradient-to-r from-cyan-50 to-blue-50 px-4 py-3">
                    <p class="text-sm font-semibold text-cyan-800">Informasi Kategori</p>
                    <p class="mt-0.5 text-xs text-cyan-600">Pastikan nama dan deskripsi tetap konsisten agar mudah dipahami.</p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Nama Kategori <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="nama_kategori"
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                        class="w-full rounded-lg border @error('nama_kategori') border-rose-500 @else border-slate-200 @enderror px-4 py-3 text-slate-700 shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                        placeholder="Contoh: Perkakas Elektronik"
                        required
                    />
                    @error('nama_kategori')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        rows="5"
                        id="deskripsi"
                        class="w-full rounded-lg border @error('deskripsi') border-rose-500 @else border-slate-200 @enderror px-4 py-3 text-slate-700 shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                        placeholder="Tuliskan deskripsi singkat kategori (opsional)"
                    >{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                    <div class="mt-2 flex items-center justify-between">
                        <p class="text-xs text-slate-500">Deskripsi memudahkan identifikasi kategori saat pencarian.</p>
                        <p id="char-count" class="text-xs font-medium text-slate-500">0 karakter</p>
                    </div>
                    @error('deskripsi')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-6">
                    <a href="{{ route('admin.kategori.index') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-colors hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit" id="submit-btn" class="inline-flex items-center rounded-lg bg-gradient-to-r from-cyan-600 to-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition-all hover:from-cyan-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                        <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span id="submit-text">Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </x-card>

        <div class="space-y-5">
            <x-card class="border border-cyan-100 bg-gradient-to-br from-cyan-50 via-sky-50 to-white shadow-sm">
                <h3 class="text-sm font-bold text-cyan-900">Ringkasan Kategori</h3>
                <div class="mt-3 space-y-2">
                    <div class="flex items-center justify-between rounded-lg border border-white bg-white/85 px-3 py-2">
                        <span class="text-sm text-slate-600">ID Kategori</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $kategori->id_kategori }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-lg border border-white bg-white/85 px-3 py-2">
                        <span class="text-sm text-slate-600">Nama Saat Ini</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $kategori->nama_kategori }}</span>
                    </div>
                </div>
            </x-card>

            <x-card class="border border-violet-100 bg-gradient-to-br from-violet-50 via-purple-50 to-white shadow-sm">
                <h3 class="text-sm font-bold text-violet-900">Preview Perubahan</h3>
                <div class="mt-3 space-y-2 rounded-lg border border-white/70 bg-white/80 p-3">
                    <p class="text-xs uppercase tracking-wider text-slate-500">Nama Kategori</p>
                    <p id="preview-name" class="text-sm font-semibold text-slate-800">{{ $kategori->nama_kategori }}</p>
                    <p class="pt-2 text-xs uppercase tracking-wider text-slate-500">Deskripsi</p>
                    <p id="preview-desc" class="text-sm text-slate-600">{{ $kategori->deskripsi ?: 'Belum ada deskripsi' }}</p>
                </div>
            </x-card>
        </div>
    </div>

    <script>
        const nameInput = document.querySelector('input[name="nama_kategori"]');
        const descInput = document.getElementById('deskripsi');
        const previewName = document.getElementById('preview-name');
        const previewDesc = document.getElementById('preview-desc');
        const charCount = document.getElementById('char-count');

        function updatePreview() {
            const nameValue = (nameInput.value || '').trim();
            const descValue = (descInput.value || '').trim();

            previewName.textContent = nameValue || 'Belum diisi';
            previewDesc.textContent = descValue || 'Belum ada deskripsi';
            charCount.textContent = `${descInput.value.length} karakter`;
        }

        if (nameInput && descInput) {
            nameInput.addEventListener('input', updatePreview);
            descInput.addEventListener('input', updatePreview);
            updatePreview();
        }

        document.getElementById('edit-kategori-form').addEventListener('submit', function() {
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = true;
            document.getElementById('submit-text').textContent = 'Menyimpan...';
        });
    </script>
</x-layouts.app>