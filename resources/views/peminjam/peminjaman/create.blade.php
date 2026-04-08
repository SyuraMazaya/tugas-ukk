<x-layouts.app title="Ajukan Peminjaman">
    <x-slot:sidebar>
        @include('partials.peminjam-sidebar')
    </x-slot:sidebar>

    <!-- Header Banner -->
    <div class="mb-6 rounded-2xl border border-indigo-200/60 bg-gradient-to-r from-indigo-500 via-blue-500 to-cyan-500 px-5 py-6 shadow-lg shadow-indigo-300/30 sm:px-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <nav class="mb-3 flex items-center text-sm text-white/85">
                    <a href="{{ route('peminjam.peminjaman.index') }}" class="font-medium transition-colors hover:text-white">Peminjaman</a>
                    <svg class="mx-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="font-semibold text-white">Ajukan Baru</span>
                </nav>
                <h1 class="text-2xl font-bold text-white sm:text-3xl">Ajukan Peminjaman</h1>
                <p class="mt-1 text-sm text-white/90 sm:text-base">Pilih alat, atur jumlah, lalu kirim pengajuan dalam satu alur cepat.</p>
            </div>

            <a href="{{ route('peminjam.peminjaman.index') }}" class="inline-flex items-center rounded-xl border border-white/35 bg-white/20 px-4 py-2.5 text-sm font-semibold text-white transition-all hover:-translate-y-0.5 hover:bg-white/25">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('peminjam.peminjaman.store') }}" x-data="peminjamanForm()" x-init="init()">
        @csrf

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Pilih Alat -->
            <div class="lg:col-span-2">
                <x-card class="border border-indigo-100 shadow-sm">
                    <div class="mb-6 flex items-center justify-between gap-3">
                        <div class="flex items-center">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-semibold text-slate-800">Pilih Alat</h3>
                        </div>

                        <span class="inline-flex items-center rounded-lg bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700" x-text="selectedAlats.length + ' dipilih'"></span>
                    </div>

                    <div class="mb-4 grid grid-cols-1 gap-3 md:grid-cols-2">
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input
                                type="text"
                                x-model="search"
                                placeholder="Cari nama atau kode alat..."
                                class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-slate-700 shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                            >
                        </div>

                        <select x-model="categoryFilter" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-slate-700 shadow-sm transition-colors focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="custom-scrollbar max-h-[30rem] space-y-2 overflow-y-auto pr-1">
                        @foreach($alats as $alat)
                            <div
                                class="flex items-center justify-between rounded-xl border border-slate-200 p-4 transition-all hover:border-indigo-200 hover:bg-indigo-50/30"
                                data-alat-id="{{ $alat->id_alat }}"
                                data-alat-nama="{{ $alat->nama_alat }}"
                                data-alat-stok="{{ $alat->stok }}"
                                x-show="(search === '' || '{{ strtolower($alat->nama_alat) }}'.includes(search.toLowerCase()) || '{{ strtolower($alat->kode_alat) }}'.includes(search.toLowerCase())) && (categoryFilter === '' || categoryFilter === '{{ $alat->id_kategori }}')"
                            >
                                <div class="flex-1">
                                    <p class="font-semibold text-slate-800">{{ $alat->nama_alat }}</p>
                                    <p class="text-sm text-slate-500">
                                        <span class="font-mono">{{ $alat->kode_alat }}</span>
                                        <span class="mx-1 text-slate-300">•</span>
                                        {{ $alat->kategori->nama_kategori }}
                                    </p>
                                    <p class="mt-1 text-sm">
                                        <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-medium {{ $alat->stok > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                            Stok: {{ $alat->stok }}
                                        </span>
                                    </p>
                                </div>

                                @if($alat->stok > 0)
                                    <div class="ml-4 flex items-center gap-2">
                                        <template x-if="!isSelected({{ $alat->id_alat }})">
                                            <button type="button" @click="addAlat({{ $alat->id_alat }}, '{{ $alat->nama_alat }}', {{ $alat->stok }})" class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-indigo-700">
                                                <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                                                </svg>
                                                Tambah
                                            </button>
                                        </template>

                                        <template x-if="isSelected({{ $alat->id_alat }})">
                                            <div class="flex items-center gap-1 rounded-lg bg-slate-100 p-1">
                                                <button type="button" @click="decreaseQty({{ $alat->id_alat }})" class="flex h-8 w-8 items-center justify-center rounded-md bg-white font-medium text-slate-600 shadow-sm transition-colors hover:bg-slate-200">-</button>
                                                <span x-text="getQty({{ $alat->id_alat }})" class="w-8 text-center font-semibold text-slate-800"></span>
                                                <button type="button" @click="increaseQty({{ $alat->id_alat }}, {{ $alat->stok }})" class="flex h-8 w-8 items-center justify-center rounded-md bg-white font-medium text-slate-600 shadow-sm transition-colors hover:bg-slate-200">+</button>
                                                <button type="button" @click="removeAlat({{ $alat->id_alat }})" class="ml-1 flex h-8 w-8 items-center justify-center rounded-md text-rose-500 transition-colors hover:bg-rose-50 hover:text-rose-700">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                @else
                                    <span class="ml-4 text-sm font-medium text-slate-400">Habis</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </x-card>
            </div>

            <!-- Form Peminjaman -->
            <div class="lg:col-span-1">
                <x-card class="sticky top-6 border border-emerald-100 shadow-sm">
                    <div class="mb-6 flex items-center">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-slate-800">Detail Pengajuan</h3>
                    </div>

                    <x-input
                        label="Tanggal Pinjam"
                        name="tanggal_pinjam"
                        type="date"
                        :value="now()->format('Y-m-d')"
                        required
                    />

                    <x-input
                        label="Rencana Tanggal Kembali"
                        name="tanggal_kembali_rencana"
                        type="date"
                        :value="now()->addDays(7)->format('Y-m-d')"
                        required
                    />

                    <x-textarea
                        label="Catatan (Opsional)"
                        name="catatan"
                        placeholder="Keperluan peminjaman..."
                        rows="3"
                    />

                    <div class="mt-5">
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-600">Alat Dipilih</label>
                        <div class="min-h-24 rounded-xl bg-slate-50 p-4 ring-1 ring-slate-200">
                            <template x-if="selectedAlats.length === 0">
                                <div class="py-4 text-center">
                                    <svg class="mx-auto mb-2 h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5" />
                                    </svg>
                                    <p class="text-sm text-slate-400">Belum ada alat dipilih</p>
                                </div>
                            </template>

                            <ul class="space-y-2">
                                <template x-for="item in selectedAlats" :key="item.id">
                                    <li class="flex items-center justify-between rounded-lg bg-white px-3 py-2 text-sm shadow-sm">
                                        <span x-text="item.nama" class="font-medium text-slate-700"></span>
                                        <span class="inline-flex items-center rounded-md bg-indigo-100 px-2 py-0.5 text-xs font-semibold text-indigo-700" x-text="'x' + item.qty"></span>
                                        <input type="hidden" :name="'alat[' + item.id + ']'" :value="item.qty">
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-6 border-t border-slate-100 pt-4">
                        <x-button type="submit" variant="success" class="w-full" x-bind:disabled="selectedAlats.length === 0">
                            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                            </svg>
                            Kirim Pengajuan
                        </x-button>
                    </div>
                </x-card>
            </div>
        </div>
    </form>

    <script>
        function peminjamanForm() {
            return {
                search: '',
                categoryFilter: '',
                selectedAlats: [],

                init() {
                    const preselectedAlat = '{{ request()->get('alat') }}';

                    if (preselectedAlat) {
                        const alatEl = document.querySelector(`[data-alat-id="${preselectedAlat}"]`);

                        if (alatEl) {
                            const nama = alatEl.dataset.alatNama;
                            const stok = parseInt(alatEl.dataset.alatStok);

                            if (stok > 0) {
                                this.addAlat(parseInt(preselectedAlat), nama, stok);
                            }
                        }
                    }
                },
                
                isSelected(id) {
                    return this.selectedAlats.some(a => a.id === id);
                },
                
                getQty(id) {
                    const item = this.selectedAlats.find(a => a.id === id);
                    return item ? item.qty : 0;
                },
                
                addAlat(id, nama, maxStok) {
                    if (!this.isSelected(id)) {
                        this.selectedAlats.push({ id, nama, qty: 1, maxStok });
                    }
                },
                
                removeAlat(id) {
                    this.selectedAlats = this.selectedAlats.filter(a => a.id !== id);
                },
                
                increaseQty(id, maxStok) {
                    const item = this.selectedAlats.find(a => a.id === id);
                    if (item && item.qty < maxStok) {
                        item.qty++;
                    }
                },
                
                decreaseQty(id) {
                    const item = this.selectedAlats.find(a => a.id === id);
                    if (item) {
                        if (item.qty > 1) {
                            item.qty--;
                        } else {
                            this.removeAlat(id);
                        }
                    }
                }
            }
        }
    </script>
</x-layouts.app>