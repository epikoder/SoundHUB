<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cookie = $request->cookie();
        $user = $request->user();
        if (isset($cookie['X-ADMIN']) && $user)
        {
            foreach ($user->roles as $role) {
                if ($role->id == 3) {
                    $roles['admin'] = true;
                }
                if ($role->id == 4) {
                    $roles['root'] = true;
                }
            }
            $request->roles = $roles;
            if ($cookie['X-ADMIN'] == $user->admins->uuid) {
                return $next($request);
            }
        }
        return redirect()->route('login/admin');
    }
}
