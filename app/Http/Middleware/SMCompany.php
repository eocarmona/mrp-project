<?php

namespace App\Http\Middleware;

use Closure;

class SMCompany
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
        if ($request->session()->has('company')) {
           #$oCompany = $request->session()->get('company');
           return $next($request);
        }
        else
        {
          route('start');
        }
    }
}
