<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = Page::where('can_have_posts', TRUE)->get();
        $users = User::all();
        for ($i = 0; $i < 1000; $i++) {
            Post::factory()->create(
                [
                    "user_id" => $users->random()->id,
                    "page_id" => $pages->random()->id,
                ]
            );
        }
    }
}
