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
        Page::factory()->create(['title' => 'home', 'slug' => Str::slug('home'), 'user_id' => 1, 'can_have_posts' => FALSE]);
        Page::factory()->create(['title' => 'contact', 'slug' => Str::slug('contact'), 'user_id' => 1, 'can_have_posts' => FALSE]);
        Page::factory()->create(['title' => 'about us', 'slug' => Str::slug('about us'), 'user_id' => 1, 'can_have_posts' => FALSE]);
        Page::factory()->create(['title' => 'blog', 'slug' => Str::slug('blog'), 'user_id' => 1, 'can_have_posts' => TRUE]);
        Page::factory()->create(['title' => 'tutorials', 'slug' => Str::slug('tutorials'), 'user_id' => 1, 'can_have_posts' => TRUE]);
    }
}
