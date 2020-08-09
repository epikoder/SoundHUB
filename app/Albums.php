<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    protected $fillable = [
        'title', 'artist', 'genre', 'track_num'
    ];

    public function tracks ()
    {
        return $this->morphMany(Tracks::class, 'trackable');
    }

    public function users () {
        return $this->belongsTo(User::class);
    }
}
