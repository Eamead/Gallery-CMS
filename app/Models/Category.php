<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'resource_categories');
    }
}
