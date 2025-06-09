<?php

namespace App\Livewire\Website\Cart;

use App\Models\CartItem;
use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\Cart;

class CartTable extends Component
{
    public function decrementQuantity($id){
        $cartItem = CartItem::find($id);
        $cartItem->quantity -= 1;
        $cartItem->save();
    }

    public function incrementQuantity($id){
        $cartItem = CartItem::find($id);
        $cartItem->quantity += 1;
        $cartItem->save();
    }

    public function removeItem($id){
        $cartItem = CartItem::find($id);
        $cartItem->delete();

        $this->dispatch('refreshCartIcon');
    }

    public function clearCart(){

        $authUser = auth('web')->user();
        $cart = $authUser->cart;
        $cart->cartItems()->delete();

        $this->dispatch('refreshCartIcon');
    }

    #[On('updateCart')] 
    public function render()
    {
        
        $authUser = auth('web')->user();
        $cart = $authUser->cart;
        $cart->load('cartItems.product.images');

        // dd($cart);
        return view('livewire.website.cart.cart-table',[
            'cartItems'=>$cart->cartItems,
        ]);
    }
}
