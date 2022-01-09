<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\AsStringable;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_draft' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'excerpt' => AsStringable::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->morphMany(Tag::class, 'taggables');
    }

    public function meta()
    {
        return $this->morphOne(Meta::class, 'resource');
    }

    public function feelings()
    {
        return $this->morphMany(Feeling::class, 'resource');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'resource');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'resource');
    }
}
