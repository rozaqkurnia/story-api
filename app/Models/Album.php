<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Casts\AsStringable;

class Album extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_draft' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'excerpt' => AsStringable::class,
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot',
        'user_id',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
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
