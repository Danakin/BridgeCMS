<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                UserSeeder::class,
                PermissionSeeder::class,
                PageSeeder::class,
                PostSeeder::class,
                RoleSeeder::class,
            ]
        );
    }
}
