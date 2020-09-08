<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name'
    ];
    

    protected $hidden = [
        'name'
    ];

    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
