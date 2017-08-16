<?php

namespace App\Http\Middleware;

use Closure;

class SMPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $iPermissionType, $iPermissionCode)
    {
        if (\Auth::user()->user_type_id == \Config::get('constants.TP_USER.ADMIN'))
        {
            return $next($request);
        }

        foreach (\Auth::user()->userPermission as $oUserPermission)
        {
          if ($oUserPermission->permission->type_permission_id == $iPermissionType)
            if ($oUserPermission->permission->code == $iPermissionCode)
            {
                return $next($request);
            }
        }

        return response('Unauthorized.', 401);
    }
}
