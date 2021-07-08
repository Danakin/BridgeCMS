<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public $title;
    public $slug;
    public $canHavePosts = FALSE;
    public $description;
    public $content;

    public function resetPage()
    {
        $this->title = '';
        $this->slug = '';
        $this->canHavePosts = FALSE;
        $this->description = '';
        $this->content = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function updatedSlug($value)
    {
        $this->title = ucwords(Str::replace('-', ' ', $value));
    }

    public function submit()
    {
        $this->validate();
        $page = Page::create(
            [
                'title' => $this->title,
                'slug' => $this->slug,
                'can_have_posts' => $this->canHavePosts ? TRUE : FALSE,
                'description' => $this->description,
                'content' => $this->content,
            ]
        );

        if($page) {
            session()->flash('success', 'Page was created.');
            return redirect()->route('admin.pages.show', $page);
        }
    }

    public function render()
    {
        return view('livewire.admin.page.create');
    }

    protected function rules()
    {
        return [
            'title' => ['required', 'unique:pages,title'],
            'slug' => ['required', 'unique:pages,slug'],
            'canHavePosts' => ['boolean'],
            'description' => ['required'],
            'content' => ['nullable', 'string'],
        ];
    }
}
