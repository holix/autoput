<?php

namespace App\Http\Middleware;

use Closure;

class Mode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!$request->session()->has('mode') || !$request->session()->has('tollbooth_id')) {
            return redirect('/mode');
        }
        return $next($request);
    }
}
