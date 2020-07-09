<?php

namespace App\Http\Middleware;

use App\Signup;
use Closure;

class Regs
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
        $request->email = strtolower($request->email);
        $signup = Signup::find($request->id);
        if (!$signup) {
            return response()->json([], 400);
        }
        if ($signup->token != $request->token) {
            return response()->json([], 400);
        }
        return $next($request);
    }
}
