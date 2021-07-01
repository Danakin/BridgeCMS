<?php

namespace App\Http\Livewire\Menu;

use Livewire\Component;

class Menu extends Component
{
    public $menuItems;

    public function mount($menuItems)
    {
        $this->menuItems = $menuItems;
    }

    public function render()
    {
        return view('livewire.menu.menu');
    }
}
