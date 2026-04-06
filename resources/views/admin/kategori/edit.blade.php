<x-layouts.app title="Edit Kategori">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8">
        <nav class="flex items-center text-sm text-slate-500 mb-4">
            <a href="{{ route('admin.kategori.index') }}" class="hover:text-indigo-600 transition-colors">Manajemen Kategori</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-slate-700 font-medium">Edit Kategori</span>
        </nav>
        <h1 class="text-2xl font-bold text-slate-800">Edit Kategori</h1>
        <p class="mt-1 text-slate-500">Perbarui informasi kategori: <span class="font-medium text-slate-700">{{ $kategori->nama_kategori }}</span></p>
    </div>
    
    <x-card class="max-w-2xl mx-auto">
        <form method="POST" action="{{ route('admin.kategori.update', $kategori->id_kategori) }}">
            @csrf
            @method('PUT')
            
            <x-input 
                label="Nama Kategori" 
                name="nama_kategori" 
                :value="$kategori->nama_kategori"
                placeholder="Masukkan nama kategori"
                required
            />
            
            <x-textarea 
                label="Deskripsi" 
                name="deskripsi" 
                :value="$kategori->deskripsi"
                placeholder="Masukkan deskripsi kategori (opsional)"
            />
            
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.kategori.index') }}" class="px-4 py-2.5 border border-slate-300 rounded-lg text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                    Batal
                </a>
                <x-button type="submit" variant="primary">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </x-button>
            </div>
        </form>
    </x-card>
</x-layouts.app>