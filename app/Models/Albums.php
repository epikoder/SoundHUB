<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Albums extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'artist', 'admin',
        'slug', 'art', 'art_url', 'genre', 'track_num','type'
    ];
    protected $hidden = [
        'admin', 'owner_id', 'owner_type', 'id', 'created_at', 'deleted_at',
    ];

    protected $table = 'albums';

    public function tracks()
    {
        return $this->morphMany(Tracks::class, 'owner');
    }

    public function owner()
    {
        return $this->morphTo();
    }
}
