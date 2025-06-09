<?php

namespace App\Http\Controllers\Dashboard\Password;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Session;
use App\Notifications\SendOtpPasswordNotify;
use Ichtrojan\Otp\Otp;
use App\Services\Auth\PasswordService;
use App\Http\Requests\ForgetPasswordRequest;

class ForgetPasswordController extends Controller
{
    public $otp;
    protected $passwordService;
    public function __construct(PasswordService $passwordService)
    {
        $this->otp = new Otp;
        $this->passwordService = $passwordService;

    }
    public function showEmailForm(){
        return view('dashboard.auth.password.email');
    }

    public function sendOtp(ForgetPasswordRequest $request){ 
        // valida email
        // check email found in db
        $admin = $this->passwordService->sendOtp($request->email);
        if(! $admin){
            return redirect()->back()->withErrors(['email'=>__('passwords.email_is_not_register')]);
        }

        // علشان لو رفريش ميرجعهوش ع الصفحه اللي قبلها
        return redirect()->route('dashboard.otp' , ['email'=>$admin->email]) ;
    }

    public function showOtpForm($email){
        return view('dashboard.auth.password.confirm',['email'=>$email]);

    }

    public function verifyOtp(ForgetPasswordRequest $request){
        // valid email , code
        // هقارنهم 

        $otp = $this->passwordService->verifyOtp($request->email , $request->code);
        
        // check
        if(!$otp){
            return redirect()->back()->withErrors(['error'=>"code is invalide"]);
        }
        return redirect()->route('dashboard.reset',["email"=>$request->email]);

    }
}
