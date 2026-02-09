<x-layouts.app title="Edit User">
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
            <span class="text-slate-700 font-medium">Edit User</span>
        </nav>
        <h1 class="text-2xl font-bold text-slate-800">Edit User</h1>
        <p class="mt-1 text-slate-500">Perbarui informasi user: <span class="font-medium text-slate-700">{{ $user->name }}</span></p>
    </div>
    
    <x-card class="max-w-2xl">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')
            
            <x-select 
                label="Role" 
                name="role_id" 
                :options="$roles->pluck('name', 'id')->map(fn($name) => ucfirst($name))"
                :selected="$user->role_id"
                required
            />
            
            <x-input 
                label="Nama Lengkap" 
                name="name" 
                :value="$user->name"
                placeholder="Masukkan nama lengkap"
                required
            />
            
            <x-input 
                label="Username" 
                name="username" 
                :value="$user->username"
                placeholder="Masukkan username"
                required
            />
            
            <div class="p-4 bg-amber-50 border border-amber-100 rounded-xl mb-5">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-amber-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="ml-2 text-sm text-amber-800">Kosongkan password jika tidak ingin mengubah</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                <x-input 
                    label="Password Baru" 
                    name="password" 
                    type="password"
                    placeholder="Masukkan password baru"
                />
                
                <x-input 
                    label="Konfirmasi Password" 
                    name="password_confirmation" 
                    type="password"
                    placeholder="Ulangi password baru"
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
                    Simpan Perubahan
                </x-button>
            </div>
        </form>
    </x-card>
</x-layouts.app>