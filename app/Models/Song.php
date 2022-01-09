<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\AsStringable;

class Song extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot',
        'user_id',
    ];

    protected $casts = [
        'is_draft' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'excerpt' => AsStringable::class,
        'number' => 'integer',
        'known_as' => AsStringable::class,
        'release_date' => 'date',
        'release_year' => 'integer',
        'disc_number' => 'integer',
        'is_collaboration' => 'boolean',
        'is_featuring' => 'boolean',
        'is_draft' => 'boolean',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'song_artist')
            ->withPivot('as')
            ->withTimestamps();
    }

    public function performers()
    {
        return $this->belongsToMany(Artist::class, 'song_artist')
            ->wherePivot('as', 'performer')
            ->withTimestamps();
    }

    public function composers()
    {
        return $this->belongsToMany(Artist::class, 'song_artist')
            ->wherePivot('as', 'composer')
            ->withTimestamps();
    }

    public function songwriters()
    {
        return $this->belongsToMany(Artist::class, 'song_artist')
            ->wherePivot('as', 'songwriter')
            ->withTimestamps();
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'song_language')
            ->withTimestamps();
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'song_genre')
            ->withTimestamps();
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
        return $this->moprhMany(Comment::class, 'resource');
    }
}
