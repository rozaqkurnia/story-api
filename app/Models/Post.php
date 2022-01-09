<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
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
     * Event
     */
    protected static function booted()
    {
        static::creating(function ($post) {
            if ($post['slug'] == null) {
                $post['slug'] = Str::slug($post['name']);
            }
        });
        static::updating(function ($post) {
            if ($post['slug'] == null) {
                $post['slug'] = Str::slug($post['name']);
            }
        });
        static::saving(function ($post) {
            if ($post['slug'] == null) {
                $post['slug'] = Str::slug($post['name']);
            }
        });
    }
}
