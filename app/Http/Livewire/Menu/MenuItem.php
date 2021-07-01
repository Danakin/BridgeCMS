<?php

namespace App\Http\Livewire\Menu;

use Illuminate\Validation\ValidationException;
use Livewire\Component;
use App\Models\MenuItem as MenuItemModel;

class MenuItem extends Component
{
    public $itemId;
    public $order;
    public $title;
    public $route;
    public $item;

    protected $rules = [
        'title' => ['required'],
    ];

    public function mount($itemId, $item)
    {
        $this->itemId = $itemId;
        $this->item = $item;
        $this->order = $item['order'];
        $this->title = $item['title'];
        $this->route = $item['route'];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save($id)
    {
        if($id !== $this->itemId) {
            $this->addError('title', 'Illegal operation.');
            return;
        }
        $this->validate();
        $updatedItem = MenuItemModel::whereId($id)->update(['title' => $this->title]);
        if($updatedItem > 0) {
            session()->flash('message', 'MenuItem successfully updated.');
            $this->dispatchBrowserEvent('saved');
        }
    }

    public function render()
    {
        return view('livewire.menu.menu-item');
    }
}
