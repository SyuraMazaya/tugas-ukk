<x-layouts.app title="Edit Denda">
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
            <span class="text-slate-700 font-medium">Edit</span>
        </nav>
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Edit Denda</h1>
                <p class="mt-1 text-slate-500">Ubah konfigurasi denda</p>
            </div>
            <a href="{{ route('admin.denda.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="flex items-center px-6 py-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <h3 class="ml-3 text-lg font-semibold text-slate-800">Form Denda</h3>
            </div>
            
            <form action="{{ route('admin.denda.update', $denda) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Nama Denda -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Nama Denda <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama_denda" value="{{ old('nama_denda', $denda->nama_denda) }}" required
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
                        <input type="number" name="jumlah_denda" value="{{ old('jumlah_denda', $denda->jumlah_denda) }}" min="0" step="0.01" required
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
                              placeholder="Tuliskan deskripsi denda (opsional)">{{ old('deskripsi', $denda->deskripsi) }}</textarea>
                </div>
                
                <!-- Status -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-3">Status</label>
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $denda->is_active) ? 'checked' : '' }} class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Info Box -->
        <div class="space-y-6">
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 border border-emerald-200 rounded-xl p-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-emerald-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="ml-4">
                        <h4 class="text-sm font-semibold text-emerald-900">Data Saat Ini</h4>
                        <div class="mt-2 text-sm text-emerald-800 space-y-1">
                            <p><strong>Nama:</strong> {{ $denda->nama_denda }}</p>
                            <p><strong>Jumlah:</strong> Rp {{ number_format($denda->jumlah_denda, 0, ',', '.') }}/hari</p>
                            <p><strong>Status:</strong> {{ $denda->is_active ? 'Aktif' : 'Nonaktif' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="ml-4">
                        <h4 class="text-sm font-semibold text-blue-900">Tentang Denda</h4>
                        <p class="mt-1 text-sm text-blue-800">Denda adalah biaya yang dikenakan ketika peminjam terlambat mengembalikan barang.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
