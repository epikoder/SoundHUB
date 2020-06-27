<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    /**
     * @var $fillable
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Disable timestamps
     *
     * @var $timestamps
     */
    public $timestamps = false;

    /**
     * Relation to App\User
     *
     * @return App\User
     */
    public function users ()
    {
        return $this->belongsToMany(User::class);
    }
}
