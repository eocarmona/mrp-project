<?php

namespace App\Http\Middleware;

use Closure;

class SMModule {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $iModule)
    {
      if (\Auth::user()->user_type_id == \Config::get('constants.TP_USER.ADMIN'))
      {
          return $next($request);
      }
      else
      {
        foreach (\Auth::user()->userPermission as $oUserPermission)
        {
          if ($oUserPermission->permission->type_permission_id == \Config::get('constants.TP_PERMISSION.MODULE')) {
            if ($oUserPermission->permission_id == $iModule)
            {
                return $next($request);
            }
          }
        }

        return response('Unauthorized.', 401);
      }
    }
}
