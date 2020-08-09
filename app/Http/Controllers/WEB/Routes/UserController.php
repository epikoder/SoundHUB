<?php

namespace App\Http\Controllers\WEB\Routes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request, $name)
    {
        $user = $request->user();
        if (!$user) {
            return view('login');
        }

        return view('user', [
            'user' => $user,
            'artist' => $user->artists
        ]);
    }
}
