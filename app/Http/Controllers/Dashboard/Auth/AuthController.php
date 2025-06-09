<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAdminRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;
use App\Services\Auth\AuthService;

class AuthController extends Controller // implements  HasMiddleware
{
    protected $authService; 
    public function __construct(AuthService $authService){
        $this->authService = $authService;
        $this->middleware('guest:admin')->except('logout'); 
    }

    // public static function middleware(){
    //     return [
    //         new Middleware(middleware: 'guest:admin' , except:(['logout'])),
    //     ];
    // } 
    public function showLoginForm(){
        return view('dashboard.auth.login');
    }

    public function login(CreateAdminRequest $request){

        $credenstials = $request->only(['email','password']);
        
        $authService = $this->authService->login($credenstials,'admin', $request->remember);

        if($authService){  
            return redirect()->intended(route('dashboard.welcome'));
        }
        return redirect()->back()->withErrors(['email'=> __('auth.not_match')]);
    } 

    public function logout(){
        
        $this->authService->logout('admin');
        return redirect()->route('dashboard.login');
    }
}
