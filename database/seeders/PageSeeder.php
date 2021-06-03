<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::factory()->create(['title' => '', 'user_id' => 1]);
        Page::factory()->create(['title' => 'blog', 'slug' => Str::slug('blog'), 'user_id' => 1]);
    }
}
