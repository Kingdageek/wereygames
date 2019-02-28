<?php

namespace App\Http\Middleware;

use Closure;

class Unlocked
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
        $guest = session()->get('guest');
        if (!$guest->has_unlocked) {
            return redirect()->route('story.unlock');
        }
        return $next($request);
    }
}
