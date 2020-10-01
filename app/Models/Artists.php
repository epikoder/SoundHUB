<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artists extends Model
{
    protected $fillable = [
        'name', 'avatar', 'social'
    ];

    public function users()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function tracks()
    {
        return $this->morphMany(Tracks::class, 'owner');
    }

    public function albums()
    {
        return $this->morphMany(Albums::class, 'owner');
    }
}
