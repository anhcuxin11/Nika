<?php

namespace App\Http\Middleware\Company;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class CompanyAuthenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, ['company']);
        // $user = auth('company')->user();
        // if ((($user->is_admin_a || $user->is_admin_b) && $user->isForceLoggedOut()) || $user->company->isLoss()) {
        //     auth('company')->logout();
        // }
        if(! Auth::check('company') && $request->route()->named('company.logout')) {
            auth('company')->logout();
        }

        return parent::handle($request, $next);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('company.login');
        }
    }
}
