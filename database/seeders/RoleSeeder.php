<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();

        $superAdminRole = Role::factory()->create(['title' => 'super_admin']);
        $adminRole = Role::factory()->create(['title' => 'admin']);
        $creatorRole = Role::factory()->create(['title' => 'creator']);
        $authorRole = Role::factory()->create(['title' => 'author']);

        $superAdminRole->permissions()->sync($permissions->pluck('id')->toArray());
        $adminRole
            ->permissions()
            ->sync(
                $permissions
                    ->filter(
                        function ($permission) {
                            if (str_contains($permission->title, '-page-')) {
                                return true;
                            }
                            if (!str_contains($permission->title, '-page-') && !str_ends_with(
                                    $permission->title,
                                    'admin'
                                )) {
                                return true;
                            }
                            return false;
                        }
                    )
                    ->pluck('id')
                    ->toArray()
            );
        $creatorRole
            ->permissions()
            ->sync(
                $permissions
                    ->filter(
                        function ($permission) {
                            return str_contains($permission->title, '-page-');
                        }
                    )
                    ->pluck('id')
                    ->toArray()
            );
        $authorRole
            ->permissions()
            ->sync(
                $permissions
                    ->filter(
                        function ($permission) {
                            return str_ends_with($permission->title, '-page-blog');
                        }
                    )
                    ->pluck('id')
                    ->toArray()
            );

        $superUser = User::find(1);
        $superAdminRole->users()->sync($superUser);

        $regularUsers = User::where('id', '>', 1)->get();
        $possibleRoles = Role::where('id', '>', 1)->get();

        foreach ($regularUsers as $user) {
            $user->roles()->sync($possibleRoles->random());
        }
    }
}
