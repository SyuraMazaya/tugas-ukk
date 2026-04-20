<x-layouts.guest title="Verifikasi 2FA">
    <div class="relative mx-auto flex min-h-screen w-full items-center justify-center px-4 py-10 sm:px-8">
        <main class="w-full max-w-md">
            <div class="rounded-2xl border border-indigo-200/60 bg-white shadow-lg p-8 sm:p-10">
                <div class="mb-8 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h1 class="font-display text-2xl font-semibold text-slate-800">Verifikasi Dua Faktor</h1>
                    <p class="mt-2 text-sm text-slate-500">
                        Masukkan kode 6 digit yang telah dikirim ke akun Anda
                    </p>
                </div>

                @if($errors->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50/95 p-4" role="alert" aria-live="polite">
                        <div class="flex items-start gap-3">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <div class="space-y-1 text-sm text-red-700">
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('status'))
                    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50/95 p-4" role="status" aria-live="polite">
                        <p class="text-sm text-emerald-700">{{ session('status') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('verify-2fa-post') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="two_fa_code" class="block text-sm font-semibold text-slate-700 mb-2">Kode 2FA</label>
                        <input
                            type="text"
                            id="two_fa_code"
                            name="two_fa_code"
                            inputmode="numeric"
                            maxlength="6"
                            placeholder="000000"
                            class="w-full text-center text-2xl font-mono tracking-widest rounded-xl border-2 border-indigo-200 bg-slate-50 px-4 py-3 text-slate-800 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all"
                            autocomplete="off"
                            required
                            autofocus
                        >
                        <p class="mt-2 text-xs text-slate-500">
                            Kode berlaku selama 10 menit
                        </p>
                    </div>

                    <button type="submit" class="w-full inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700 transition-colors shadow-sm hover:shadow-md">
                        Verifikasi Kode
                    </button>

                    <button
                        type="submit"
                        form="resend-2fa-form"
                        class="w-full inline-flex items-center justify-center rounded-xl border border-indigo-200 bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-700 hover:bg-indigo-100 transition-colors"
                    >
                        Kirim Ulang Kode
                    </button>

                    <div class="flex items-center gap-3">
                        <div class="flex-1 border-t border-slate-200"></div>
                        <span class="text-xs text-slate-500">atau</span>
                        <div class="flex-1 border-t border-slate-200"></div>
                    </div>

                    <a href="{{ route('login') }}" class="block w-full text-center rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                        Kembali ke Login
                    </a>
                </form>

                <form id="resend-2fa-form" method="POST" action="{{ route('verify-2fa-resend') }}" class="hidden">
                    @csrf
                </form>

                <p class="mt-6 text-center text-xs text-slate-500">
                    © {{ date('Y') }} SIJAMAT-PRO. Sistem Peminjaman Alat Produktif.
                </p>
            </div>
        </main>
    </div>

    @push('scripts')
    <script>
        const input = document.getElementById('two_fa_code');
        
        // Only allow numbers
        input.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });

        // Auto-submit when 6 digits entered
        input.addEventListener('input', function(e) {
            if (e.target.value.length === 6) {
                // Optional: auto-submit form
                // e.target.form.submit();
            }
        });
    </script>
    @endpush
</x-layouts.guest>
