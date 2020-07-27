<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artists extends Model
{
    protected $fillable = [
        'name', 'sex', 'avatar_url', 'bio', 'social'
    ];

    public function users ()
    {
        return $this->belongsTo(User::class);
    }

    public function tracks ()
    {
        return $this->morphMany(Tracks::class, 'trackable');
    }
}