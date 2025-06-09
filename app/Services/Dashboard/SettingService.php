<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\SettingRepository;
use App\Utils\Image;

class SettingService
{
    /**
     * Create a new class instance.
     */
    protected $settingRepository , $image;
    public function __construct(SettingRepository $settingRepository , Image $image) 
    {
        $this->settingRepository = $settingRepository;
        $this->image = $image;
    }

    public function getSetting($id){
        $setting = $this->settingRepository->getSetting($id);
        if(!$setting){
            abort(404);
        }
        return $setting;
    }

    public function update($data,$id){
        $setting = $this->getSetting($id);

        // logo
        if(array_key_exists('logo', $data) && $data['logo'] !=null ){
            // delete old favicon
            $this->image->deleteImageFromLocal($setting->logo);

            $file_name = $this->image->uploadSingleImage('/' , $data['logo'] , 'settings');
            $data['logo'] = $file_name;
        }

        // favicon
        if(array_key_exists('favicon',$data) && $data['favicon'] !=null ){
            // delete old favicon
            $this->image->deleteImageFromLocal($setting->favicon);

            $file_name = $this->image->uploadSingleImage('/',$data['favicon'] , 'settings');
            $data['favicon'] = $file_name;

        }
        return $this->settingRepository->update($data , $setting);

    }
}
