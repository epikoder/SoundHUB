<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracks extends Model
{
    protected $fillable = [
        'title', 'genre', 'artist', 'album','admin','url', 'trackable_id', 'trackable_type'
    ];

    protected $hidden = [
        'admin', 'trackable_id', 'trackable_type'
    ];

    public function trackable ()
    {
        return $this->morphTo();
    }
}
