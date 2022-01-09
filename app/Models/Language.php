<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Language extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'slug',
    ];

    public function lyrics()
    {
        return $this->hasMany(Lyrics::class);
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
        static::creating(function ($language) {
            if ($language['slug'] == null) {
                $language['slug'] = Str::slug($language['name']);
            }
        });
        static::updating(function ($language) {
            if ($language['slug'] == null) {
                $language['slug'] = Str::slug($language['name']);
            }
        });
        static::saving(function ($language) {
            if ($language['slug'] == null) {
                $language['slug'] = Str::slug($language['name']);
            }
        });
    }
}
