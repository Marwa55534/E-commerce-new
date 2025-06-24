<?php

namespace App\Livewire\Website\Dashboard;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Component
{
    public $screen = 'dashboard';
    public $auth_user;
    public $old_password;
    public $password;
    public $password_confirmation;



    public function mount($auth_user){
        $this->auth_user = $auth_user;
    
    }

    public function upldatePassword(){
        $this->validate([
            'old_password'=> 'required',
            'password'=> 'required|min:8|max:100',
            'password_confirmation'=> 'required|same:password',

        ]);
        if(Hash::check($this->old_password , auth('web')->user()->password)){
            auth('web')->user()->update([
                'password'=>bcrypt($this->password),
            ]);
            $this->dispatch('passwordUpdated','password update successfuly');
            $this->reset('password','old_password','password_confirmation');
        }else{
            $this->dispatch('oldPasswordNotMatched','old Password Not Matched');
        }
    }

    public function resetForm(){

    }

    #[On('passwordSelectScreen')]
    public function selectScreen($screen){ 
        $this->screen = $screen;
    }
    public function render()
    {
        return view('livewire.website.dashboard.change-password');
    }
}
