<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    // public function handle($request, Closure $next, ...$guards)
    // {
    //     $this->authenticate($request, ['web']);
    //     if(! Auth::check() && $request->route()->named('logout')) {
    //         auth()->logout();
    //     }

    //     return parent::handle($request, $next);
    // }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
