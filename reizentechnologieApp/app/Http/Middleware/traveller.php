<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class traveller
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
        if (Auth::check() && (Auth::user()->role == 'traveller' || Auth::user()->role == 'admin' || Auth::user()->role == 'guide')) {
            return $next($request);
        }
        return redirect(route("home"));
    }
}
