<?php namespace App\Http\Controllers\SSys;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SUtils\SValidation;
use App\SUtils\SUtil;
use App\SSys\SCompany;
use App\SSys\SUserCompany;

class SStartController extends Controller
{
    private $oUtil;

    public function __construct()
    {
        session()->forget('company');
        $this->oUtil = new SUtil();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lUserCompany = $this->oUtil->getUserCompany(\Auth::user());

        return view('start.select')
                            ->with('lUserCompany', $lUserCompany);
    }

    /**
     *
     */
    public function getIn(Request $request)
    {
        $iCompanyId =  $_COOKIE['iCompanyId'];
        $oCompany = SCompany::find($iCompanyId);

        session(['company' => $oCompany]);

        \Config::set('database.connections.mrp.host', $oCompany->host);
        \Config::set('database.connections.mrp.username', $oCompany->database_user);
        \Config::set('database.connections.mrp.password', $oCompany->password);
        \Config::set('database.connections.mrp.database', $oCompany->database_name);

        #\Config::set('database.default', 'mrp');
        \DB::reconnect('mrp');

        return SStartController::selectModule();
    }

    /**
     *
     */
    public function selectModule()
    {
        return view('start.modules');
    }
}
