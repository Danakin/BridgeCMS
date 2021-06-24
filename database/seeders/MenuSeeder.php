<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::factory()->create(['title' => 'Primary']);
        Menu::factory()->create(['title' => 'Secondary']);
        Menu::factory()->create(['title' => 'Tertiary']);
    }
}
