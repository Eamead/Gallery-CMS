<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'type', 'user_id', 'title', 'description', 'file_path', 'upload_date',
        'estimated_date', 'estimated_location', 'privacy_setting', 'gallery_id',
        'is_featured', 'additional_info', 'copyright_info', 'url'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'resource_categories');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'resource_tags');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
