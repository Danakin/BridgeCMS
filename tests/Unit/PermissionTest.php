<?php

namespace Tests\Unit;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_permission_can_be_created()
    {
        $this->withoutExceptionHandling();
        $permission = Permission::factory()->create();

        $this->assertDatabaseHas('permissions', ['id' => $permission->id]);
    }

    public function test_a_permission_can_have_a_title()
    {
        $permission = Permission::factory()->create(['title' => 'create-admin']);

        $this->assertDatabaseHas('permissions', ['title' => $permission->title]);
    }

    public function test_a_permission_title_must_be_unique()
    {
        $permission1 = null;
        $permission2 = null;

        try {
            $permission1 = Permission::factory()->create(['title' => 'create-admin']);
            $permission2 = Permission::factory()->create(['title' => 'create-admin']);
        } catch (Exception $e) {
        } finally {
            $this->assertNotNull($permission1);
            $this->assertNull($permission2);
            $this->assertDatabaseHas('permissions', ['title' => $permission1->title]);
        }
    }

    public function test_a_permission_can_belong_to_a_role()
    {
        $permission = Permission::factory()->create();
        $role = Role::factory()->create();

        $permission->roles()->sync($role);

        $this->assertNotNull($permission->roles);
        $this->assertCount(1, $permission->roles);
    }

    public function test_a_permission_can_belong_to_multiple_roles()
    {
        $permission = Permission::factory()->create();
        $role1 = Role::factory()->create();
        $role2 = Role::factory()->create();

        $permission->roles()->sync([$role1->id, $role2->id]);

        $this->assertNotNull($permission->roles);
        $this->assertCount(2, $permission->roles);
    }

    public function test_a_role_can_have_a_permission()
    {
        $role = Role::factory()->create();
        $permission = Permission::factory()->create();

        $role->permissions()->sync($permission);

        $this->assertNotNull($role->permissions);
        $this->assertCount(1, $role->permissions);
    }

    public function test_a_role_can_have_multiple_permissions()
    {
        $role = Role::factory()->create();
        $permission1 = Permission::factory()->create();
        $permission2 = Permission::factory()->create();

        $role->permissions()->sync([$permission1->id, $permission2->id]);

        $this->assertNotNull($role->permissions);
        $this->assertCount(2, $role->permissions);
    }

    public function test_a_permission_can_belong_to_a_user_through_a_role()
    {
        $permission = Permission::factory()->create();
        $role = Role::factory()->create();
        $user = User::factory()->create();

        $role->users()->sync($user);
        $permission->roles()->sync($role);

        $this->assertNotNull($permission->users);
        $this->assertCount(1, $permission->users);
    }

    public function test_a_permission_can_belong_to_multiple_users_through_a_role()
    {
        $permission = Permission::factory()->create();
        $role = Role::factory()->create();
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $role->users()->sync([$user1->id, $user2->id]);
        $permission->roles()->sync($role);

        $this->assertNotNull($permission->users);
        $this->assertCount(2, $permission->users);
    }


    public function test_a_user_can_have_a_permission_through_a_role()
    {
        $role = Role::factory()->create();
        $user = User::factory()->create();
        $permission = Permission::factory()->create();

        $role->users()->sync($user);
        $role->permissions()->sync($permission);

        $this->assertNotNull($user->permissions);
        $this->assertCount(1, $user->permissions);
    }

    public function test_a_user_can_have_multiple_permissions_through_a_role()
    {
        $role = Role::factory()->create();
        $user = User::factory()->create();
        $permission1 = Permission::factory()->create();
        $permission2 = Permission::factory()->create();

        $role->users()->sync($user);
        $role->permissions()->sync([$permission1->id, $permission2->id]);

        $this->assertNotNull($user->permissions);
        $this->assertCount(2, $user->permissions);
    }

}
