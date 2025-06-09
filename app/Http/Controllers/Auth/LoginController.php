<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request; // Correct class for dependency injection
use Illuminate\Routing\Controllers\Middleware;  
use Illuminate\Routing\Controllers\HasMiddleware;


class LoginController extends Controller // implements HasMiddleware   
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
    protected $redirectTo = '/home'; // /home

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('guest', except: ['logout']), 
    //         new Middleware('auth', only: ['logout']),
    //     ];
    // }
    public function showLoginForm()
    {
        return view('website.auth.login');
        // return redirect()->route('website.showLogin');
    }

    protected function authenticated(Request $request, $user)
    {
        Session::flash('success',__('dashboard.success_msg'));
        return redirect()->route('website.profile.index');    
    }

    protected function loggedOut(Request $request)
    {
        return redirect()->route('website.showLogin');
    }

    // public function redirectTo()
    // {
    //     // return route('website.showLogin');
    //     return route('website.profile.index'); 
    // }
}


























