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
     *          \Config::get('scsys.MODULES.MMS')
     *          \Config::get('scsys.MODULES.QMS')
     *          \Config::get('scsys.MODULES.WMS')
     *          \Config::get('scsys.MODULES.TMS')
     * @return mixed
     */
    public function handle($request, Closure $next, $iModule)
    {
      switch ($iModule) {
        case \Config::get('scsys.MODULES.MMS'):
          \Menu::make('sMenu', function($menu){
              $menu->add(' ');
              $menu->add('Home', array('route' => 'mms.home'));
              $menu->add('About',    'about');
              $menu->add('Services', 'services');
              $menu->add('Contact',  'contact');
              $menu->add(trans('wms.REPORTS'), 'what-we-do');
          });
          break;

        case \Config::get('scsys.MODULES.QMS'):
          \Menu::make('sMenu', function($menu){
              $menu->add(' ');
              $menu->add('Home', array('route' => 'qms.home'));
              $menu->add('About',    'about');
              $menu->add('Services', 'services');
              $menu->add('Contact',  'contact');
              $menu->add(trans('wms.REPORTS'), 'what-we-do');

          });
          break;

        case \Config::get('scsys.MODULES.WMS'):
          \Menu::make('sMenu', function($menu){
              $menu->add(' ');
              $menu->add(trans('userinterface.HOME'), array('route' => 'wms.home'));
              $menu->add(trans('mrp.MRP'), 'what-we-do')->nickname(trans('mrp.MRP'));
              $menu->get(trans('mrp.MRP'))->add(trans('mrp.MRP_COMPANIES'), array('route' => 'mrp.companies.index'));
              $menu->get(trans('mrp.MRP'))->add(trans('mrp.BRANCHES'), array('route' => 'mrp.branches.index'));
              $menu->add(trans('wms.CONFIG'), 'what-we-do')->nickname(trans('wms.CONFIG'));
              $menu->get(trans('wms.CONFIG'))->add(trans('wms.CONFIG'), 'what-we-do');
              $menu->get(trans('wms.CONFIG'))->add(trans('wms.CONFIG'), 'what-we-do');
              $menu->add(trans('wms.CATALOGUES'), 'what-we-do')->nickname(trans('wms.CATALOGUES'));
              $menu->get(trans('wms.CATALOGUES'))->add(trans('wms.WAREHOUSES'), 'what-we-do');
              $menu->get(trans('wms.CATALOGUES'))->add(trans('wms.LOCATIONS'), 'what-we-do');
              $menu->get(trans('wms.CATALOGUES'))->add(trans('wms.PALLETS'), 'what-we-do');
              $menu->get(trans('wms.CATALOGUES'))->add(trans('wms.LOTS'), 'what-we-do');
              $menu->get(trans('wms.CATALOGUES'))->add(trans('wms.BAR_CODES'), 'what-we-do');
              $menu->add(trans('wms.ITEMS'), 'what-we-do')->nickname(trans('wms.ITEMS'));
              $menu->get(trans('wms.ITEMS'))->add(trans('wms.ITEMS'), 'what-we-do');
              $menu->get(trans('wms.ITEMS'))->add(trans('wms.GENDERS'), 'what-we-do');
              $menu->get(trans('wms.ITEMS'))->add(trans('wms.GROUPS'), 'what-we-do');
              $menu->get(trans('wms.ITEMS'))->add(trans('wms.FAMILIES'), 'what-we-do');
              $menu->get(trans('wms.ITEMS'))->add(trans('wms.CONVERTIONS'), 'what-we-do');
              $menu->add(trans('wms.INVENTORY'), 'what-we-do');
              $menu->add(trans('wms.REPORTS'), 'what-we-do');

          });
          break;

        case \Config::get('scsys.MODULES.TMS'):
          \Menu::make('sMenu', function($menu){
              $menu->add(' ');
              $menu->add('Home', array('route' => 'tms.home'));
              $menu->add('About',    'about');
              $menu->add('Services', 'services');
              $menu->add('Contact',  'contact');
              $menu->add(trans('wms.REPORTS'), 'what-we-do');

          });
          break;

        default:
          # code...
          break;
      }

        return $next($request);
    }
}
