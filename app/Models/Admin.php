<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    protected $fillable = [
        'uuid'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
