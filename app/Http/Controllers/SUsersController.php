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
    private $oUtil;
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
         #$this->middleware('mdprivilege:'.\Config::get('constants.VIEW_CODE.USERS'));
         #$this->middleware('mdcompany');
         $this->middleware('mdadmin');

         $this->oUtil = new SUtil();
         $this->oCurrentUserPermission = $this->oUtil->getTheUserPermission(\Auth::user()->id_user, \Config::get('constants.VIEW_CODE.USERS'));

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
        if ($this->oUtil->canCreate($this->oCurrentUserPermission->privilege_id))
          {
            $types = SUserType::orderBy('name', 'ASC')->lists('name', 'id_type');

            return view('users.createEdit')->with('types', $types);
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
    public function store(UserRequest $request)
    {
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->created_by_id =\Auth::user()->id_user;
        $user->save();
        Flash::success("Se ha registrado ".$user->username. " de forma exitosa!");

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

      if ($this->oUtil->canEdit($this->oCurrentUserPermission->privilege_id) || $this->oUtil->canAuthorEdit($this->oCurrentUserPermission->privilege_id, $user->created_by_id))
      {
          $types = SUserType::orderBy('name', 'ASC')->lists('name', 'id_type');
          return view('users.createEdit')->with('user', $user)
                                          ->with('iFilter', $this->iFilter)
                                          ->with('types', $types);
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
        $user = User::find($id);
        $user->fill($request->all());
        $user->updated_by_id = \Auth::user()->id_user;
        $user->save();

        Flash::warning('El usuario'  . $user->username . ' ha sido editado con exito');
        return redirect()->route('users.index');
    }

    public function activate(Request $request, $id)
    {
      $user = User::find($id);

      $user->fill($request->all());
      $user->is_deleted = \Config::get('constants.STATUS.ACTIVE');

      $user->save();

      Flash::success("Se ha activado de forma exitosa!");

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
      if ($this->oUtil->canDestroy($this->oCurrentUserPermission->privilege_id))
      {
        $user = User::find($id);
        $user->fill($request->all());
        $user->is_deleted = \Config::get('constants.STATUS.DEL');
        $user->updated_by_id = \Auth::user()->id_user;

        $user->save();
        #$user->delete();

        Flash::error('El usuario '.$user->username. ' ha sido borrado de forma exitosa!');
        return redirect()->route('users.index');
      }
      else
      {
        return response('Unauthorized.', 401);
      }
    }
}
