<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['name', 'description'];

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }
}
