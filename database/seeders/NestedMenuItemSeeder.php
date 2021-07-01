<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\NestedMenuItem;
use App\Models\Page;
use Illuminate\Database\Seeder;

class NestedMenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $primaryMenu = Menu::where('title', '=', 'primary')->first();
        $pages = Page::all();
        if ($primaryMenu) {
            foreach ($pages as $i => $page) {
                if (!$page->can_have_posts) {
                    NestedMenuItem::create(
                        [
                            'menu_id' => $primaryMenu->id,
                            'title' => $page->title,
                            'url' => route('pages.show', $page),
                            'lft' => $i * 2 + 1,
                            'rgt' => $i * 2 + 2,
                        ]
                    );
                }
            }
        }
    }
}
