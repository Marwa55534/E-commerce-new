<?php

namespace App\Livewire\Website\Checkout;

use Livewire\Component;
use App\Models\Cart;
use Livewire\Attributes\On; 

class OrderSummary extends Component
{
    public $shippingPrice = 0;

    #[On('shippingUpdatePrice')] 
    public function updateShippingPrice($price){
        $this->shippingPrice = $price;
    }

    #[On('orderSummaryRefresh')] 
    public function render()
    {
        $cart = Cart::with('cartItems')->where('user_id',auth('web')->user()->id)->first();
        return view('livewire.website.checkout.order-summary',[
            'cart'=>$cart,
        ]);
    }
}
