<x-layouts.app title="Detail Alat">
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
            <span class="text-slate-700 font-medium">Detail</span>
        </nav>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">{{ $alat->nama_alat }}</h1>
                <p class="mt-1 text-slate-500">Kode: <span class="font-mono bg-slate-100 px-2 py-0.5 rounded">{{ $alat->kode_alat }}</span></p>
            </div>
            <a href="{{ route('admin.alat.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Image Card -->
        <div class="lg:col-span-1">
            <x-card class="p-0 overflow-hidden">
                @if($alat->gambar)
                    <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama_alat }}" class="w-full h-72 object-cover">
                @else
                    <div class="w-full h-72 bg-gradient-to-br from-slate-100 to-slate-200 flex flex-col items-center justify-center">
                        <svg class="h-20 w-20 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="mt-2 text-sm text-slate-400">Tidak ada gambar</p>
                    </div>
                @endif
            </x-card>
            
            <!-- Quick Stats -->
            <div class="mt-6 grid grid-cols-2 gap-4">
                <div class="bg-white rounded-xl p-4 ring-1 ring-slate-200">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Stok</p>
                    <p class="mt-1 text-2xl font-bold {{ $alat->stok > 0 ? 'text-emerald-600' : 'text-rose-600' }}">{{ $alat->stok }}</p>
                </div>
                <div class="bg-white rounded-xl p-4 ring-1 ring-slate-200">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kondisi</p>
                    <div class="mt-1">
                        <x-badge :status="$alat->kondisi" />
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Details Card -->
        <div class="lg:col-span-2">
            <x-card>
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="ml-3 text-lg font-semibold text-slate-800">Informasi Alat</h3>
                </div>
                
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Alat</dt>
                        <dd class="mt-1 text-sm font-medium text-slate-800">{{ $alat->nama_alat }}</dd>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kode Alat</dt>
                        <dd class="mt-1 text-sm font-mono text-slate-800">{{ $alat->kode_alat }}</dd>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm font-medium bg-amber-100 text-amber-800">
                                {{ $alat->kategori->nama_kategori }}
                            </span>
                        </dd>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Terakhir Diperbarui</dt>
                        <dd class="mt-1 text-sm text-slate-800">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $alat->updated_at->format('d M Y, H:i') }}
                            </span>
                        </dd>
                    </div>
                </dl>
                
                <div class="flex items-center justify-end gap-3 pt-6 mt-6 border-t border-slate-100">
                    <form method="POST" action="{{ route('admin.alat.destroy', $alat->id_alat) }}" 
                          onsubmit="return confirm('Yakin ingin menghapus alat ini?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2.5 border border-rose-200 rounded-lg text-rose-600 font-semibold text-sm hover:bg-rose-50 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Hapus
                        </button>
                    </form>
                    <a href="{{ route('admin.alat.edit', $alat->id_alat) }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 text-white rounded-lg font-semibold text-sm hover:bg-indigo-700 shadow-sm transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Alat
                    </a>
                </div>
            </x-card>
        </div>
    </div>
</x-layouts.app>