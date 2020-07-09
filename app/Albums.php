<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    protected $fillable = [
        'name', 'genre', 'year'
    ];

    public function tracks ()
    {
        return $this->morphMany(Tracks::class, 'trackable');
    }
}
