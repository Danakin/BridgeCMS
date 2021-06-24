<?php

namespace App\Http\Utilities;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class MenuUtility
{
    public static function buildMenu(Collection $items, $id = NULL)
    {
        if ($id === NULL) {
            $activeItems = $items->whereNull('menu_item_id');
        } else {
            $activeItems = $items->where('menu_item_id', $id);
        }

        $menuItems = [];
        foreach ($activeItems as $item) {
            $route = '#';
            $item->load('menu_items', 'menu_itemable');
            if( $item->menu_itemable_type === Page::class) {
                $route = route('pages.show', ['page' => $item->menu_itemable]);
            } elseif ($item->menu_itemable_type === Post::class) {
                $route = route('pages.posts.show', ['page' => $item->menu_itemable->page, 'post' => $item->menu_itemable]);
            }
            $menuItems[$item->id] = ['title' => $item->title, 'route' => $route];
            if(count($item->menu_items) > 0) {
                $menuItems[$item->id]['children'] = self::buildMenu($items, $item->id);
            }
        }
        return $menuItems;
    }
}
