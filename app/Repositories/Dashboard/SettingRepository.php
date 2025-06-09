<?php

namespace App\Repositories\Dashboard;

use App\Models\Setting;

class SettingRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    } 

    public function getSetting($id){
        $setting = Setting::find($id);
        return $setting;
    }

    public function update($data,$setting){
        $setting = $setting->update($data);
        return $setting;
    }
    
}
