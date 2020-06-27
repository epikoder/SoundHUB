<?php

namespace App\Models\Products;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    public function users ()
    {
        return $this->belongsTo(User::class);
    }
    
    public function songs ()
    {
        return $this->belongsToMany(Songs::class);
    }
}
