<?php
namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait Adminer
{
    protected $roles = array();

    /**
     * Auth and get the user roles
     *
     * @return mixed|bool
     */
    public function auth (Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)) {
            return false;
        }
        $user = $request->user();
        if (!$user) {
            return false;
        }
        $roles = [
            'admin' => false, 'root' => false
        ];
        foreach ($user->roles as $role) {
            if ($role->id == 3) {
                $roles['admin'] = true;
            }
            if ($role->id == 4) {
                $roles['root'] = true;
            }
        }
        return $roles;
    }
}
