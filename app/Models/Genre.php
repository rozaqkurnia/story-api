<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Genre extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'slug',
    ];
    protected $hidden = [
        'pivot',
    ];

    public function lyrics()
    {
        return $this->belongsToMany(Lyrics::class)->withTimestamps();
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
        static::creating(function ($genre) {
            if ($genre['slug'] == null) {
                $genre['slug'] = Str::slug($genre['name']);
            }
        });
        static::updating(function ($genre) {
            if ($genre['slug'] == null) {
                $genre['slug'] = Str::slug($genre['name']);
            }
        });
        static::saving(function ($genre) {
            if ($genre['slug'] == null) {
                $genre['slug'] = Str::slug($genre['name']);
            }
        });
    }
}
