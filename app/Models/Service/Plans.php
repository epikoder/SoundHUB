<?php

namespace App\Models\Service;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    public function belongsToMany()
    {
        return $this->belongsToMany(User::class);
    }
}
