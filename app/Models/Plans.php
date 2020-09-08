<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $table = 'plans';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'payments')
            ->withPivot('reference','response', 'expires_at')
            ->withTimestamps();
    }
}
