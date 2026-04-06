<x-layouts.guest title="Login">
    <style>
        :root {
            --brand-primary: #3c67e6;
            --brand-secondary: #5d86ff;
            --brand-deep: #2f53c8;
        }

        .login-shell {
            position: relative;
            border-radius: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.75);
            background: rgba(255, 255, 255, 0.58);
            box-shadow: 0 24px 70px rgba(30, 58, 138, 0.2);
            backdrop-filter: blur(10px);
        }

        .stage-orb {
            position: absolute;
            z-index: 0;
            border-radius: 9999px;
            pointer-events: none;
            opacity: 0.65;
            animation: drift 12s ease-in-out infinite;
        }

        .orb-top {
            top: 1rem;
            right: 0.75rem;
            width: 12rem;
            height: 12rem;
            background: radial-gradient(circle at 30% 30%, rgba(163, 191, 255, 0.95), rgba(91, 130, 244, 0.75));
        }

        .orb-bottom {
            bottom: 1rem;
            left: 0.75rem;
            width: 9rem;
            height: 9rem;
            animation-delay: 0.5s;
            background: radial-gradient(circle at 30% 30%, rgba(173, 237, 255, 0.85), rgba(72, 164, 238, 0.7));
        }

        .brand-panel {
            background: linear-gradient(160deg, var(--brand-secondary) 0%, var(--brand-primary) 52%, var(--brand-deep) 100%);
        }

        .brand-panel::before,
        .brand-panel::after {
            content: "";
            position: absolute;
            border-radius: 9999px;
            pointer-events: none;
            opacity: 0.25;
            z-index: 0;
        }

        .brand-panel::before {
            width: 18rem;
            height: 18rem;
            border: 2px solid rgba(255, 255, 255, 0.55);
            bottom: -8rem;
            right: -5rem;
        }

        .brand-panel::after {
            width: 10rem;
            height: 10rem;
            border: 1px solid rgba(255, 255, 255, 0.4);
            top: -3.5rem;
            left: -3.5rem;
        }

        .dot-grid {
            background-image: radial-gradient(rgba(255, 255, 255, 0.45) 1.5px, transparent 1.5px);
            background-size: 14px 14px;
        }

        .form-panel {
            background: linear-gradient(180deg, rgba(248, 251, 255, 0.9) 0%, rgba(240, 246, 255, 0.78) 100%);
        }

        .input-shell {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 0.95rem;
            transform: translateY(-50%);
            width: 1.15rem;
            height: 1.15rem;
            color: #64748b;
            pointer-events: none;
        }

        .input-control {
            width: 100%;
            border-radius: 0.9rem;
            border: 1px solid #cbd5e1;
            background: rgba(255, 255, 255, 0.9);
            padding: 0.82rem 3.85rem 0.82rem 2.75rem;
            font-size: 0.95rem;
            color: #0f172a;
            transition: border-color 0.25s ease, box-shadow 0.25s ease, background-color 0.25s ease;
        }

        .input-control:focus {
            outline: none;
            border-color: #5d86ff;
            box-shadow: 0 0 0 4px rgba(93, 134, 255, 0.18);
            background: #ffffff;
        }

        .btn-login {
            display: inline-flex;
            width: 100%;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border-radius: 0.95rem;
            background: linear-gradient(135deg, var(--brand-primary), var(--brand-secondary));
            padding: 0.85rem 1rem;
            font-weight: 700;
            color: #ffffff;
            transition: transform 0.22s ease, box-shadow 0.22s ease, filter 0.22s ease;
            box-shadow: 0 15px 35px rgba(60, 103, 230, 0.34);
        }

        .btn-login:hover {
            transform: translateY(-1px);
            filter: saturate(1.06);
            box-shadow: 0 18px 35px rgba(60, 103, 230, 0.39);
        }

        .reveal {
            opacity: 0;
            animation: fade-up 0.75s ease forwards;
        }

        .reveal-delay-1 {
            animation-delay: 0.14s;
        }

        .reveal-delay-2 {
            animation-delay: 0.24s;
        }

        @keyframes fade-up {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes drift {
            0%,
            100% {
                transform: translateY(0) translateX(0);
            }

            50% {
                transform: translateY(-8px) translateX(6px);
            }
        }

        @media (max-width: 1023px) {
            .login-shell {
                background: rgba(255, 255, 255, 0.76);
            }
        }
    </style>

    <div class="relative mx-auto flex min-h-screen w-full items-center justify-center px-4 py-10 sm:px-8">
        <span class="stage-orb orb-top" aria-hidden="true"></span>
        <span class="stage-orb orb-bottom" aria-hidden="true"></span>

        <main class="login-shell grid w-full max-w-6xl overflow-hidden lg:grid-cols-2">
            <section class="brand-panel relative hidden px-10 py-12 text-white lg:flex lg:flex-col lg:justify-between">
                <div class="absolute right-8 top-8 h-20 w-20 rounded-full border border-white/35"></div>
                <div class="dot-grid absolute bottom-12 left-10 h-20 w-20 opacity-55"></div>
                <div class="dot-grid absolute right-12 top-40 h-12 w-12 opacity-45"></div>

                <div class="relative z-10 reveal">
                    <span class="inline-flex items-center rounded-full border border-white/30 bg-white/10 px-3 py-1 text-xs font-semibold tracking-[0.14em] uppercase">
                        SIJAMAT-PRO
                    </span>
                    <h2 class="mt-6 font-display text-5xl font-semibold leading-tight">
                        Mulai kelola peminjaman dari sini
                    </h2>
                    <p class="mt-4 max-w-md text-sm leading-relaxed text-blue-50/90">
                        Sistem terpusat untuk memantau stok alat, proses persetujuan, dan riwayat pengembalian secara rapi.
                    </p>
                </div>

                <ul class="relative z-10 reveal reveal-delay-1 space-y-3 text-sm text-blue-50/95">
                    <li class="flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-cyan-200"></span>
                        Monitoring status peminjaman real-time.
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-cyan-200"></span>
                        Notifikasi aktivitas lebih mudah dipantau.
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-cyan-200"></span>
                        Laporan cepat untuk admin dan petugas.
                    </li>
                </ul>
            </section>

            <section class="form-panel flex items-center justify-center px-6 py-8 sm:px-10 sm:py-12">
                <div class="w-full max-w-md reveal reveal-delay-1">
                    <div class="mb-6 rounded-2xl bg-linear-to-r from-blue-600 to-blue-500 p-5 text-white lg:hidden">
                        <p class="text-xs font-semibold tracking-[0.16em] uppercase text-blue-100">SIJAMAT-PRO</p>
                        <p class="mt-2 font-display text-2xl">Selamat datang kembali</p>
                        <p class="mt-1 text-sm text-blue-100">Masuk untuk melanjutkan proses peminjaman alat.</p>
                    </div>

                    <div class="mb-8">
                        <h1 class="font-display text-3xl font-semibold text-slate-800">Hello, selamat datang kembali</h1>
                        <p class="mt-2 text-sm text-slate-500">
                            Login untuk mengakses dashboard peminjaman dan pengembalian alat.
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

                    <form method="POST" action="{{ route('login') }}" class="space-y-5 reveal reveal-delay-2">
                        @csrf

                        <div>
                            <label for="username" class="mb-2 block text-sm font-semibold text-slate-700">Username</label>
                            <div class="input-shell">
                                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    value="{{ old('username') }}"
                                    class="input-control @error('username') border-red-300 ring-4 ring-red-100 @enderror"
                                    placeholder="Masukkan username Anda"
                                    autocomplete="username"
                                    required
                                    autofocus
                                >
                            </div>
                            @error('username')
                                <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                            <div class="input-shell">
                                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="input-control @error('password') border-red-300 ring-4 ring-red-100 @enderror"
                                    placeholder="Masukkan password Anda"
                                    autocomplete="current-password"
                                    required
                                >
                                <button
                                    type="button"
                                    id="toggle-password"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 rounded-md px-2 py-1 text-xs font-semibold text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-700"
                                    aria-label="Tampilkan password"
                                >
                                    <span data-toggle-text>Tampilkan</span>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2 text-sm text-slate-600 sm:flex-row sm:items-center sm:justify-between">
                            <label class="inline-flex cursor-pointer items-center gap-2">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                    {{ old('remember') ? 'checked' : '' }}
                                >
                                <span>Ingat saya di perangkat ini</span>
                            </label>
                            <span class="text-xs text-slate-500">Lupa password? Hubungi admin.</span>
                        </div>

                        <button type="submit" class="btn-login group">
                            <span>Masuk ke Dashboard</span>
                            <svg class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                    </form>

                    <p class="mt-6 text-center text-xs text-slate-500">
                        © {{ date('Y') }} SIJAMAT-PRO. Sistem Peminjaman Alat Produktif.
                    </p>
                </div>
            </section>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var passwordInput = document.getElementById('password');
            var togglePasswordButton = document.getElementById('toggle-password');

            if (!passwordInput || !togglePasswordButton) {
                return;
            }

            togglePasswordButton.addEventListener('click', function () {
                var isPasswordType = passwordInput.type === 'password';
                passwordInput.type = isPasswordType ? 'text' : 'password';

                var toggleText = togglePasswordButton.querySelector('[data-toggle-text]');
                if (toggleText) {
                    toggleText.textContent = isPasswordType ? 'Sembunyikan' : 'Tampilkan';
                }

                togglePasswordButton.setAttribute(
                    'aria-label',
                    isPasswordType ? 'Sembunyikan password' : 'Tampilkan password'
                );
            });
        });
    </script>
</x-layouts.guest>