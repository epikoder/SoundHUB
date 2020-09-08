<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    protected $hidden = [
        'password', 'email_verified_at', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    public function roles()
    {
        return $this->belongsToMany(Models\Roles::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Models\Plans::class, 'payments')
            ->withPivot('reference','response', 'expires_at')
            ->withTimestamps();
    }

    public function artists()
    {
        return $this->hasOne(Models\Artists::class);
    }

    public function tracks()
    {
        return $this->morphMany(Models\Tracks::class, 'trackable');
    }

    public function albums()
    {
        return $this->hasMany(Models\Albums::class);
    }

    public function admins()
    {
        return $this->hasOne(Models\Admin::class);
    }
}
