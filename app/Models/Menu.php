<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function getShortDescriptionAttribute()
    {
        return Str::limit($this->description, 150, " (...)");
    }

    public function menu_items()
    {
        return $this->belongsToMany(MenuItem::class, 'menu_menu_item');
    }

    public function topLevelMenuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'menu_menu_item')->whereNull('menu_items.menu_item_id');
    }
}
