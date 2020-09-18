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
            if ($cookie['X-ADMIN'] == $user->admins->uuid) {
                return $next($request);
            }
        }
        return redirect()->route('login/admin');
    }
}
