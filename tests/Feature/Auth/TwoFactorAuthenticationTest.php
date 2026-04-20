<?php

namespace Tests\Feature\Auth;

use App\Mail\TwoFactorCodeMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class TwoFactorAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_with_two_factor_enabled_sends_verification_email(): void
    {
        Mail::fake();

        $role = Role::create(['name' => 'admin']);

        $user = User::create([
            'role_id' => $role->id,
            'name' => 'Admin Test',
            'username' => 'admin_test',
            'email' => 'admin.test@example.com',
            'nomor_telepon' => '081234567890',
            'password' => 'secret123',
            'two_fa_enabled' => true,
        ]);

        $response = $this->post('/login', [
            'username' => 'admin_test',
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('verify-2fa'));
        $this->assertGuest();
        $response->assertSessionHas('2fa_user_id', $user->id);

        $user->refresh();
        $this->assertNotNull($user->two_fa_code);
        $this->assertNotNull($user->two_fa_code_expires_at);

        Mail::assertSent(TwoFactorCodeMail::class, function (TwoFactorCodeMail $mail) use ($user) {
            return $mail->hasTo($user->email)
                && $mail->code === $user->two_fa_code;
        });
    }

    public function test_user_can_complete_two_factor_verification_with_valid_code(): void
    {
        $role = Role::create(['name' => 'admin']);

        $user = User::create([
            'role_id' => $role->id,
            'name' => 'Admin Test',
            'username' => 'admin_test',
            'email' => 'admin.test@example.com',
            'nomor_telepon' => '081234567890',
            'password' => 'secret123',
            'two_fa_enabled' => true,
        ]);

        $code = $user->generateTwoFACode();

        $response = $this
            ->withSession(['2fa_user_id' => $user->id])
            ->post('/verify-2fa', [
                'two_fa_code' => $code,
            ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);

        $user->refresh();
        $this->assertNull($user->two_fa_code);
        $this->assertNull($user->two_fa_code_expires_at);
    }
}
