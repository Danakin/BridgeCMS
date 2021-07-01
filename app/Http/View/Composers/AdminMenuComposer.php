<?php

namespace App\Http\View\Composers;

use App\Models\Page;
use Illuminate\View\View;

class AdminMenuComposer // TODO: MAKE MENU DYNAMIC
{
//    protected $userCount;
    private $pages;

    public function __construct()
    {
        $this->pages = Page::all();
    }

    public function compose(View $view)
    {
        $view->with('pages', $this->pages);
    }
}
