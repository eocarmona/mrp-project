<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class SMDAdmin
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
        if (\Auth::user()->user_type_id == \Config::get('constants.TP_USER.ADMIN')) {
          return $next($request);
        }
        else
        {
          return response('Unauthorized.', 401);
        }

    }
}
