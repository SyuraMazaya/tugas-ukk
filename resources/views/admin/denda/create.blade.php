<x-layouts.app title="Tambah Denda">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8">
        <nav class="flex items-center text-sm text-slate-500 mb-4">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('admin.denda.index') }}" class="hover:text-indigo-600 transition-colors">Denda</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-slate-700 font-medium">Tambah</span>
        </nav>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Tambah Denda Baru</h1>
                <p class="mt-1 text-slate-500">Tambahkan konfigurasi denda baru ke sistem</p>
            </div>
            <a href="{{ route('admin.denda.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 max-w-6xl mx-auto">
        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="flex items-center px-6 py-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="ml-3 text-lg font-semibold text-slate-800">Form Denda</h3>
            </div>
            
            <form action="{{ route('admin.denda.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <!-- Nama Denda -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Nama Denda <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama_denda" value="{{ old('nama_denda') }}" required
                           class="w-full px-4 py-3 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 @error('nama_denda') border-rose-500 @enderror"
                           placeholder="Contoh: Denda Keterlambatan Pengembalian">
                    @error('nama_denda')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Jumlah Denda -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Jumlah Denda per Hari (Rp) <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">Rp</span>
                        <input type="number" name="jumlah_denda" value="{{ old('jumlah_denda', '1000') }}" min="0" step="0.01" required
                               class="w-full pl-10 pr-4 py-3 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 @error('jumlah_denda') border-rose-500 @enderror"
                               placeholder="0">
                    </div>
                    @error('jumlah_denda')
                        <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-slate-500">Denda yang dikenakan untuk setiap hari keterlambatan</p>
                </div>
                
                <!-- Deskripsi -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" 
                              class="w-full px-4 py-3 text-sm text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 placeholder-slate-400 resize-none"
                              placeholder="Tuliskan deskripsi denda (opsional)">{{ old('deskripsi') }}</textarea>
                </div>
                
                <!-- Status -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Status</label>
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-slate-700">Aktif</span>
                    </label>
                    <p class="mt-1.5 text-xs text-slate-500">Denda aktif akan digunakan dalam perhitungan pengembalian</p>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
                    <a href="{{ route('admin.denda.index') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Simpan Denda
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Info Box -->
        <div class="space-y-6">
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-indigo-200 rounded-xl p-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-indigo-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="ml-4">
                        <h4 class="text-sm font-semibold text-indigo-900">Tentang Denda</h4>
                        <p class="mt-1 text-sm text-indigo-800">Denda adalah biaya yang dikenakan ketika peminjam terlambat mengembalikan barang. Besarnya denda dapat dikonfigurasi dari halaman ini.</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-200 rounded-xl p-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-amber-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2m6-4a2 2 0 11-4 0 2 2 0 014 0zM7 20a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <div class="ml-4">
                        <h4 class="text-sm font-semibold text-amber-900">Catatan Penting</h4>
                        <ul class="mt-2 text-sm text-amber-800 space-y-1 list-disc list-inside">
                            <li>Hanya satu denda aktif yang akan digunakan</li>
                            <li>Denda dihitung per hari keterlambatan</li>
                            <li>Data denda tidak bisa diubah setelah digunakan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
