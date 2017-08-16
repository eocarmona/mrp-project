<?php

namespace App\Http\Middleware;

use Closure;

class SMMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int $iModule can be:
     *          \Config::get('constants.MODULES.MMS')
     *          \Config::get('constants.MODULES.QMS')
     *          \Config::get('constants.MODULES.WMS')
     *          \Config::get('constants.MODULES.TMS')
     * @return mixed
     */
    public function handle($request, Closure $next, $iModule)
    {
      switch ($iModule) {
        case \Config::get('constants.MODULES.MMS'):
          \Menu::make('sMenu', function($menu){
              $menu->add(' ');
              $menu->add('Home');
              $menu->add('About',    'about');
              $menu->add('Services', 'services');
              $menu->add('Contact',  'contact');
          });
          break;
        case \Config::get('constants.MODULES.QMS'):
          \Menu::make('sMenu', function($menu){
              $menu->add('Home');
              $menu->add('About',    'about');
              $menu->add('Services', 'services');
              $menu->add('Contact',  'contact');
          });
          break;
        case \Config::get('constants.MODULES.WMS'):
          \Menu::make('sMenu', function($menu){
              $menu->add(' ');
              $menu->add('Inicio');
              $menu->add('About',    'about');
              $menu->add('Services', 'services');
              $menu->add('Contact',  'contact');
          });
          break;
        case \Config::get('constants.MODULES.TMS'):
          \Menu::make('sMenu', function($menu){
              $menu->add('Home');
              $menu->add('About',    'about');
              $menu->add('Services', 'services');
              $menu->add('Contact',  'contact');
          });
          break;

        default:
          # code...
          break;
      }



        return $next($request);
    }
}
