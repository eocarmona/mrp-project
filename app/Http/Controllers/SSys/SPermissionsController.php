<?php namespace App\Http\Controllers\SSys;

use Illuminate\Http\Request;
use App\SSys\SPermission;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;
use App\SUtils\SValidation;
use App\SUtils\SUtil;

class SPermissionsController extends Controller
{
      private $oUtil;
      private $oCurrentUserPermission;
      private $iFilter;

      public function __construct()
      {
           $this->middleware('mdpermission:'.\Config::get('constants.TP_PERMISSION.VIEW').','.\Config::get('constants.VIEW_CODE.PERMISSIONS'));
           $this->oUtil = new SUtil();
           $this->oCurrentUserPermission = $this->oUtil->getTheUserPermission(\Auth::user()->id, \Config::get('constants.VIEW_CODE.PERMISSIONS'));

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
        $permissions = SPermission::Search($request->name, $this->iFilter)->orderBy('name', 'ASC')->paginate(4);

        return view('permissions.index')
                    ->with('permissions', $permissions)
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
          return view('permissions.createEdit');
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
        $permission = new SPermission($request->all());
        $permission->save();

        Flash::success("Se ha registrado ".$permission->name. " de forma exitosa!");

        return redirect()->route('permissions.index');
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
        $permission = SPermission::find($id);

        if ($this->oUtil->canEdit($this->oCurrentUserPermission->privilege_id) || $this->oUtil->canAuthorEdit($this->oCurrentUserPermission->privilege_id, $permission->created_by_id))
        {
          return view('permissions.createEdit')->with('permission', $permission)
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
        $permission = SPermission::find($id);
        $permission->fill($request->all());
        $permission->save();

        Flash::warning('El permiso ' .$permission->name. ' ha sido editado con exito');
        return redirect()->route('permissions.index');
    }

    public function activate(Request $request, $id)
    {
      $permission = SPermission::find($id);

      $permission->fill($request->all());
      $permission->is_deleted = \Config::get('constants.STATUS.ACTIVE');

      $permission->save();

      Flash::success("Se ha activado de forma exitosa!");

      return redirect()->route('permissions.index');
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
        $permission = SPermission::find($id);

        $permission->fill($request->all());
        $permission->is_deleted = \Config::get('constants.STATUS.DEL');

        $permission->save();
        #$permission->delete();
        Flash::error('El permiso '.$permission->name. ' ha sido borrado de forma exitosa!');

        return redirect()->route('permissions.index');
      }
      else
      {
        return response('Unauthorized.', 401);
      }
    }
}
