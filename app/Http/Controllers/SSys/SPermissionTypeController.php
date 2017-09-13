<?php namespace App\Http\Controllers\SSys;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SSys\SPermissionType;
use Laracasts\Flash\Flash;

class SPermissionTypeController extends Controller
{
      private $iFilter;

      public function __construct()
      {
         $this->middleware('mdadmin');
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
         $lPermissionTypes = SPermissionType::Search($request->name, $this->iFilter)->orderBy('name', 'ASC')->paginate(10);

         return view('permissionTypes.index')
             ->with('permissionTypes', $lPermissionTypes)
             ->with('actualUserPermission', NULL)
             ->with('iFilter', $this->iFilter);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissionType = SPermissionType::find($id);

        return view('permissionTypes.edit')->with('company', $permissionType)
                                      ->with('iFilter', $this->iFilter);
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
        $permissionType = SPermissionType::find($id);
        $permissionType->fill($request->all());
        $permissionType->updated_by_id = \Auth::user()->id;
        $permissionType->save();

        Flash::warning(trans('messages.REG_EDITED'));

        return redirect()->route('permissionTypes.index');
    }


    public function activate(Request $request, $id)
    {
        $permissionType = SPermissionType::find($id);

        $permissionType->fill($request->all());
        $permissionType->is_deleted = \Config::get('scsys.STATUS.ACTIVE');
        $permissionType->updated_by_id = \Auth::user()->id;

        $permissionType->save();

        Flash::success(trans('messages.REG_ACTIVATED'));

        return redirect()->route('permissionTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
      {
        $permissionType = SPermissionType::find($id);
        $permissionType->fill($request->all());
        $permissionType->is_deleted = \Config::get('scsys.STATUS.DEL');
        $permissionType->updated_by_id = \Auth::user()->id;

        $permissionType->save();
        #$user->delete();

        Flash::error(trans('messages.REG_DELETED'));

        return redirect()->route('permissionTypes.index');
    }
}
