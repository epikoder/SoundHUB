<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Admin extends Controller
{
    use Adminer;

    public function login(Request $request)
    {
        $roles = $this->auth($request);
        if (!$roles || !$roles['admin']) {
            Auth::logout();
            return view('Admin.login', [
                'errors' => true
            ]);
        }

        if ($roles['root']) {
            Cookie::queue('XS-ADMIN', $request->user()->admins->uuid, 1440);
        }
        Cookie::queue('X-ADMIN', $request->user()->admins->uuid, 1440);
        return redirect()->route('Admin/dashboard');
    }

    public function admin(Request $request)
    {

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return view('Admin.login');
    }

    public function password(Request $request)
    {

    }
}
