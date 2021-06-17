<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'page_id',
        'title',
        'slug',
        'description',
        'published_at',
        'published',
    ];

    protected $dates = [
        'published_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function getShortDescriptionAttribute()
    {
        return Str::limit($this->description, 250, ' <a href="' . route('pages.posts.show', [$this->page, $this]) . '">[... ' . __("Read More") . ']</a>');
    }

    public function menu_items()
    {
        return $this->morphMany(MenuItem::class, 'menu_itemable');
    }
}
