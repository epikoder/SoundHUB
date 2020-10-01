<?php

namespace App\Http\Controllers\ADMIN\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserManager extends Controller
{
    public function __construct()
    {
        $this->middleware('root');
    }

    public function create ()
    {
        return response('worked');
    }
}
