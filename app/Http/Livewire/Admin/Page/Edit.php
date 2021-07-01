<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Page;
use Illuminate\Support\Str;
use Livewire\Component;

class Edit extends Component
{
    public $page;
    public $title;
    public $slug;
    public $canHavePosts;
    public $description;
    public $content;

    public function mount(Page $page)
    {
        $this->page = $page;
        $this->title = $page->title;
        $this->slug = $page->slug;
        $this->canHavePosts = $page->can_have_posts;
        $this->description = $page->description;
        $this->content = $page->content;
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

    public function render()
    {
        return view('livewire.admin.page.edit');
    }

    public function resetPage()
    {
        $this->title = $this->page->title;
        $this->slug = $this->page->slug;
        $this->canHavePosts = $this->page->can_have_posts;
        $this->description = $this->page->description;
        $this->content = $this->page->content;
    }

    public function submit()
    {
        $this->validate();
        $updateSuccessful = Page::where('id', $this->page->id)->update([
                "title" => $this->title,
                "slug" => $this->slug,
                "can_have_posts" => $this->canHavePosts,
                "description" => $this->description,
                "content" => $this->content,
            ]
        );
        if($updateSuccessful) {
            session()->flash('success', 'Page ' . $this->title . ' has been updated successfully.');
            if($this->slug !== $this->page->slug) {
                return redirect()->route('admin.pages.show', $this->slug);
            }
        }
    }

    protected function rules()
    {
        return [
            'title' => ['required', 'unique:pages,title,' . $this->page->id],
            'slug' => ['required', 'unique:pages,slug,' . $this->page->id],
            'canHavePosts' => ['boolean'],
            'description' => ['required'],
            'content' => ['nullable', 'string'],
        ];
    }
}
