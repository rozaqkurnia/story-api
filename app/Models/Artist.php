<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'short_description', 'description'
    ];

    protected $hidden = ['pivot'];

    /**
     * Relationship
     */
    public function countries()
    {
        return $this->belongsToMany(Country::class)->withTimestamps();
    }

    public function lyrics()
    {
        return $this->belongsToMany(Lyrics::class, 'lyrics_artist')->withPivot('role')->withTimestamps();
    }

    public function meta()
    {
        return $this->morphOne(Meta::class, 'post');
    }

    /**
     * Mutators
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        if ($this->slug == null) {
            $this->slug = $value;
        }
    }
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Event
     */
    protected static function booted()
    {
        static::creating(function ($artist) {
            if ($artist['slug'] == null) {
                $artist['slug'] = Str::slug($artist['name']);
            }
        });
        static::updating(function ($artist) {
            if ($artist['slug'] == null) {
                $artist['slug'] = Str::slug($artist['name']);
            }
        });
        static::saving(function ($artist) {
            if ($artist['slug'] == null) {
                $artist['slug'] = Str::slug($artist['name']);
            }
        });
    }
}
