<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\SSys\SUserType;
use Laracasts\Flash\Flash;
use App\Http\Requests\UserRequest;
use App\SUtils\SValidation;
use App\SUtils\SUtil;

class SUsersController extends Controller
{
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
         $this->middleware('mdadmin');
         $this->middleware('mdpermission:'.\Config::get('scperm.TP_PERMISSION.VIEW').','.\Config::get('sperm.VIEW_CODE.USERS'));

         $this->oCurrentUserPermission = SUtil::getTheUserPermission(!\Auth::check() ? \Config::get('scsys.UNDEFINED') : \Auth::user()->id, \Config::get('scperm.VIEW_CODE.USERS'));

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
        $users = User::Search($request->name, $this->iFilter)->orderBy('username', 'ASC')->paginate(10);

        return view('users.index')
            ->with('users', $users)
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
            $types = SUserType::orderBy('name', 'ASC')->lists('name', 'id_type');

            return view('users.createEdit')->with('types', $types);
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
    public function store(UserRequest $request)
    {
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->created_by_id =\Auth::user()->id;
        $user->updated_by_id =\Auth::user()->id;
#        dd($user);
        $user->save();
        Flash::success(trans('messages.REG_CREATED'));

        return redirect()->route('users.index');
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
      $user = User::find($id);

      if (SValidation::canEdit($this->oCurrentUserPermission->privilege_id) || SValidation::canAuthorEdit($this->oCurrentUserPermission->privilege_id, $user->created_by_id))
      {
          $types = SUserType::orderBy('name', 'ASC')->lists('name', 'id_type');
          return view('users.createEdit')->with('user', $user)
                                          ->with('iFilter', $this->iFilter)
                                          ->with('types', $types);
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
        $user = User::find($id);
        $user->fill($request->all());
        $user->updated_by_id = \Auth::user()->id;
        $user->save();

        Flash::warning(trans('messages.REG_EDITED'));
        return redirect()->route('users.index');
    }

    public function activate(Request $request, $id)
    {
      $user = User::find($id);

      $user->fill($request->all());
      $user->is_deleted = \Config::get('scsys.STATUS.ACTIVE');

      $user->save();

      Flash::success(trans('messages.REG_ACTIVATED'));

      return redirect()->route('users.index');
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
        $user = User::find($id);
        $user->fill($request->all());
        $user->is_deleted = \Config::get('scsys.STATUS.DEL');
        $user->updated_by_id = \Auth::user()->id;

        $user->save();
        #$user->delete();

        Flash::error(trans('messages.REG_DELETED'));
        return redirect()->route('users.index');
      }
      else
      {
        return redirect()->route('notauthorized');
      }
    }
}
