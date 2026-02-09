<x-layouts.app title="Ajukan Peminjaman">
    <x-slot:sidebar>
        @include('partials.peminjam-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8">
        <nav class="flex items-center text-sm text-slate-500 mb-4">
            <a href="{{ route('peminjam.peminjaman.index') }}" class="hover:text-indigo-600 transition-colors">Peminjaman</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-slate-700 font-medium">Ajukan Baru</span>
        </nav>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Ajukan Peminjaman</h1>
                <p class="mt-1 text-slate-500">Pilih alat yang ingin dipinjam</p>
            </div>
            <a href="{{ route('peminjam.peminjaman.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>
    
    <form method="POST" action="{{ route('peminjam.peminjaman.store') }}" x-data="peminjamanForm()">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Pilih Alat -->
            <div class="lg:col-span-2">
                <x-card>
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-slate-800">Pilih Alat</h3>
                    </div>
                    
                    <!-- Search -->
                    <div class="mb-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" x-model="search" placeholder="Cari nama atau kode alat..." 
                                   class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-lg shadow-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">
                        </div>
                    </div>
                    
                    <!-- Alat List -->
                    <div class="max-h-[28rem] overflow-y-auto space-y-2 pr-1 custom-scrollbar">
                        @foreach($alats as $alat)
                            <div class="flex items-center justify-between p-4 border border-slate-200 rounded-xl hover:bg-slate-50/50 hover:border-indigo-200 transition-all"
                                 x-show="'{{ strtolower($alat->nama_alat) }}'.includes(search.toLowerCase()) || '{{ strtolower($alat->kode_alat) }}'.includes(search.toLowerCase())">
                                <div class="flex-1">
                                    <p class="font-semibold text-slate-800">{{ $alat->nama_alat }}</p>
                                    <p class="text-sm text-slate-500 font-mono">{{ $alat->kode_alat }} <span class="text-slate-300">•</span> {{ $alat->kategori->nama_kategori }}</p>
                                    <p class="text-sm mt-1">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium {{ $alat->stok > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                            Stok: {{ $alat->stok }}
                                        </span>
                                    </p>
                                </div>
                                @if($alat->stok > 0)
                                    <div class="flex items-center gap-2 ml-4">
                                        <template x-if="!isSelected({{ $alat->id_alat }})">
                                            <button type="button" @click="addAlat({{ $alat->id_alat }}, '{{ $alat->nama_alat }}', {{ $alat->stok }})"
                                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                </svg>
                                                Tambah
                                            </button>
                                        </template>
                                        <template x-if="isSelected({{ $alat->id_alat }})">
                                            <div class="flex items-center gap-1 bg-slate-100 rounded-lg p-1">
                                                <button type="button" @click="decreaseQty({{ $alat->id_alat }})"
                                                        class="w-8 h-8 flex items-center justify-center bg-white rounded-md hover:bg-slate-200 transition-colors text-slate-600 font-medium shadow-sm">-</button>
                                                <span x-text="getQty({{ $alat->id_alat }})" class="w-8 text-center font-semibold text-slate-800"></span>
                                                <button type="button" @click="increaseQty({{ $alat->id_alat }}, {{ $alat->stok }})"
                                                        class="w-8 h-8 flex items-center justify-center bg-white rounded-md hover:bg-slate-200 transition-colors text-slate-600 font-medium shadow-sm">+</button>
                                                <button type="button" @click="removeAlat({{ $alat->id_alat }})"
                                                        class="ml-1 w-8 h-8 flex items-center justify-center text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-md transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                @else
                                    <span class="text-sm text-slate-400 font-medium ml-4">Habis</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </x-card>
            </div>
            
            <!-- Form Peminjaman -->
            <div class="lg:col-span-1">
                <x-card class="sticky top-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-slate-800">Detail Peminjaman</h3>
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
                    
                    <!-- Selected Items Preview -->
                    <div class="mt-5">
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Alat Dipilih</label>
                        <div class="bg-slate-50 rounded-xl p-4 min-h-24 ring-1 ring-slate-200">
                            <template x-if="selectedAlats.length === 0">
                                <div class="text-center py-4">
                                    <svg class="w-8 h-8 text-slate-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="text-sm text-slate-400">Belum ada alat dipilih</p>
                                </div>
                            </template>
                            <ul class="space-y-2">
                                <template x-for="item in selectedAlats" :key="item.id">
                                    <li class="flex items-center justify-between text-sm bg-white px-3 py-2 rounded-lg shadow-sm">
                                        <span x-text="item.nama" class="font-medium text-slate-700"></span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-indigo-100 text-indigo-700 font-semibold text-xs" x-text="'x' + item.qty"></span>
                                        <input type="hidden" :name="'alat[' + item.id + ']'" :value="item.qty">
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <x-button type="submit" variant="success" class="w-full" x-bind:disabled="selectedAlats.length === 0">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Ajukan Peminjaman
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
                selectedAlats: [],
                
                init() {
                    // Pre-select alat if coming from katalog
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