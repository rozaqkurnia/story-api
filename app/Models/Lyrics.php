<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\HasFeaturedImage;
use Laravel\Scout\Searchable;

class Lyrics extends Model
{
    use HasFactory, HasFeaturedImage, Searchable;

    protected $fillable = [
        'title', 'slug', 'song', 'aka', 'album', 'year',
        'featured_image_path','short_description', 
        'language_id', 'country_id', 'collaboration', 'featuring',
        'romaji', 'original', 'en_translation', 'id_translation',
        'user_id'
    ];

    public $casts = [
        'year' => 'integer',
        'collaboration' => 'boolean',
        'featuring' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'lyrics_artist')->withPivot('role')->withTimestamps();
    }

    public function performers()
    {
        return $this->belongsToMany(Artist::class, 'lyrics_artist')->wherePivot('role', 'performer')->withPivot('role')->withTimestamps();
    }

    public function composers()
    {
        return $this->belongsToMany(Artist::class, 'lyrics_artist')->wherePivot('role', 'composer')->withPivot('role')->withTimestamps();
    }

    public function lyricists()
    {
        return $this->belongsToMany(Artist::class, 'lyrics_artist')->wherePivot('role', 'lyricist')->withPivot('role')->withTimestamps();
    }

    public function arrangers()
    {
        return $this->belongsToMany(Artist::class, 'lyrics_artist')->wherePivot('role', 'arranger')->withPivot('role')->withTimestamps();
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'lyrics_genre')->withTimestamps();
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function meta()
    {
        return $this->morphOne(Meta::class, 'post');
    }

    public function replies()
    {
        return $this->morphMany(Reply::class, 'resource');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'resource');
    }

    /**
     * Mutators
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        if ($this->slug == null) {
            $this->slug = $value;
        }
    }
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }


    /**
     * Accessors
     */
    public function getPerformerAttribute()
    {
        if ($this->collaboration) {
            return $this->performers->implode('name', ' x');
        }

        if ($this->featuring) {
            return $this->performers->implode('name', ' feat.');
        }

        return $this->performers->implode('name', ', ');
    }

    public function getComposerAttribute()
    {
        return $this->composers->implode('name', ', ');
    }

    public function getLyricistAttribute()
    {
        return $this->lyricists->implode('name', ', ');
    }

    public function getArrangerAttribute()
    {
        return $this->arrangers->where('role', 'arranger')->implode('name', ', ');
    }

    public function getGenreAttribute()
    {
        return $this->genres->implode('name', ', ');
    }

    /**
     * Event
     */
    protected static function booted()
    {
        static::creating(function ($lyrics) {
            if ($lyrics['slug'] == null) {
                $lyrics['slug'] = Str::slug($lyrics['title']);
            }
        });
        static::updating(function ($lyrics) {
            if ($lyrics['slug'] == null) {
                $lyrics['slug'] = Str::slug($lyrics['title']);
            }
        });
        static::saving(function ($lyrics) {
            if ($lyrics['slug'] == null) {
                $lyrics['slug'] = Str::slug($lyrics['title']);
            }
        });
    }
}
