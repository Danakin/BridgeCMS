<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_itemable_id',
        'menu_itemable_type',
        'menu_item_id',
        'title',
        'description',
    ];

    public function menu_itemable()
    {
        return $this->morphTo();
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_menu_item');
    }

    public function menu_items()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function scopeTopLevelItems($query)
    {
        return $query->whereNull('menu_item_id')->get();
    }

    public function scopeChildItems($query, $id)
    {
        return $query->where('menu_item_id', $id)->get();
    }
}
