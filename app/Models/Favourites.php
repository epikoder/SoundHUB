<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{
    public function users ()
    {
        $this->belongsTo(\App\User::class);
    }
}
