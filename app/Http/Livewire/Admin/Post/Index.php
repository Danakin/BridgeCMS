<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Page;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $parent;

    public function mount(Page $parent)
    {
        $this->parent = $parent;
    }

    public function render()
    {
        return view('livewire.admin.post.index', ['posts' => Post::with('user')->where('page_id', $this->parent->id)->orderBy('updated_at', 'desc')->paginate(10)]);
    }
}
