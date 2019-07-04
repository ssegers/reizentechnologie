<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class organiser
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
       if (Auth::check() && (Auth::user()->role == 'organiser' || Auth::user()->role == 'admin')) {
            return $next($request);
        }
        return redirect(route("home"));

    }
}
