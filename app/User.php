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

    protected $table = 'users';

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Roles::class);
    }

    public function plans()
    {
        return $this->belongsToMany(\App\Models\Plans::class, 'payments')
            ->withPivot('reference','response', 'expires_at')
            ->withTimestamps();
    }

    public function artists()
    {
        return $this->hasOne(\App\Models\Artists::class);
    }

    public function eliteArtists()
    {
        return $this->hasOne(\App\Models\EliteArtists::class);
    }

    public function admins()
    {
        return $this->hasOne(\App\Models\Admin::class);
    }

    /// Library
    public function playlists ()
    {
        return $this->hasMany(\App\Models\Tracks::class);
    }
    public function favourites ()
    {
        return $this->hasMany(\App\Models\Favourites::class);
    }
}
