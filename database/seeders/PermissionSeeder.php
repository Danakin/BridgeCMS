<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::factory()->create(['title' => 'create-admin']);
        Permission::factory()->create(['title' => 'update-admin']);
        Permission::factory()->create(['title' => 'delete-admin']);
        Permission::factory()->create(['title' => 'create-permission']);
        Permission::factory()->create(['title' => 'update-permission']);
        Permission::factory()->create(['title' => 'delete-permission']);
        Permission::factory()->create(['title' => 'create-page']);
        Permission::factory()->create(['title' => 'update-page']);
        Permission::factory()->create(['title' => 'delete-page']);
    }
}
