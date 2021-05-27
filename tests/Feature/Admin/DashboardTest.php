<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_guest_cannot_access_the_dashboard()
    {
        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }

    public function test_a_registered_user_can_access_the_dashboard()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('dashboard'));
        $response->assertSee('Dashboard');
        $response->assertStatus(200);
    }
}
