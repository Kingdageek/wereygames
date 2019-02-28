<?php

namespace App\Http\Middleware;

use Closure;

class GuestUser
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('guest')) {
            return redirect()->route('front.index');
        }

        return $next($request);
    }
}
