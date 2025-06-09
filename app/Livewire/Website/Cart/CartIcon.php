<?php

namespace App\Livewire\Website\Cart;

use Livewire\Component;
use Livewire\Attributes\On; 
    use Illuminate\Support\Collection;

class CartIcon extends Component
{
    public function removeItemFormCart($id){

        $authBoolean = auth('web')->check();
        if($authBoolean){
            $cartItem = auth('web')->user()->cart->cartItems()->where('id',$id)->first();
            $cartItem->delete();
            $this->dispatch('updateCart');

            if(auth('web')->user()->cart->cartItems->count() == 0){
                auth('web')->user()->cart->update(['coupon'=>null]);
            }
        }
        $this->dispatch('orderSummaryRefresh');

    }

    #[On('refreshCartIcon')] 
    public function render()
    { 
        $authBoolean = auth('web')->check();

        // $cartItemCount = $authBoolean ? auth('web')->user()->cart->cartItems->count() : 0 ; 
        // $cartItems = $authBoolean ? auth('web')->user()->cart->cartItems : []; 


        $cartItemCount = $authBoolean ? auth('web')->user()->cart?->cartItems()->count() ?? 0 : 0; 
        $cartItems = $authBoolean ? auth('web')->user()->cart?->cartItems ?? collect() : collect();


        return view('livewire.website.cart.cart-icon',[
            'cartItems'=>$cartItems,
            'cartItemCount'=>$cartItemCount,
        ]); 
    } 
}
