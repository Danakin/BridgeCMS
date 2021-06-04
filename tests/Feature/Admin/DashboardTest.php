<?php

namespace Tests\Feature\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_a_guest_cannot_access_admin_routes()
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertStatus(403);
    }

    public function test_a_logged_in_user_cannot_access_admin_routes()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('admin.dashboard'));
        $response->assertStatus(403);
    }

    public function test_a_logged_in_user_with_role_can_access_admin_routes()
    {
        $this->actingAs(User::factory()->has(Role::factory()->count(1))->create());
        $response = $this->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Admin Panel');
        $response->assertSee(__('Logout'));
        $response->assertSee(__('Dashboard'));
    }
}
