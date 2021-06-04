<?php

namespace Tests\Feature\Views;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MenuTest extends TestCase
{
    public function test_a_guest_cannot_see_admin_panel_link()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(config('app.name'));
        $response->assertSee(__('Login'));
        $response->assertSee(__('Register'));
        $response->assertDontSee('Admin Panel');
        $response->assertDontSee(__('Logout'));
    }

    public function test_a_logged_in_user_cannot_see_admin_panel_link()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(config('app.name'));
        $response->assertDontSee(__('Login'));
        $response->assertDontSee(__('Register'));
        $response->assertDontSee('Admin Panel');
        $response->assertSee(__('Logout'));
    }

    public function test_a_user_with_role_can_see_admin_panel_link()
    {
        $this->actingAs(User::factory()->has(Role::factory()->count(1))->create());
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(config('app.name'));
        $response->assertDontSee(__('Login'));
        $response->assertDontSee(__('Register'));
        $response->assertSee('Admin Panel');
        $response->assertSee(__('Logout'));
    }
}
