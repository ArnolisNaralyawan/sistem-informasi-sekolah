<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_dashboard()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)
                         ->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_guru_cannot_access_admin_dashboard()
    {
        $user = User::factory()->create(['role' => 'guru']);

        $response = $this->actingAs($user)
                         ->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_siswa_cannot_access_admin_dashboard()
    {
        $user = User::factory()->create(['role' => 'siswa']);

        $response = $this->actingAs($user)
                         ->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_guest_redirected_to_login()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }
}