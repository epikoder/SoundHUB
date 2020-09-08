<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Albums extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'artist', 'art', 'art_url', 'genre', 'track_num'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function tracks()
    {
        return $this->morphMany(Tracks::class, 'trackable');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
