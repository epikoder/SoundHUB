<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'avatar_url'
    ];

    protected $hidden = [
        'password', 'email_verified_at', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    public function roles ()
    {
        return $this->belongsToMany(Roles::class);
    }

    public function plans ()
    {
        return $this->belongsToMany(Plans::class, 'payments')
                    ->withPivot('reference', 'expires_at')
                    ->withTimestamps();
    }

    public function artists ()
    {
        return $this->hasOne(Artists::class);
    }

    public function tracks()
    {
        return $this->morphMany(Tracks::class, 'trackable');
    }

    public function albums () {
        return $this->hasMany(Albums::class);
    }

    public function admins ()
    {
        return $this->hasOne(Admin::class);
    }

}
