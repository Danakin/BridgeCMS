<?php

namespace App\Http\View\Composers;

use App\Models\User;
use Illuminate\View\View;

class MenuComposer // TODO: MAKE MENU DYNAMIC
{
//    protected $userCount;

    public function __construct()
    {
//        $this->userCount = User::count();
    }

    public function compose(View $view)
    {
//        $view->with('userCount', $this->userCount);
    }
}
