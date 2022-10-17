<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\Admin;

class CheckRoleOrPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$roleOrPermission)
    {
        $slug = Auth::guard('admin')->user()->id;
        if(Auth::guard('admin')->user()->parent_id>0){
            $admin = Admin::find(Auth::guard('admin')->user()->parent_id);
            $slug = $admin->id;
        }
        $roleOrPermission = $slug .'_'.$roleOrPermission;
        
        // if (Auth::guest()) {
        //     throw UnauthorizedException::notLoggedIn();
        // }

        $rolesOrPermissions = is_array($roleOrPermission) ? $roleOrPermission : explode('|', $roleOrPermission);
        if (! Auth::guard('admin')->user()->hasAnyRole($rolesOrPermissions) && ! Auth::guard('admin')->user()->hasAnyPermission($rolesOrPermissions)) {
            throw UnauthorizedException::forRolesOrPermissions($rolesOrPermissions);
        }
        return $next($request);
    }
}
