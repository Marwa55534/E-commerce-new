<?php

namespace App\Livewire\Website\Checkout;

use Livewire\Component;
use App\Models\Coupon as CouponModel;
use App\Models\Cart;
use Livewire\Attributes\On; 

class Coupon extends Component
{
    public $code;
    public $cart;
    public $cartItemsCount = 0;
    public $couponInfo = null;

    #[On('orderSummaryRefresh')] 
    public function mount(){
        $this->cart = Cart::where('user_id',auth('web')->user()->id)->first();
        $this->cartItemsCount = $this->cart->cartItems->count() ?? 0;

        if($this->cart->coupon != null){
            $couponObj = CouponModel::valid()->where('code',$this->cart->coupon)->first();
            if($couponObj){
                $this->couponInfo = 'Coupon Will Applied' . $couponObj->discount_percentage . '% Coupon Code: ' . $couponObj->code . 'Coupon Validity: ' . $couponObj->end_date;

            }
        }
    }

    public function applyCode(){
        if(!$this->checkCouponVaild($this->code)){
            $this->dispatch('couponNotVaild','Coupon not vaild');
            return;
        }

        $cart = Cart::where('user_id',auth('web')->user()->id)->first();
        $cart->update([
            'coupon'=>$this->code,
        ]);

        // increament coupon count
        $couponObj = CouponModel::where('code',$this->code)->first();
        $couponObj->update([
            'time_used'=> $couponObj->time_used + 1,
        ]);

        $this->couponInfo = 'Coupon Will Applied' . $couponObj->discount_percentage . '% Coupon Code: ' . $couponObj->code . 'Coupon Validity: ' . $couponObj->end_date;
        $this->dispatch('couponApplied',$this->couponInfo);
    }

    public function checkCouponVaild($code){
        $couponObj = CouponModel::where('code',$code)->first();
        if(!$couponObj){
            return false;
        }
         if(!$couponObj->couponIsValid()){
            return false;
        }
        return $couponObj;
    }

    public function render()
    {
        return view('livewire.website.checkout.coupon');
    }
}
