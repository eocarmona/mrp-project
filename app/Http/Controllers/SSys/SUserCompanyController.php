<?php namespace App\Http\Controllers\SSys;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SSys\SUserCompany;
use App\SSys\SUser;
use App\SSys\SCompany;

class SUserCompanyController extends Controller
{
    private $oUtil;
    private $oCurrentUserPermission;
    private $iFilter;

    public function __construct()
    {
       $this->middleware('mdprivilege:'.\Config::get('constants.VIEW_CODE.ACCESS'));
       $this->oUtil = new SUtil();
       $this->oCurrentUserPermission = $this->oUtil->getTheUserPermission(\Auth::user()->id, \Config::get('constants.VIEW_CODE.ACCESS'));

       $this->iFilter = \Config::get('constants.FILTER.ACTIVES');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->iFilter = $request->filter == null ? \Config::get('constants.FILTER.ACTIVES') : $request->filter;
      $userCompany = SUserCompany::Search($this->iFilter)->orderBy('name', 'ASC')->paginate(4);

      $userCompany->each(function($userCompany) {
        $userCompany->user;
        $userCompany->company;
      });

      return view('userCompany.index')
                          ->with('userCompany', $userCompany)
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
          $users = SUser::orderBy('username', 'ASC')->lists('username', 'id_user');
          $companies = SCompany::orderBy('name', 'ASC')->lists('name', 'id_company');

          return view('userCompany.createEdit')
                      ->with('userCompany', $users)
                      ->with('companies', $companies);
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
        $userCompany = new SUserCompany($request->all());
        $userCompany->created_by_id = \Auth::user()->id;

        $userCompany->save();

        Flash::success("Se ha registrado de forma exitosa!");

        return redirect()->route('userCompany.index');
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
          $userCompany = SUserCompany::find($id);

          if ($this->oUtil->canEdit($this->oCurrentUserPermission->privilege_id) || $this->oUtil->canAuthorEdit($this->oCurrentUserPermission->privilege_id, $userCompany->created_by_id))
          {
              $assignament->user;
              $userCompany->company;

              $users = SUser::orderBy('username', 'ASC')->lists('username', 'id_user');
              $companies = SCompany::orderBy('name', 'ASC')->lists('name', 'id_company');

              return view('userCompany.createEdit')
                ->with('userCompany', $userCompany)
                ->with('users', $users)
                ->with('companies', $companies);
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
      $userCompany = SUserCompany::find($id);
      $userCompany->fill($request->all());
      $userCompany->save();

      Flash::success("Se ha editado de forma exitosa!");

      return redirect()->route('userCompany.index');
    }

    public function activate(Request $request, $id)
    {
      $userCompany = SUserCompany::find($id);

      $userCompany->fill($request->all());
      $userCompany->is_deleted = \Config::get('constants.STATUS.ACTIVE');

      $userCompany->save();

      Flash::success("Se ha activado de forma exitosa!");

      return redirect()->route('userCompany.index');
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
            $userCompany = SUserCompany::find($id);

            $userCompany->fill($request->all());
            $userCompany->is_deleted = \Config::get('constants.STATUS.DEL');

            $userCompany->save();
            #$userCompany->delete();
            Flash::error('Ha sido borrado de forma exitosa!');

            return redirect()->route('userCompany.index');
        }
        else
        {
            return response('Unauthorized.', 401);
        }
    }
}
