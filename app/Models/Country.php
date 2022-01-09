<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'slug',
    ];
    protected $hidden = ['pivot'];

    /**
     * Relationships
     */
    public function artists()
    {
        return $this->belongsToMany(Artist::class)->withTimestamps();
    }
    
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
        static::creating(function ($country) {
            if ($country['slug'] == null) {
                $country['slug'] = Str::slug($country['name']);
            }
        });
        static::updating(function ($country) {
            if ($country['slug'] == null) {
                $country['slug'] = Str::slug($country['name']);
            }
        });
        static::saving(function ($country) {
            if ($country['slug'] == null) {
                $country['slug'] = Str::slug($country['name']);
            }
        });
    }
}
