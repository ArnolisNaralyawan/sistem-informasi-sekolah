<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_lupa_password_page_renders()
    {
        $response = $this->get('/lupa-password');

        $response->assertStatus(200);
        $response->assertSee('Lupa Password');
    }

    public function test_reset_page_renders_with_token_and_email()
    {
        $response = $this->get('/reset-password/token-rahasia?email=admin@example.com');

        $response->assertStatus(200);
        $response->assertSee('token-rahasia', false);
        $response->assertSee('admin@example.com');
    }

    public function test_reset_link_sent_to_registered_email()
    {
        Notification::fake();
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->post('/lupa-password', ['email' => $user->email]);

        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('status');

        Notification::assertSentTo($user, ResetPasswordNotification::class);

        // Token tersimpan di tabel password_reset_tokens
        $this->assertDatabaseHas('password_reset_tokens', ['email' => $user->email]);
    }

    public function test_reset_link_rejected_for_unknown_email()
    {
        Notification::fake();

        $response = $this->post('/lupa-password', ['email' => 'tidak-ada@example.com']);

        $response->assertSessionHasErrors('email');
        Notification::assertNothingSent();
    }

    public function test_password_reset_with_valid_token_succeeds()
    {
        Notification::fake();
        $user = User::factory()->create(['role' => 'admin', 'password' => 'password-lama-123']);

        $this->post('/lupa-password', ['email' => $user->email]);
        // Token asli ada di notifikasi (di database tersimpan ter-hash)
        $token = Notification::sent($user, ResetPasswordNotification::class)->first()->token;

        $response = $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'password-baru-456',
            'password_confirmation' => 'password-baru-456',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/login');
        $response->assertSessionHas('reset_success');
        $this->assertTrue(Hash::check('password-baru-456', $user->fresh()->password));

        // Login dengan password baru berhasil
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password-baru-456',
        ])->assertRedirect('/admin/dashboard');
    }

    public function test_password_reset_with_invalid_token_fails()
    {
        $user = User::factory()->create(['role' => 'admin', 'password' => 'password-lama-123']);

        $response = $this->post('/reset-password', [
            'token' => 'token-palsu',
            'email' => $user->email,
            'password' => 'password-baru-456',
            'password_confirmation' => 'password-baru-456',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertTrue(Hash::check('password-lama-123', $user->fresh()->password));
    }

    public function test_guest_cannot_access_protected_password_pages()
    {
        // Halaman lupa password publik; memastikan suite tetap menjaga login tidak rusak
        $this->get('/admin/profil')->assertRedirect('/login');
    }
}
