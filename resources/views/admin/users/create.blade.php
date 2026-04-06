<x-layouts.app title="Tambah User">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>
    
    <!-- Page Header -->
    <div class="mb-8">
        <nav class="flex items-center text-sm text-slate-500 mb-4">
            <a href="{{ route('admin.users.index') }}" class="hover:text-indigo-600 transition-colors">Manajemen User</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-slate-700 font-medium">Tambah User</span>
        </nav>
        <h1 class="text-2xl font-bold text-slate-800">Tambah User Baru</h1>
        <p class="mt-1 text-slate-500">Buat akun user baru untuk sistem</p>
    </div>
    
    <x-card class="max-w-2xl mx-auto">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            
            <x-select 
                label="Role" 
                name="role_id" 
                :options="$roles->pluck('name', 'id')->map(fn($name) => ucfirst($name))"
                required
            />
            
            <x-input 
                label="Nama Lengkap" 
                name="name" 
                placeholder="Masukkan nama lengkap"
                required
            />
            
            <x-input 
                label="Username" 
                name="username" 
                placeholder="Masukkan username"
                required
            />
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                <x-input 
                    label="Password" 
                    name="password" 
                    type="password"
                    placeholder="Masukkan password"
                    required
                />
                
                <x-input 
                    label="Konfirmasi Password" 
                    name="password_confirmation" 
                    type="password"
                    placeholder="Ulangi password"
                    required
                />
            </div>
            
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2.5 border border-slate-300 rounded-lg text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
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