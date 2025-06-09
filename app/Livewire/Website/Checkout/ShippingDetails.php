<?php

namespace App\Livewire\Website\Checkout;

use App\Models\ShippingGovernorate;
use Livewire\Component;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\City;

class ShippingDetails extends Component
{
    public $countryId , $governorateId , $cityId;
    
    public function updatedGovernorateId($price){
        $price = ShippingGovernorate::where('governorate_id',$this->governorateId)->first()->price;
        $this->dispatch('shippingUpdatePrice',$price);
    }

    public function render()
    {
        return view('livewire.website.checkout.shipping-details',[
            'countries' => Country::get(),
            'governorates' => $this->countryId ? Governorate::where('country_id',$this->countryId)->get() : [],
            'cities' => $this->governorateId ? City::where('governorate_id',$this->governorateId)->get() : [],
        ]);
    }
}
