<?php

namespace App\Http\Middleware;

use Closure;

class SMPrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $iViewCode)
    {
        if (\Auth::user()->user_type_id == \Config::get('constants.TP_USER.ADMIN'))
        {
            return $next($request);
        }

        foreach (\Auth::user()->userPermission as $oAssign)
        {
            if ($oAssign->permission_id == $iViewCode)
            {
                return $next($request);
            }
        }

        return response('Unauthorized.', 401);
    }
}
