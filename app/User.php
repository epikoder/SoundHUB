<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The table to use
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Relation to Models\Auth\Roles
     *
     * @return Models\Auth\Roles
     */
    public function roles ()
    {
        return $this->belongsToMany(Models\Auth\Roles::class);
    }

    /**
     * Relation to odels\Auth\Reset
     *
     * @return Models\Auth\Reset
     */
    public function resets ()
    {
        return $this->hasMany(Models\Auth\Reset::class);
    }

    public function plans ()
    {
        return $this->belongsToMany(Models\Service\Plans::class);
    }

    public function songs ()
    {
        return $this->hasMany(Models\Products\Songs::class);
    }

    public function albums()
    {
        return $this->hasMany(Models\Products\Albums::class);
    }
}
