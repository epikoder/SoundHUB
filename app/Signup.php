<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{
    protected $fillable = [
        'name', 'email', 'token'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
