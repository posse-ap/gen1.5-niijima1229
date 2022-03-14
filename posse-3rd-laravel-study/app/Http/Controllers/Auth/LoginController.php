<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $maxAttempts = 5;     // ログイン試行回数（回）
    protected $decayMinutes = 3;   // ログインロックタイム（分）

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * [username 認証カラムの変更]
     * @return [type] [description]
     */
    public function username()
    {
        $username = request()->input('username');
        $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'login_id';
        // 利用中のみのユーザがログインできるようにします
        request()->merge([$field => $username, 'status'=> 1]);
        return $field;
    }
    
    /**
     * [credentials 認証カラムの追加 `status`]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password', 'status');
    }
    
    /**
     * [redirectPath 認証後のリダイレクト先の変更]
     * @return [type] [description]
     */
    public function redirectPath()
    {
        return '/';
    }
}
