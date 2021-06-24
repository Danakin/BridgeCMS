<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menu\MenuStoreRequest;
use App\Http\Requests\Menu\MenuUpdateRequest;
use App\Http\Utilities\MenuUtility;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index()
    {
        return view('admin.menus.index', ['menus' => Menu::orderBy('title')->get()]);
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(MenuStoreRequest $request)
    {
        $menu = Menu::create($request->validated());

        return redirect()->route('admin.menus.index')->with('success', "Menu {$menu->title} has been created.");
    }

    public function edit(Menu $menu)
    {
        $menu->load(
            [
                'menu_items' => function ($query ) {
                    $query->withCount('menu_items');
                },
                'menu_items.menu_itemable' => function (MorphTo $morphTo) {
                    $morphTo->morphWith([Post::class => ['page']]);
                },
            ]
        );
        $menuItems = MenuUtility::buildMenu($menu->menu_items, null);

//        dd($menuItems);
        return view('admin.menus.edit', compact('menu', 'menuItems'));
    }

    public function update(MenuUpdateRequest $request, Menu $menu)
    {
        $menu->update($request->validated());

        return redirect()->route('admin.menus.index')->with('success', "Menu {$menu->title} has been updated.");
    }

    public function destroy(Menu $menu)
    {
        $menuDeleted = $menu->delete();
        if (!$menuDeleted) {
            return response()->json(['success' => false], 300);
        }

        Session::flash('success', 'Menu ' . $menu->title . ' has been deleted.');
        return response()->json(['success' => true], 200);
    }
}
