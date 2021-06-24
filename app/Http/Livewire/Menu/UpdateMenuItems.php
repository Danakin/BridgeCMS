<?php

namespace App\Http\Livewire\Menu;

use Livewire\Component;

class UpdateMenuItems extends Component
{
    public $menuItems = [];

    public function mount($menuItems)
    {
        $this->menuItems = $menuItems;
    }

    public function render()
    {
        return view('livewire.menu.update-menu-items');
    }
}
