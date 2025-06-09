<?php

namespace App\Repositories\Dashboard;

use App\Models\Country;
use App\Models\City;
use App\Models\Governorate;
use App\Models\ShippingGovernorate;

class WorldRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getCountries(){
        $countries = Country::withCount(['users','governorates'])
        ->when(!empty(request()->keyword) , function($query){
            $query->where('name','Like','%'.request()->keyword.'%');
        })->paginate(5);
        return $countries;
    }

    public function getCountryById($id){
        $country = Country::find($id);
        return $country;
    }

    public function getCities($governorate){
        // $city = City::select('id','name','governorate_id',)->paginate(5);
        $cities = $governorate->cities;
        return $cities;
    }

    public function getGovernorates($country){
        // relation
        $governorates = $country->governorates()
        ->with('country','shippingPrice')
        ->withCount(['users','cities'])
        ->when(!empty(request()->keyword) , function($query){
            $query->where('name','Like','%'.request()->keyword.'%');
        })->paginate(5); // <-- استبدل paginate(5) بـ get()
        return $governorates; 
    }
    

    Public function getGovernorateById($id){
        $governorate = Governorate::find($id);
        return $governorate;
    }

    // country , governorate
    public function changeStatus($model){
        $model = $model->update([
            'is_active'=>$model->is_active == 'Active' || $model->is_active == 'مفعل' ? 0 : 1,
        ]); 
     
        return $model;
    }

    // updat price
    public function changeShippingPrice($governorate,$price){
        return $governorate->shippingPrice->update([
            'price'=>$price,
        ]);
    }

    
}
