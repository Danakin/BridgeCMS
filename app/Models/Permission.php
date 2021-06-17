<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
//
//    public function users()
//    {
//        return $this->roles()->with('users');
//    }

    public function getUsersAttribute()
    {
        $users = new Collection();
        $roles = $this->roles->load('users');
        foreach ($roles as $role) {
            $users = $users->mergeRecursive($role->users);
        }
        return $users;
    }
}
