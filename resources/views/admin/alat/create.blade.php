<x-layouts.app title="Tambah Alat">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8">
        <nav class="flex items-center text-sm text-slate-500 mb-4">
            <a href="{{ route('admin.alat.index') }}" class="hover:text-indigo-600 transition-colors">Manajemen Alat</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-slate-700 font-medium">Tambah Alat</span>
        </nav>
        <h1 class="text-2xl font-bold text-slate-800">Tambah Alat Baru</h1>
        <p class="mt-1 text-slate-500">Tambahkan alat produktif baru ke sistem</p>
    </div>
    
    <x-card class="max-w-2xl mx-auto">
        <form method="POST" action="{{ route('admin.alat.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                <x-select 
                    label="Kategori" 
                    name="kategori_id" 
                    :options="$kategoris->pluck('nama_kategori', 'id_kategori')"
                    required
                />
                
                <x-select 
                    label="Kondisi" 
                    name="kondisi" 
                    :options="['baik' => 'Baik', 'rusak_ringan' => 'Rusak Ringan']"
                    required
                />
            </div>
            
            <x-input 
                label="Nama Alat" 
                name="nama_alat" 
                placeholder="Masukkan nama alat"
                required
            />
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                <x-input 
                    label="Kode Alat" 
                    name="kode_alat" 
                    placeholder="Contoh: ELK-001"
                    required
                />
                
                <x-input 
                    label="Stok" 
                    name="stok" 
                    type="number"
                    value="0"
                    required
                />
            </div>
            
            <div class="mb-5">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Gambar Alat</label>
                <div class="border-2 border-dashed border-slate-200 rounded-xl px-6 py-8 text-center hover:border-indigo-400 transition-colors">
                    <div class="mx-auto w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <input type="file" name="gambar" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                    <p class="mt-2 text-xs text-slate-500">Format: JPG, PNG, GIF. Maks: 2MB</p>
                </div>
                @error('gambar')
                    <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.alat.index') }}" class="px-4 py-2.5 border border-slate-300 rounded-lg text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                    Batal
                </a>
                <x-button type="submit" variant="primary">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan
                </x-button>
            </div>
        </form>
    </x-card>
</x-layouts.app>