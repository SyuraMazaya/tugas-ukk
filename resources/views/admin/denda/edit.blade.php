<x-layouts.app title="Edit Denda">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    <!-- Header -->
    <div class="mb-6 rounded-2xl border border-cyan-200/50 bg-gradient-to-r from-cyan-500 via-teal-500 to-emerald-500 p-6 shadow-lg">
        <nav class="flex items-center text-sm text-white/85">
            <a href="{{ route('admin.denda.index') }}" class="font-medium transition-colors hover:text-white">Pengaturan Denda</a>
            <svg class="mx-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="font-semibold text-white">Edit Denda</span>
        </nav>

        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white sm:text-3xl">Edit Konfigurasi Denda</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Perbarui aturan denda untuk menjaga konsistensi kebijakan.</p>
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
        <x-card class="border border-cyan-100/80 shadow-md xl:col-span-2">
            <form action="{{ route('admin.denda.update', $denda) }}" method="POST" id="edit-denda-form" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="rounded-xl border border-cyan-100 bg-gradient-to-r from-cyan-50 to-teal-50 px-4 py-3">
                    <p class="text-sm font-semibold text-cyan-800">Detail Denda</p>
                    <p class="mt-0.5 text-xs text-cyan-600">Perbarui nilai dan status denda dengan hati-hati karena berdampak ke perhitungan pengembalian.</p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Denda <span class="text-rose-500">*</span></label>
                    <input
                        type="text"
                        name="nama_denda"
                        id="nama_denda"
                        value="{{ old('nama_denda', $denda->nama_denda) }}"
                        required
                        placeholder="Contoh: Denda Keterlambatan Pengembalian"
                        class="w-full rounded-lg border @error('nama_denda') border-rose-500 @else border-slate-200 @enderror px-4 py-3 text-slate-700 shadow-sm transition-colors focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/20"
                    />
                    @error('nama_denda')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Jumlah Denda per Hari (Rp) <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-500">Rp</span>
                        <input
                            type="number"
                            name="jumlah_denda"
                            id="jumlah_denda"
                            value="{{ old('jumlah_denda', $denda->jumlah_denda) }}"
                            min="0"
                            step="0.01"
                            required
                            placeholder="0"
                            class="w-full rounded-lg border @error('jumlah_denda') border-rose-500 @else border-slate-200 @enderror py-3 pl-12 pr-4 text-slate-700 shadow-sm transition-colors focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/20"
                        />
                    </div>
                    @error('jumlah_denda')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-slate-500">Nilai ini dikenakan untuk setiap hari keterlambatan.</p>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        id="deskripsi"
                        rows="4"
                        placeholder="Tuliskan deskripsi singkat denda (opsional)"
                        class="w-full rounded-lg border @error('deskripsi') border-rose-500 @else border-slate-200 @enderror px-4 py-3 text-slate-700 shadow-sm transition-colors placeholder:text-slate-400 focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/20"
                    >{{ old('deskripsi', $denda->deskripsi) }}</textarea>
                    <div class="mt-2 flex items-center justify-between">
                        <p class="text-xs text-slate-500">Deskripsi membantu tim memahami alasan konfigurasi.</p>
                        <p id="char-count" class="text-xs font-medium text-slate-500">0 karakter</p>
                    </div>
                    @error('deskripsi')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-xl border border-slate-200 bg-slate-50/80 p-4">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Status Denda</label>
                    <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                        <input
                            type="checkbox"
                            name="is_active"
                            id="is_active"
                            value="1"
                            {{ old('is_active', $denda->is_active) ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"
                        >
                        Aktif
                    </label>
                    <p class="mt-1.5 text-xs text-slate-500">Status aktif menentukan apakah denda ini dipakai saat pengembalian.</p>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-6">
                    <a href="{{ route('admin.denda.index') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-colors hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit" id="submit-btn" class="inline-flex items-center rounded-lg bg-gradient-to-r from-cyan-600 to-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition-all hover:from-cyan-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
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
                <h3 class="text-sm font-bold text-emerald-900">Data Saat Ini</h3>
                <div class="mt-3 space-y-2">
                    <div class="flex items-center justify-between rounded-lg border border-white bg-white/85 px-3 py-2">
                        <span class="text-sm text-slate-600">Nama</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $denda->nama_denda }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-lg border border-white bg-white/85 px-3 py-2">
                        <span class="text-sm text-slate-600">Nominal</span>
                        <span class="text-sm font-semibold text-slate-800">Rp {{ number_format($denda->jumlah_denda, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-lg border border-white bg-white/85 px-3 py-2">
                        <span class="text-sm text-slate-600">Status</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $denda->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                    </div>
                </div>
            </x-card>

            <x-card class="border border-cyan-100 bg-gradient-to-br from-cyan-50 via-sky-50 to-white shadow-sm">
                <h3 class="text-sm font-bold text-cyan-900">Preview Perubahan</h3>
                <div class="mt-3 space-y-2 rounded-lg border border-white/70 bg-white/80 p-3">
                    <p class="text-xs uppercase tracking-wider text-slate-500">Nama Denda</p>
                    <p id="preview-name" class="text-sm font-semibold text-slate-800">{{ old('nama_denda', $denda->nama_denda) }}</p>

                    <p class="pt-2 text-xs uppercase tracking-wider text-slate-500">Nominal</p>
                    <p id="preview-amount" class="text-sm font-semibold text-slate-800">Rp {{ number_format((float) old('jumlah_denda', $denda->jumlah_denda), 0, ',', '.') }} / hari</p>

                    <p class="pt-2 text-xs uppercase tracking-wider text-slate-500">Status</p>
                    <p id="preview-status" class="text-sm text-slate-700">{{ old('is_active', $denda->is_active) ? 'Aktif' : 'Nonaktif' }}</p>

                    <p class="pt-2 text-xs uppercase tracking-wider text-slate-500">Deskripsi</p>
                    <p id="preview-desc" class="text-sm text-slate-600">{{ old('deskripsi', $denda->deskripsi) ?: 'Belum ada deskripsi' }}</p>
                </div>
            </x-card>
        </div>
    </div>

    <script>
        const namaInput = document.getElementById('nama_denda');
        const jumlahInput = document.getElementById('jumlah_denda');
        const descInput = document.getElementById('deskripsi');
        const statusInput = document.getElementById('is_active');

        const previewName = document.getElementById('preview-name');
        const previewAmount = document.getElementById('preview-amount');
        const previewStatus = document.getElementById('preview-status');
        const previewDesc = document.getElementById('preview-desc');
        const charCount = document.getElementById('char-count');

        function formatRupiah(value) {
            const number = Number(value);

            if (Number.isNaN(number) || number < 0) {
                return 'Rp 0';
            }

            return `Rp ${new Intl.NumberFormat('id-ID').format(number)}`;
        }

        function updatePreview() {
            const nameValue = (namaInput.value || '').trim();
            const amountValue = jumlahInput.value || '0';
            const descValue = (descInput.value || '').trim();

            previewName.textContent = nameValue || 'Belum diisi';
            previewAmount.textContent = `${formatRupiah(amountValue)} / hari`;
            previewStatus.textContent = statusInput.checked ? 'Aktif' : 'Nonaktif';
            previewDesc.textContent = descValue || 'Belum ada deskripsi';
            charCount.textContent = `${descInput.value.length} karakter`;
        }

        [namaInput, jumlahInput, descInput, statusInput].forEach((element) => {
            element.addEventListener('input', updatePreview);
            element.addEventListener('change', updatePreview);
        });

        const form = document.getElementById('edit-denda-form');
        form.addEventListener('submit', function() {
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = true;
            document.getElementById('submit-text').textContent = 'Menyimpan...';
        });

        updatePreview();
    </script>
</x-layouts.app>
