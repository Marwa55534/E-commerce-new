<?php

namespace App\Http\Controllers\Dashboard\Password;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\Auth\PasswordService;

class ResetPasswordController extends Controller
{

    protected $passwordService;
    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    public function showResetForm($email){
        return view('dashboard.auth.password.reset' , ['email'=>$email]);

    } 

    public function resetPassword(ResetPasswordRequest $request){
        // valid pass , email
        // 
        $admin = $this->passwordService->resetPassword($request->email , $request->password);
        if(! $admin){
            return redirect()->back()->withErrors(['email'=>'try again latter']);
        }
        // update passw , hash
       
        return redirect()->route('dashboard.login')->with('success','Your Password Updated Successfuly');
    }
}
