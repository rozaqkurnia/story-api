<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\AsStringable;;

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

    public function performings()
    {
        return $this->belongsToMany(Song::class, 'song_artist')
            ->wherePivot('as', 'performer')
            ->withTimestamps();
    }
}
