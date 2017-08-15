<?php namespace App\Http\Controllers\SMMS;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SUtils\SUtil;

class SProductionController extends Controller
{
    private $oUtil;
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
       $this->middleware('mdprivilege:'.\Config::get('constants.VIEW_CODE.PRODUCTION'));
       $this->oUtil = new SUtil();
       $this->oCurrentUserPermission = $this->oUtil->getTheUserPermission(\Auth::user()->id_user, \Config::get('constants.VIEW_CODE.PRODUCTION'));

       $this->iFilter = \Config::get('constants.FILTER.ACTIVES');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $items = [
            ' '             => [],
            'home'          => [],
            'about'         => [],
            'contact-us'    => [],
            'login'         => [],
            'register'      => [],
            'options'       => ['submenu' => [
                                    'about'     => [],
                                    'company'   => []
                                    ]
                                ]
        ];

      $sClassNav = 'navbar-orange';

      return view('mms.index', compact('items'))->with('sClassNav', $sClassNav);
      /*
      $this->iFilter = $request->filter == null ? \Config::get('constants.FILTER.ACTIVES') : $request->filter;
      $access = Access::Search($this->iFilter)->orderBy('id', 'ASC')->paginate(4);

      $access->each(function($access) {
        $access->user;
        $access->company;
      });

      return view('access.index')
                          ->with('access', $access)
                          ->with('actualAssignament', $this->oCurrentUserPermission)
                          ->with('iFilter', $this->iFilter);
      */
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
