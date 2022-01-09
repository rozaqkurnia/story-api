<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resource()
    {
        return $this->morphTo();
    }

    public function likes()
    {
        return $this->morphMany(Like::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
