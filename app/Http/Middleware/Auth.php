<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guest()) {

            // abort(401, 'login');
            throw new AuthenticationException();
        }

        return $next($request);
    }
}
