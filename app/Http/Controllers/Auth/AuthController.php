<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Controllers\Auth\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected $redirectPath = '/start';

    protected $redirectLogin = 'auth/login';

    protected $loginPath ='auth/login';

    protected $redirectAfterLogout = '/';


    public function getCredentials($request)
    {
        $credentials = $request->only($this->loginUsername(), 'password');

        return array_add($credentials, 'is_deleted', \Config::get('scsys.STATUS.ACTIVE'));
    }

    public function authenticated($request, User $user)
    {
        if (!$user->is_deleted) {
            return redirect()->intended($this->redirectPath());
        } else {
            dd("error");
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function getLogin()
    {
        return view('auth.login');
    }

}
