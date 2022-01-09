<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Casts\AsStringable;

class Artist extends Model
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

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'artist_country')
            ->withTimestamps();
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'song_artist')
            ->withPivot('as')
            ->withTimestamps();
    }
}
