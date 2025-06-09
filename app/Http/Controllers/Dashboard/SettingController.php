<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use App\Services\Dashboard\SettingService;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{

    protected $settingService;
    public function __construct(SettingService $settingService) 
    {
        $this->settingService = $settingService;
    }

    public function index(){
        return view('dashboard.settings.index'); 
    }

    public function update(SettingRequest $request , $id){
        
        $data = $request->except(['_token' , '_method']);

        $setting = $this->settingService->update($data , $id);
        if(!$setting){
            Session::flash('error' , __('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success' , __('dashboard.success_msg'));
        return redirect()->back();
    }
}
