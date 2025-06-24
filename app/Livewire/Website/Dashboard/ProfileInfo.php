<?php

namespace App\Livewire\Website\Dashboard;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\City;

class ProfileInfo extends Component
{
    public $screen = 'dashboard';
    public $auth_user;
    public $name , $email , $mobile;
    public $country_id , $governorate_id , $city_id;

    public function mount($auth_user){
        $this->auth_user = $auth_user;

        $this->name = $auth_user->name;
        $this->email = $auth_user->email;
        $this->mobile = $auth_user->mobile;
        $this->country_id = $auth_user->country->id;
        $this->governorate_id = $auth_user->governorate->id;
        $this->city_id = $auth_user->city->id;
    }

    #[On('personalSelectScreen')]
    public function selectScreen($screen){
        $this->screen = $screen;
    }

    protected function rules(){
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|string|max:15', 
            'country_id' => 'required|exists:countries,id', // selected
            'governorate_id' => 'required|exists:governorates,id', // selected
            'city_id' => 'required|exists:cities,id', // selected
        ];
    }

    public function updateProfile(){
        $this->validate();
        $this->auth_user->update([
            'name'=>$this->name,
            'email'=>$this->email,
            'mobile'=>$this->mobile,
            'country_id'=>$this->country_id,
            'governorate_id'=>$this->governorate_id,
            'city_id'=>$this->city_id,
        ]);
        $this->dispatch('profileUpdated','profile updated successfuly');
    }

    public function cancel(){
        
    }
    public function render()
    {
        return view('livewire.website.dashboard.profile-info',[
            'countries' => Country::get(),
            'governorates' => $this->country_id ? Governorate::where('country_id',$this->country_id)->get() : [],
            'cities' => $this->governorate_id ? City::where('governorate_id',$this->governorate_id)->get() : [],
        ]);
    }
}
