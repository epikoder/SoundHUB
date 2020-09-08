<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tracks extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'genre', 'artist', 'album_id', 'admin',
        'url', 'duration', 'art', 'art_url', 'trackable_id', 'trackable_type'
    ];

    protected $hidden = [
        'admin', 'trackable_id', 'trackable_type'
    ];

    public function trackable()
    {
        return $this->morphTo();
    }
}
