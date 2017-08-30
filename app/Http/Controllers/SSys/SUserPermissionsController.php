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
  private $oCurrentUserPermission;
  private $iFilter;

  public function __construct()
  {
       $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('scperm.VIEW_CODE.ASSIGNAMENTS'));

       $this->oCurrentUserPermission = SUtil::getTheUserPermission(\Auth::user()->id, \Config::get('scperm.VIEW_CODE.ASSIGNAMENTS'));

       $this->iFilter = \Config::get('scsys.FILTER.ACTIVES');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->iFilter = $request->filter == null ? \Config::get('scsys.FILTER.ACTIVES') : $request->filter;
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
      if (SValidation::canCreate($this->oCurrentUserPermission->privilege_id))
        {
          $users = User::orderBy('username', 'ASC')->lists('username', 'id');
          $permissions = SPermission::orderBy('name', 'ASC')->lists('name', 'id_permission');
          $privileges = SPrivilege::orderBy('name', 'ASC')->lists('name', 'id_privilege');

          return view('userPermissions.createEdit')
                      ->with('users', $users)
                      ->with('permissions', $permissions)
                      ->with('privileges', $privileges);
        }
        else
        {
           return redirect()->route('notauthorized');
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

        $userPermission->save();

        Flash::success(trans('messages.REG_CREATED'));

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

      if (SValidation::canEdit($this->oCurrentUserPermission->privilege_id) || SValidation::canAuthorEdit($this->oCurrentUserPermission->privilege_id, $userPermission->created_by_id))
      {
          $userPermission->user;
          $userPermission->permission;
          $userPermission->privilege;

          $users = User::orderBy('username', 'ASC')->lists('username', 'id');
          $permissions = SPermission::orderBy('name', 'ASC')->lists('name', 'id_permission');
          $privileges = SPrivilege::orderBy('name', 'ASC')->lists('name', 'id_privilege');

          return view('userPermissions.createEdit')
            ->with('userPermission', $userPermission)
            ->with('users', $users)
            ->with('permissions', $permissions)
            ->with('privileges', $privileges);
        }
        else
        {
            return redirect()->route('notauthorized');
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

      Flash::success(trans('messages.REG_EDITED'));

      return redirect()->route('userPermissions.index');
    }

    public function activate(Request $request, $id)
    {
      $userPermission = SUserPermission::find($id);

      $userPermission->fill($request->all());
      $userPermission->is_deleted = \Config::get('scsys.STATUS.ACTIVE');

      $userPermission->save();

      Flash::success(trans('messages.REG_ACTIVATED'));

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
      if (SValidation::canDestroy($this->oCurrentUserPermission->privilege_id))
        {
            $userPermission = SUserPermission::find($id);

            $userPermission->fill($request->all());
            $userPermission->is_deleted = \Config::get('scsys.STATUS.DEL');

            $userPermission->save();
            #$userPermission->delete();
            Flash::error(trans('messages.REG_DELETED'));

            return redirect()->route('userPermissions.index');
        }
        else
        {
            return redirect()->route('notauthorized');
        }
    }
}
