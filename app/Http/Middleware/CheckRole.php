<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // if (Auth::guest()) {
        //     throw UnauthorizedException::notLoggedIn();
        // }
        $role = Auth::guard('admin')->user()->id.'_'.$role;
        $roles = is_array($role)
            ? $role
            : explode('|', $role);

        if (! Auth::guard('admin')->user()->hasAnyRole($roles)) {
            throw UnauthorizedException::forRoles($roles);
        }
        return $next($request);
    }
}
