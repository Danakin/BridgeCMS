<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Post;
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

        $pageOrder = 0;
        foreach ($pages as $page) {
            ++$pageOrder;
            $menuItem = $page->menu_items()->create(
                MenuItem::factory()->make(
                    [
                        'title' => $page->title,
                        'order' => $pageOrder,
                    ]
                )->toArray()
            );
            $menu->menu_items()->attach($menuItem);

            if ($page->posts->count()) {
                $posts = $page->posts->random(rand(1, 5));
                $menuItemId = MenuItem::where('menu_itemable_id', $page->id)->where('menu_itemable_type', \App\Models\Page::class)->first()->id;

                $postOrder = 0;
                $menuItems = [];
                foreach ($posts as $post) {
                    ++$postOrder;
                    $menuItem = $post->menu_items()->create(
                        MenuItem::factory()->make(
                            [
                                'title' => $post->title,
                                'menu_item_id' => $menuItemId,
                                'order' => $postOrder,
                            ]
                        )->toArray()
                    );
                    $menuItems[] = $menuItem->id;
                }
                $menu->menu_items()->attach($menuItems);
            }
        }
    }
}
