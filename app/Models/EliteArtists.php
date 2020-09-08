<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EliteArtists extends Model
{
    protected $table = 'elite_artist';

    protected $fillable = [
        'name', 'avatar', 'social'
    ];
}