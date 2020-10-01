<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tracks extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'genre', 'artist', 'admin', 'slug',
        'url', 'duration', 'art', 'art_url', 'type'
    ];

    protected $hidden = [
        'admin', 'owner_id', 'owner_type', 'id', 'created_at', 'deleted_at',
    ];

    public function owner()
    {
        return $this->morphTo();
    }

    public function playcount()
    {
        return $this->hasOne(PlayCount::class, 'slug', 'slug');
    }
}
