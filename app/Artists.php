<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artists extends Model
{
    protected $fillable = [
        'name', 'background_url', 'social'
    ];

    public function users ()
    {
        return $this->belongsToMany(User::class);
    }
}
