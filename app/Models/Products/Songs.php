<?php

namespace App\Models\Products;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Songs extends Model
{
    protected $table = 'songs';

    protected $filllable = [
        'title', 'artist'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function albums ()
    {
        return $this->belongsToMany(Albums::class);
    }
}
