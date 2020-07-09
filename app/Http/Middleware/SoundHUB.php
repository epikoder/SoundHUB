<?php

namespace App\Http\Middleware;

use Closure;

class SoundHUB
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
        if (!$user->artist) {
            return response()->json([], 401);
        }
        if ($user->artist->active != 1) {
            return response()->json([], 401);
        }
        return $next($request);
    }
}
