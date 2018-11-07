<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;


class AdminLoginController extends Controller
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected $redirectTo = '/admin/home';

    public function showLoginForm()
    {
        return view('admin.login');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('admin.guest')->except('logout');//middleware check nếu đã đăng nhập admin thì k cho vào form đăng nhập nữa
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
    public function logout(Request $request)
    {
        $this->guard('admin')->logout();

        // $request->session()->invalidate();

        return redirect('admin/login');
    }
    protected function loggedOut(Request $request)
    {
       return redirect()->route('admin.showLoginForm');
    }
}