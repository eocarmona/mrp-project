<?php namespace App\Http\Controllers\SSys;

use Illuminate\Http\Request;
use App\SSys\SUserPermission;
use Laracasts\Flash\Flash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\SSys\SPermission;
use App\SSys\SPrivilege;
use App\SUtils\SValidation;
use App\SUtils\SUtil;

class SUserPermissionsController extends Controller
{
  private $oUtil;
  private $oCurrentUserPermission;
  private $iFilter;

  public function __construct()
  {
       $this->middleware('mdpermission:'.\Config::get('constants.TP_PERMISSION.VIEW')','.\Config::get('constants.VIEW_CODE.ASSIGNAMENTS'));
       
       $this->oUtil = new SUtil();
       $this->oCurrentUserPermission = $this->oUtil->getTheUserPermission(\Auth::user()->id, \Config::get('constants.VIEW_CODE.ASSIGNAMENTS'));

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
        $userPermissions = SUserPermission::orderBy('id_usr_per', 'ASC')->paginate(4);

        $userPermissions->each(function($userPermissions) {
          $userPermissions->user;
          $userPermissions->permission;
          $userPermissions->privilege;
        });

        return view('userPermissions.index')
                            ->with('userPermissions', $userPermissions)
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
          $users = User::orderBy('username', 'ASC')->lists('username', 'id_user');
          $permissions = SPermission::orderBy('name', 'ASC')->lists('name', 'id_permission');
          $privileges = SPrivilege::orderBy('name', 'ASC')->lists('name', 'id_privilege');

          return view('userPermissions.createEdit')
                      ->with('users', $users)
                      ->with('permissions', $permissions)
                      ->with('privileges', $privileges);
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
        $userPermission = new SUserPermission($request->all());
        $userPermission->created_by_id = \Auth::user()->id;

        $userPermission->save();

        Flash::success("Se ha registrado de forma exitosa!");

        return redirect()->route('userPermissions.index');
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
      $userPermission = SUserPermission::find($id);

      if ($this->oUtil->canEdit($this->oCurrentUserPermission->privilege_id) || $this->oUtil->canAuthorEdit($this->oCurrentUserPermission->privilege_id, $userPermission->created_by_id))
      {
          $userPermission->user;
          $userPermission->permission;
          $userPermission->privilege;

          $users = User::orderBy('username', 'ASC')->lists('username', 'id_user');
          $permissions = SPermission::orderBy('name', 'ASC')->lists('name', 'id_permission');
          $privileges = SPrivilege::orderBy('id', 'ASC')->lists('name', 'id_privilege');

          return view('userPermissions.createEdit')
            ->with('userPermission', $userPermission)
            ->with('users', $users)
            ->with('permissions', $permissions)
            ->with('privileges', $privileges);
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
      $userPermission = SUserPermission::find($id);
      $userPermission->fill($request->all());
      $userPermission->save();

      Flash::success("Se ha editado de forma exitosa!");

      return redirect()->route('userPermissions.index');
    }

    public function activate(Request $request, $id)
    {
      $userPermission = SUserPermission::find($id);

      $userPermission->fill($request->all());
      $userPermission->is_deleted = \Config::get('constants.STATUS.ACTIVE');

      $userPermission->save();

      Flash::success("Se ha activado de forma exitosa!");

      return redirect()->route('userPermissions.index');
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
            $userPermission = SUserPermission::find($id);

            $userPermission->fill($request->all());
            $userPermission->is_deleted = \Config::get('constants.STATUS.DEL');

            $userPermission->save();
            #$userPermission->delete();
            Flash::error('Ha sido borrado de forma exitosa!');

            return redirect()->route('userPermissions.index');
        }
        else
        {
            return response('Unauthorized.', 401);
        }
    }
}
