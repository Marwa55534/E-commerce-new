<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\City;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest'); 
    }

    public function showRegistrationForm()
    {                    
        return view('website.auth.register');

    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        if(!$this->checkterms($request->terms)){
            return redirect()->back()->withErrors([__('dashboard.error_msg')]);
        }
        event(new Registered($user = $this->create($request->all())));

        $user->cart()->create();

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    public function checkterms($terms){
        if($terms == 'on' || $terms == 1){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'mobile'=>['required', 'string', 'max:15'],
            'country_id' => ['required', 'exists:countries,id'],
            'governorate_id' => ['required','exists:governorates,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'terms' => ['in:on,off'], 
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']), 
            'country_id' =>$data['country_id'],
            'governorate_id' =>$data['governorate_id'],
            'city_id' =>$data['city_id'],
        ]);
    }

    protected function registered(Request $request, $user)
    {
        Session::flash('success',__('dashboard.success_msg'));
        return redirect()->route('website.profile.index');  
    }
}
 