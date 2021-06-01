<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_role_can_be_created()
    {
        $role = Role::factory()->create();

        $this->assertDatabaseHas('roles', ['id' => $role->id]);
    }

    public function test_a_role_can_have_a_title()
    {
        $role = Role::factory()->create();

        $this->assertDatabaseHas('roles', ['title' => $role->title]);
    }

    public function test_a_role_title_must_be_unique()
    {
        $role1 = null;
        $role2 = null;

        try {
            $role1 = Role::factory()->create(['title' => 'admin']);
            $role2 = Role::factory()->create(['title' => 'admin']);
        } catch (Exception $e) {
        } finally {
            $this->assertNotNull($role1);
            $this->assertNull($role2);
            $this->assertDatabaseHas('roles', ['title' => $role1->title]);
        }
    }

    public function test_a_user_can_have_a_role()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $user->roles()->sync($role);

        $this->assertNotNull($user->roles);
        $this->assertCount(1, $user->roles);
    }

    public function test_a_user_can_have_multiple_roles()
    {
        $user = User::factory()->create();
        $role1 = Role::factory()->create();
        $role2 = Role::factory()->create();
        $user->roles()->sync([$role1->id, $role2->id]);

        $this->assertNotNull($user->roles);
        $this->assertCount(2, $user->roles);
    }

    public function test_a_role_can_belong_to_a_user()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $role->users()->sync($user);

        $this->assertNotNull($role->users);
        $this->assertCount(1, $role->users);
    }

    public function test_a_role_can_belong_to_many_users()
    {
        $role = Role::factory()->create();
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $role->users()->sync([$user1->id, $user2->id]);

        $this->assertNotNull($role->users);
        $this->assertCount(2, $role->users);
    }

}
