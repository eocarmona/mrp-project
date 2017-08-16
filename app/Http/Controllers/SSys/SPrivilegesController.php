<?php namespace App\Http\Controllers\SSys;

use Illuminate\Http\Request;
use App\SSys\SPrivilege;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Http\Controllers\Controller;
use App\SUtils\SValidation;
use App\SUtils\SUtil;

class SPrivilegesController extends Controller
{
      private $oUtil;
      private $oCurrentUserPermission;
      private $iFilter;

      public function __construct()
      {
           $this->middleware('mdpermission:'.\Config::get('constants.TP_PERMISSION.VIEW')','.\Config::get('constants.VIEW_CODE.PRIVILEGES'));
           $this->oUtil = new SUtil();
           $this->oCurrentUserPermission = $this->oUtil->getTheUserPermission(\Auth::user()->id, \Config::get('constants.VIEW_CODE.PRIVILEGES'));

           $this->iFilter = \Config::get('constants.FILTER.ACTIVES');
      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->iFilter = $request->filter == null ? \Config::get('constants.FILTER.ACTIVES') : $request->filter;
        $privileges = SPrivilege::Search($request->name, $this->iFilter)->orderBy('name', 'ASC')->paginate(4);

        return view('privileges.index')
                  ->with('privileges', $privileges)
                  ->with('actualUserPermission', $this->oCurrentUserPermission)
                  ->with('iFilter', $this->iFilter);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if ($this->oUtil->canCreate($this->oCurrentUserPermission->privilege_id))
        {
          return view('privileges.createEdit');
        }
        else
        {
           return response('Unauthorized.', 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $privilege = new SPrivilege($request->all());
        $privilege->save();

        Flash::success("Se ha registrado ".$privilege->name." de forma exitosa!");

        return redirect()->route('privileges.index');
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
        $privilege = SPrivilege::find($id);

        if ($this->oUtil->canEdit($this->oCurrentUserPermission->privilege_id) || $this->oUtil->canAuthorEdit($this->oCurrentUserPermission->privilege_id, $privilege->created_by))
        {
          return view('privileges.createEdit')
                                              ->with('privilege', $privilege)
                                              ->with('iFilter', $this->iFilter);
        }
        else
        {
            return response('Unauthorized.', 401);
        }
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
        $privilege = SPrivilege::find($id);
        $privilege->fill($request->all());
        $privilege->save();

        Flash::warning('El privilegio ' .$privilege->name. ' ha sido editado con exito');
        return redirect()->route('privileges.index');
    }

    public function activate(Request $request, $id)
    {
      $privilege = SPrivilege::find($id);

      $privilege->fill($request->all());
      $privilege->is_deleted = \Config::get('constants.STATUS.ACTIVE');

      $privilege->save();

      Flash::success("Se ha activado de forma exitosa!");

      return redirect()->route('privileges.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      if ($this->oUtil->canDestroy($this->oCurrentUserPermission->privilege_id))
      {
        $privilege = SPrivilege::find($id);

        $privilege->fill($request->all());
        $privilege->is_deleted = \Config::get('constants.STATUS.DEL');

        $privilege->save();
        #$privilege->delete();
        Flash::error('El privilegio ha sido borrado de forma exitosa!');

        return redirect()->route('privileges.index');
      }
      else
      {
        return response('Unauthorized.', 401);
      }
    }
}
