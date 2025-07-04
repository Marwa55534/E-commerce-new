<?php

namespace App\Services\Auth;

use App\Repositories\Auth\PasswordRepository;
use App\Notifications\SendOtpPasswordNotify;

class PasswordService
{
    /**
     * Create a new class instance.
     */
    protected $passwordRepository;
    public function __construct(PasswordRepository $passwordRepository)
    {
        $this->passwordRepository = $passwordRepository;
    }

    public function sendOtp($email){ 
        $admin = $this->passwordRepository->getAdminByEmail($email);
        if(! $admin){
            return false;
        }
        $admin->notify(new SendOtpPasswordNotify()); 
        return $admin;
    }

    public function verifyOtp($email , $code){
        $otp = $this->passwordRepository->verifyOtp($email,$code);
        return $otp->status; 
    }
 
    public function resetPassword($email , $password){
        return $this->passwordRepository->resetPassword($email,$password);
    }

}
