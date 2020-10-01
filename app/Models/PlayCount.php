<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayCount extends Model
{
    protected $table = 'play_count';
    protected $fillable = [
        'title', 'count'
    ];

    public function tracks ()
    {
        return $this->belongsTo(Tracks::class, 'slug', 'slug');
    }
}
