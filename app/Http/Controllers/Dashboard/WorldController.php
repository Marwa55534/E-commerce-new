<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\WorldService;
use App\Http\Requests\shippingPriceRequest; 

class WorldController extends Controller 
{
    protected $worldService;
    /**
     * Create a new class instance.
     */
    public function __construct(WorldService $worldService)
    {
        $this->worldService = $worldService;
    }

    public function getCountries(){
        $countries = $this->worldService->getCountries(); 
        // if(! $countries){
        //     return redirect()->back()->with('','');
        // }
        return view('dashboard.world.countries' , compact('countries'));
    }

    public function getGovernorates($id){
        $governorates = $this->worldService->getGovernorates($id); 
        return view('dashboard.world.governorates' , compact('governorates'));

    }

    public function getCities($id){
        $cities = $this->worldService->getCities($id);  
        return view('dashboard.world.cities' , compact('cities'));
        
    }

    public function changeStatus($id){
        $country = $this->worldService->changeStatus($id);
         if(! $country){
            return response()->json(['status' => false, 'message' => __('dashboard.error_msg')], 404);
        }
        $country = $this->worldService->getCountryById($id); 
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
            'data' => $country
        ], 200);
    }

    public function changeGovStatus($id){
        $governorate = $this->worldService->changeGovStatus($id); 
        if(! $governorate){
           return response()->json(['status' => false, 'message' => __('dashboard.error_msg')], 404);
       }
       $governorate = $this->worldService->getGovernorateById($id);
       return response()->json([
           'status' => 'success',
           'message' => __('dashboard.success_msg'),
           'data' => $governorate
       ], 200);
    }

    public function changeShippingPrice(shippingPriceRequest $request)
    {
        if (!$this->worldService->changeShippingPrice($request)) {
            return response()->json([
                'status' => false,
                'message' => __('dashboard.error_msg')
            ], 404);
        }

        $governorate = $this->worldService->getGovernorateById($request->governorate_id);

        $governorate->load('shippingPrice');
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
            'data' => $governorate
        ], 200);
    }

 
}
