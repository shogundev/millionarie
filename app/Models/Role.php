<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['title', 'description'];

    public function users() {
        return $this->belongsToMany('App\User', 'user_role');
    }
}
