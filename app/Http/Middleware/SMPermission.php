<?php

namespace App\Http\Middleware;

use Closure;
use App\SUtils\SValidation;

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
        if (SValidation::hasPermission($iPermissionType, $iPermissionCode))
        {
          return $next($request);
        }
        else
        {
          return response('Unauthorized.', 401);
        }
    }
}
