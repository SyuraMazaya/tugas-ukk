<x-layouts.app title="Edit User">
    <x-slot:sidebar>
        @include('partials.admin-sidebar')
    </x-slot:sidebar>

    @php
        $rolePalette = [
            'admin' => 'bg-rose-100 text-rose-700 ring-rose-200',
            'petugas' => 'bg-sky-100 text-sky-700 ring-sky-200',
            'peminjam' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
        ];
    @endphp

    <!-- Page Header -->
    <div class="mb-6 rounded-2xl bg-gradient-to-r from-cyan-500 via-blue-500 to-indigo-500 p-6 shadow-lg border border-cyan-200/50">
        <nav class="flex items-center text-sm text-white/85">
            <a href="{{ route('admin.users.index') }}" class="font-medium hover:text-white transition-colors">Manajemen User</a>
            <svg class="w-4 h-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white font-semibold">Edit User</span>
        </nav>
        <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white">Edit User</h1>
                <p class="mt-1 text-sm sm:text-base text-white/85">Perbarui informasi user: <span class="font-semibold text-white">{{ $user->name }}</span></p>
            </div>
            <div class="inline-flex items-center gap-2 rounded-xl bg-white/15 px-4 py-2 text-white backdrop-blur-sm border border-white/25">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>
                </svg>
                <span class="text-sm font-semibold">Mode Edit</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <x-card class="xl:col-span-2 border border-cyan-100/80 shadow-md">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" id="edit-user-form" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="rounded-xl border border-cyan-100 bg-gradient-to-r from-cyan-50 to-blue-50 px-4 py-3">
                <p class="text-sm font-semibold text-cyan-800">Informasi Dasar User</p>
                <p class="text-xs text-cyan-600 mt-0.5">Ubah role, nama, dan username sesuai kebutuhan.</p>
            </div>
            
            <!-- Role Selection -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Role <span class="text-rose-500">*</span>
                </label>
                <select name="role_id" required class="w-full px-4 py-3 border @error('role_id') border-rose-500 @else border-slate-200 @enderror rounded-lg shadow-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <div class="flex items-center gap-2 mt-2 text-rose-600 text-sm">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 16.586l-6.687-6.687a1 1 0 00-1.414 1.414l8 8a1 1 0 001.414 0l10-10z" clip-rule="evenodd" /></svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Name Input -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Lengkap <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text"
                    name="name" 
                    value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-3 border @error('name') border-rose-500 @else border-slate-200 @enderror rounded-lg shadow-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors"
                    placeholder="Masukkan nama lengkap"
                    required
                />
                @error('name')
                    <div class="flex items-center gap-2 mt-2 text-rose-600 text-sm">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 16.586l-6.687-6.687a1 1 0 00-1.414 1.414l8 8a1 1 0 001.414 0l10-10z" clip-rule="evenodd" /></svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Username Input -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Username <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <input 
                        type="text"
                        name="username" 
                        value="{{ old('username', $user->username) }}"
                        class="w-full px-4 py-3 border @error('username') border-rose-500 @else border-slate-200 @enderror rounded-lg shadow-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors"
                        placeholder="username_unik"
                        required
                        pattern="^[a-zA-Z0-9_]+$"
                    />
                </div>
                <p class="mt-1 text-xs text-slate-500">Hanya huruf, angka, dan underscore</p>
                @error('username')
                    <div class="flex items-center gap-2 mt-2 text-rose-600 text-sm">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 16.586l-6.687-6.687a1 1 0 00-1.414 1.414l8 8a1 1 0 001.414 0l10-10z" clip-rule="evenodd" /></svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password Change Section -->
            <div class="p-4 bg-gradient-to-r from-violet-50 to-fuchsia-50 border border-violet-200 rounded-lg">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-violet-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-violet-900">Ubah Password</p>
                        <p class="text-xs text-violet-700 mt-0.5">Kosongkan password jika tidak ingin mengubah. Cukup isi salah satu field untuk mengubah password.</p>
                    </div>
                </div>
            </div>

            <!-- Password Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 space-y-6 md:space-y-0">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Password Baru
                    </label>
                    <div class="relative">
                        <input 
                            type="password"
                            name="password" 
                            class="w-full px-4 py-3 border @error('password') border-rose-500 @else border-slate-200 @enderror rounded-lg shadow-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors"
                            placeholder="Minimal 8 karakter (opsional)"
                            id="password"
                            minlength="8"
                        />
                        <button type="button" class="absolute right-3 top-3 text-slate-400 hover:text-slate-600 toggle-password" data-target="#password">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <div id="password-strength" class="mt-2 flex items-center gap-2" style="display: none;">
                        <div class="flex-1 h-1 bg-slate-200 rounded-full overflow-hidden">
                            <div id="strength-bar" class="h-full w-0 bg-slate-300 transition-all"></div>
                        </div>
                        <span id="strength-text" class="text-xs text-slate-500">-</span>
                    </div>
                    @error('password')
                        <div class="flex items-center gap-2 mt-2 text-rose-600 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 16.586l-6.687-6.687a1 1 0 00-1.414 1.414l8 8a1 1 0 001.414 0l10-10z" clip-rule="evenodd" /></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Konfirmasi Password Baru
                    </label>
                    <div class="relative">
                        <input 
                            type="password"
                            name="password_confirmation" 
                            class="w-full px-4 py-3 border @error('password_confirmation') border-rose-500 @else border-slate-200 @enderror rounded-lg shadow-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors"
                            placeholder="Ulangi password baru (opsional)"
                            id="password_confirmation"
                            minlength="8"
                        />
                        <button type="button" class="absolute right-3 top-3 text-slate-400 hover:text-slate-600 toggle-password" data-target="#password_confirmation">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <div id="password-match" class="mt-2 text-xs text-slate-500" style="display: none;">-</div>
                    @error('password_confirmation')
                        <div class="flex items-center gap-2 mt-2 text-rose-600 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 16.586l-6.687-6.687a1 1 0 00-1.414 1.414l8 8a1 1 0 001.414 0l10-10z" clip-rule="evenodd" /></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2.5 border border-slate-300 rounded-lg text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-cyan-600 to-indigo-600 text-white rounded-lg font-semibold text-sm hover:from-cyan-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition-all disabled:opacity-50 disabled:cursor-not-allowed" id="submit-btn">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span id="submit-text">Simpan Perubahan</span>
                </button>
            </div>
        </form>
        </x-card>

        <div class="space-y-5">
            <x-card class="border border-cyan-100 bg-gradient-to-br from-cyan-50 via-sky-50 to-white shadow-sm">
                <h3 class="text-sm font-bold text-cyan-900">Ringkasan User</h3>
                <div class="mt-3 space-y-2">
                    <div class="flex items-center justify-between rounded-lg bg-white/85 border border-white px-3 py-2">
                        <span class="text-sm text-slate-600">Nama</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $user->name }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-lg bg-white/85 border border-white px-3 py-2">
                        <span class="text-sm text-slate-600">Username</span>
                        <span class="text-sm font-mono text-slate-800">{{ $user->username }}</span>
                    </div>
                    <div class="flex items-center justify-between rounded-lg bg-white/85 border border-white px-3 py-2">
                        <span class="text-sm text-slate-600">Role</span>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold ring-1 ring-inset {{ $rolePalette[strtolower($user->role->name)] ?? 'bg-slate-100 text-slate-700 ring-slate-200' }}">
                            {{ ucfirst($user->role->name) }}
                        </span>
                    </div>
                </div>
            </x-card>

            <x-card class="border border-violet-100 bg-gradient-to-br from-violet-50 via-purple-50 to-white shadow-sm">
                <h3 class="text-sm font-bold text-violet-900">Tips Update Aman</h3>
                <div class="mt-3 space-y-2 text-sm text-violet-700">
                    <p>Ganti username hanya jika diperlukan agar histori tetap mudah dilacak.</p>
                    <p>Jika password tidak berubah, biarkan field password kosong.</p>
                    <p>Perubahan role akan mempengaruhi hak akses user secara langsung.</p>
                </div>
            </x-card>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', function() {
                const targetId = this.dataset.target;
                const input = document.querySelector(targetId);
                const type = input.type === 'password' ? 'text' : 'password';
                input.type = type;
            });
        });

        // Password strength indicator (for new password)
        const passwordInput = document.getElementById('password');
        const passwordStrengthDiv = document.getElementById('password-strength');
        const strengthBar = document.getElementById('strength-bar');
        const strengthText = document.getElementById('strength-text');
        const passwordMatch = document.getElementById('password-match');
        const confirmInput = document.getElementById('password_confirmation');

        function checkPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength += 25;
            if (password.length >= 12) strength += 25;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 25;
            if (/[0-9]/.test(password)) strength += 15;
            if (/[^a-zA-Z0-9]/.test(password)) strength += 10;
            return Math.min(strength, 100);
        }

        function updatePasswordStrength() {
            if (!passwordInput.value) {
                passwordStrengthDiv.style.display = 'none';
                passwordMatch.style.display = 'none';
                return;
            }

            passwordStrengthDiv.style.display = 'flex';
            
            const strength = checkPasswordStrength(passwordInput.value);
            strengthBar.style.width = strength + '%';
            
            if (strength === 0) {
                strengthText.textContent = '-';
                strengthBar.className = 'h-full w-0 bg-slate-300 transition-all';
            } else if (strength < 40) {
                strengthText.textContent = 'Lemah';
                strengthBar.className = 'h-full bg-rose-500 transition-all';
            } else if (strength < 70) {
                strengthText.textContent = 'Sedang';
                strengthBar.className = 'h-full bg-amber-500 transition-all';
            } else {
                strengthText.textContent = 'Kuat';
                strengthBar.className = 'h-full bg-emerald-500 transition-all';
            }

            // Check password match
            if (confirmInput.value) {
                passwordMatch.style.display = 'block';
                if (passwordInput.value === confirmInput.value) {
                    passwordMatch.textContent = '✓ Password sesuai';
                    passwordMatch.className = 'mt-2 text-xs text-emerald-600';
                } else {
                    passwordMatch.textContent = '✗ Password tidak sesuai';
                    passwordMatch.className = 'mt-2 text-xs text-rose-600';
                }
            } else {
                passwordMatch.style.display = 'none';
            }
        }

        passwordInput.addEventListener('input', updatePasswordStrength);
        confirmInput.addEventListener('input', updatePasswordStrength);

        // Form submission
        document.getElementById('edit-user-form').addEventListener('submit', function() {
            const btn = document.getElementById('submit-btn');
            btn.disabled = true;
            document.getElementById('submit-text').textContent = 'Menyimpan...';
        });
    </script>
</x-layouts.app>