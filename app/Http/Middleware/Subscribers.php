<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Subscribers
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
        $user = $request->user();
        Session::put('user', json_decode($request->user()->toJson()));
        if (!$user->artists) {
            return redirect()->route('signup/reg');
        }
        if ($user->artists->active != 1 || $user->active != 1) {
            return response('suspended');//redirect()->route('support/suspended');
        }
        if ($user->artists->name == null) {
            return redirect()->route('setup');
        }
        return $next($request);
    }
}
