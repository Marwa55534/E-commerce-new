<?php

namespace App\Repositories\Auth;

use App\Models\Admin;
use Ichtrojan\Otp\Otp;

class PasswordRepository
{
    /**
     * Create a new class instance.
     */
    public $otp;
    public function __construct()
    {
        $this->otp = new Otp;
        
    }

    public function getAdminByEmail($email){ 
        $admin = Admin::where('email',$email)->first();
        return $admin;
    }

    public function verifyOtp($email , $code){
        $otp = $this->otp->validate($email , $code);
        return $otp;

    }

    public function resetPassword($email , $password){
        $admin = Self::getAdminByEmail($email);
        $admin->update([
            'password'=> bcrypt($password),
        ]);
        return $admin;
    }

}
