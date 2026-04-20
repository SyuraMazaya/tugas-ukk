<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Mail\TwoFactorCodeMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class AuthController extends Controller
{
    /**
     * Show login form.
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login attempt.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            /** @var User $user */
            $user = Auth::user();

            // If 2FA is enabled, redirect to verification page
            if ($user->two_fa_enabled) {
                // Check if 2FA was verified in the last 12 hours (using cookie)
                if ($request->hasCookie('2fa_verified_' . $user->id)) {
                    $request->session()->regenerate();

                    // Redirect based on role
                    if ($user->isAdmin()) {
                        return redirect()->intended(route('admin.dashboard'));
                    } elseif ($user->isPetugas()) {
                        return redirect()->intended(route('petugas.dashboard'));
                    } else {
                        return redirect()->intended(route('peminjam.dashboard'));
                    }
                }

                if (blank($user->email)) {
                    Auth::logout();

                    return back()->withErrors([
                        'username' => 'Email akun belum terisi. Hubungi admin untuk mengaktifkan 2FA.',
                    ])->onlyInput('username');
                }

                $code = $user->generateTwoFACode();

                try {
                    Mail::to($user->email)->send(new TwoFactorCodeMail($user->name, $code));
                } catch (Throwable $exception) {
                    Log::error('Gagal mengirim email kode 2FA saat login.', [
                        'user_id' => $user->id,
                        'email' => $user->email,
                        'exception' => $exception->getMessage(),
                    ]);

                    Auth::logout();

                    return back()->withErrors([
                        'username' => 'Gagal mengirim kode 2FA ke email Anda. Silakan coba lagi.',
                    ])->onlyInput('username');
                }

                // Store user ID in session for 2FA verification
                $request->session()->put('2fa_user_id', $user->id);

                // Logout but keep session
                Auth::logout();

                return redirect()->route('verify-2fa')
                    ->with('status', 'Kode verifikasi telah dikirim ke email Anda.');
            }

            $request->session()->regenerate();

            // Redirect based on role
            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->isPetugas()) {
                return redirect()->intended(route('petugas.dashboard'));
            } else {
                return redirect()->intended(route('peminjam.dashboard'));
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Show 2FA verification form.
     */
    public function showTwoFAForm(): View|RedirectResponse
    {
        if (! session('2fa_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.verify-2fa');
    }

    /**
     * Verify 2FA code
     */
    public function verifyTwoFA(Request $request): RedirectResponse
    {
        $request->validate([
            'two_fa_code' => ['required', 'numeric', 'digits:6'],
        ], [
            'two_fa_code.required' => 'Kode 2FA wajib diisi.',
            'two_fa_code.numeric' => 'Kode 2FA harus berupa angka.',
            'two_fa_code.digits' => 'Kode 2FA harus terdiri dari 6 digit.',
        ]);

        $userId = session('2fa_user_id');
        if (! $userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);
        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->verifyTwoFACode($request->input('two_fa_code'))) {
            Auth::login($user, false);
            $request->session()->regenerate();
            $request->session()->forget('2fa_user_id');

            // Set cookie for 12 hours (720 minutes)
            $cookie = cookie('2fa_verified_' . $user->id, true, 720);

            // Redirect based on role
            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'))->withCookie($cookie);
            } elseif ($user->isPetugas()) {
                return redirect()->intended(route('petugas.dashboard'))->withCookie($cookie);
            } else {
                return redirect()->intended(route('peminjam.dashboard'))->withCookie($cookie);
            }
        }

        return back()->withErrors([
            'two_fa_code' => 'Kode 2FA salah atau sudah expired.',
        ]);
    }

    /**
     * Resend 2FA code via email.
     */
    public function resendTwoFA(Request $request): RedirectResponse
    {
        $userId = session('2fa_user_id');
        if (! $userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);
        if (! $user) {
            return redirect()->route('login');
        }

        if (blank($user->email)) {
            return back()->withErrors([
                'two_fa_code' => 'Email akun belum terisi. Hubungi admin untuk mengaktifkan 2FA.',
            ]);
        }

        $code = $user->generateTwoFACode();

        try {
            Mail::to($user->email)->send(new TwoFactorCodeMail($user->name, $code));
        } catch (Throwable $exception) {
            Log::error('Gagal mengirim ulang email kode 2FA.', [
                'user_id' => $user->id,
                'email' => $user->email,
                'exception' => $exception->getMessage(),
            ]);

            return back()->withErrors([
                'two_fa_code' => 'Gagal mengirim ulang kode 2FA. Silakan coba beberapa saat lagi.',
            ]);
        }

        return back()->with('status', 'Kode verifikasi baru telah dikirim ke email Anda.');
    }
}
