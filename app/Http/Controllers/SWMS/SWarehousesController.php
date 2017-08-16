<?php namespace App\Http\Controllers\SWMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SUtils\SUtil;

class SWarehousesController extends Controller
{
    private $oUtil;
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
       $this->middleware('mdprivilege:'.\Config::get('constants.VIEW_CODE.WAREHOUSES'));
       $this->middleware('mdmenu:'.\Config::get('constants.MODULES.WMS'));
       $this->oUtil = new SUtil();
       $this->oCurrentUserPermission = $this->oUtil->getTheUserPermission(\Auth::user()->id_user, \Config::get('constants.VIEW_CODE.WAREHOUSES'));

       $this->iFilter = \Config::get('constants.FILTER.ACTIVES');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
      $items = [
            ' '             => [],
            trans('menus.HOME')                   => ['route' => 'wms.home'],
            trans('menus.wms.CATALOGUES')   => ['route' => 'start'],
            trans('menus.wms.WAREHOUSES')    => [],
            trans('menus.wms.INVENTORY')    => [],
            trans('menus.wms.REPORTS')  =>
                                    ['submenu' => [
                                      trans('menus.wms.REPORT_STK')     => [],
                                      trans('menus.wms.REPORT_INV')   => [],
                                    ]
                                ],
            trans('menus.HELP')    => [],
        ];

        $sClassNav = 'navbar-blue';

        return view('wms.index', compact('items'))->with('sClassNav', $sClassNav);
   }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    public function activate(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

    }
}
