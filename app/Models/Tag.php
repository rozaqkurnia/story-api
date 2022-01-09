<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
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
        static::creating(function ($tag) {
            if ($tag['slug'] == null) {
                $tag['slug'] = Str::slug($tag['name']);
            }
        });
        static::updating(function ($tag) {
            if ($tag['slug'] == null) {
                $tag['slug'] = Str::slug($tag['name']);
            }
        });
        static::saving(function ($tag) {
            if ($tag['slug'] == null) {
                $tag['slug'] = Str::slug($tag['name']);
            }
        });
    }
}
