<?php

namespace App\Http\Middleware;

use App\Models\Signup;
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
        $signup = Signup::find($request->id);
        if (!$signup) {
            return redirect()->route('signup/reg');
        }
        if ($signup->token != $request->token) {
            return redirect()->route('signup/reg');
        }
        return $next($request);
    }
}
