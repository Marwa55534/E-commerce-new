<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\WorldRepository;
use App\Models\Governorate;

class WorldService
{
    protected $worldRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(WorldRepository $worldRepository)
    {
        $this->worldRepository = $worldRepository;
    }

    public function getCountries(){
        return $this->worldRepository->getCountries(); 
    }

    public function getCountryById($id){
        $country = $this->worldRepository->getCountryById($id);
        if(! $country){
            // abort(404);
            return false;
        }
        return $country;
    }

    public function getCities($id){
        // $governorate = self::getGovernorateById($id);
        $governorate = $this->getGovernorateById($id);

        return $this->worldRepository->getCities($governorate);
    }

    Public function getGovernorateById($id){
        $governorate = $this->worldRepository->getGovernorateById($id);
        if(! $governorate){
            // abort(404);
            return false;
        }   
        return $governorate;
    }

    public function getGovernorates($id){
        $country = self::getCountryById($id);
        return $this->worldRepository->getGovernorates($country);


        // $country = $this->getCountryById($id); // مكنش ينفع تستخدم self:: هنا
        // if (! $country) {
        //     return false; // أو [] حسب ما انت محتاج
        // }
        // return $this->worldRepository->getGovernorates($country);

    }

  
    public function changeStatus($id){
        $country = self::getCountryById($id);
        $country = $this->worldRepository->changeStatus($country);
        if(! $country){
            return false;
        }
        return $country; 
    }

    public function changeGovStatus($id){
        $governorate = self::getGovernorateById($id);
        $governorate = $this->worldRepository->changeStatus($governorate);
        if(! $governorate){
            return false;
        }
        return true; 
    }

    public function changeShippingPrice($request)
    {
        $governorate = self::getGovernorateById($request->governorate_id);
        $governorate = $this->worldRepository->changeShippingPrice($governorate,$request->price);

        if(!$governorate){
            return false;
        }
        return true;
    }
    
}
