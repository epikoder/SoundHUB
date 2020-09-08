<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = [
        'reference', 'response', 'expires_at'
    ];

    protected $table = 'payments';
}
