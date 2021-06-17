<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::first();
        if (!$menu) {
            return;
        }

        $pages = Page::with('posts')->get();

        foreach ($pages as $page) {
            $menuItem = $page->menu_items()->create(
                MenuItem::factory()->make(
                    [
                        'title' => $page->title,
                    ]
                )->toArray()
            );
            $menu->menu_items()->attach($menuItem);

            if ($page->posts->count()) {
                $post = $page->posts->random();


                $menuItem = $post->menu_items()->create(
                    MenuItem::factory()->make(
                        [
                            'title' => $post->title,
                            'menu_item_id' => $menuItem->id,
                        ]
                    )->toArray()
                );
                $menu->menu_items()->attach($menuItem);
            }
        }
    }
}
