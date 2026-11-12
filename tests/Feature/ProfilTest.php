<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfilTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_profil_page()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)
                         ->get('/admin/profil');

        $response->assertStatus(200);
        $response->assertSee('Ganti Password');
    }

    public function test_password_change_rejects_wrong_current_password()
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'password' => 'password-lama-123',
        ]);

        $response = $this->actingAs($user)
                         ->from('/admin/profil')
                         ->put('/admin/profil/password', [
                             'password_saat_ini' => 'SALAH',
                             'password' => 'password-baru-456',
                             'password_confirmation' => 'password-baru-456',
                         ]);

        $response->assertSessionHasErrors('password_saat_ini');
        $this->assertTrue(Hash::check('password-lama-123', $user->fresh()->password));
    }

    public function test_password_change_rejects_mismatched_confirmation()
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'password' => 'password-lama-123',
        ]);

        $response = $this->actingAs($user)
                         ->from('/admin/profil')
                         ->put('/admin/profil/password', [
                             'password_saat_ini' => 'password-lama-123',
                             'password' => 'password-baru-456',
                             'password_confirmation' => 'BEDA',
                         ]);

        $response->assertSessionHasErrors('password');
        $this->assertTrue(Hash::check('password-lama-123', $user->fresh()->password));
    }

    public function test_password_change_succeeds_and_new_password_works()
    {
        $user = User::factory()->create([
            'role' => 'admin',
            'password' => 'password-lama-123',
        ]);

        $response = $this->actingAs($user)
                         ->from('/admin/profil')
                         ->put('/admin/profil/password', [
                             'password_saat_ini' => 'password-lama-123',
                             'password' => 'password-baru-456',
                             'password_confirmation' => 'password-baru-456',
                         ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/admin/profil');
        $response->assertSessionHas('success');
        $this->assertTrue(Hash::check('password-baru-456', $user->fresh()->password));

        // Login ulang dengan password baru harus berhasil
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password-baru-456',
        ])->assertRedirect('/admin/dashboard');
    }

    public function test_guest_cannot_access_profil_page()
    {
        $response = $this->get('/admin/profil');

        $response->assertRedirect('/login');
    }
}
