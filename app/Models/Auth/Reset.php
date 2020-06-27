<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Reset extends Model
{
    /**
     * Fillable
     *
     * @var $fillable
     */
    protected $fillable = [
        'key', 'expires_at'
    ];

    /**
     * Hidden
     * @var $hidden
     */
    protected $hidden = [
        'created_at', 'deleted_at'
    ];

    /**
     * Relation to User
     *
     * @return App\User
     */
    public function users ()
    {
        return $this->belongsTo(App\User::class);
    }
}
