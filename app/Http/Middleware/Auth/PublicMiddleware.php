<?php

namespace App\Http\Middleware\Auth;

use Closure;

class PublicMiddleware
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
        if (auth()->check() && auth()->user()->role == 0)
            return $next($request);
        else
            return redirect()->route("login");
    }
}
