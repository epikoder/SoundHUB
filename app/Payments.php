<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $fillable = [
        'reference', 'plan_name', 'expires_at'
    ];

    protected $table = 'payments';
}
