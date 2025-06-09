<?php

namespace App\Livewire\Website\Wishlist;

use Livewire\Component;
use App\Models\Wishlist;

class ProductWishlist extends Component
{
    public $product;
    public $inWishlist = false;

    public function mount($product){
        $this->product = $product;

        if(auth('web')->check()){
            $status = Wishlist::where('product_id',$product->id)
            ->where('user_id',auth('web')->user()->id)->first();
            $this->inWishlist = $status ? true : false;
        }

    }
    public function addToWishlist($productId){
        if(! auth('web')->check()){
            return redirect()->route('website.showLogin');
        }
        Wishlist::create([
            'product_id'=>$productId,
            'user_id'=>auth('web')->user()->id,
        ]);
        $this->inWishlist = true;
        $this->dispatch('addToWishlist'); // event

        $this->dispatch('wishlistCountRefresh'); // event increament

    }
    public function removeFromWishlist($productId){
        if(! auth('web')->check()){
            return redirect()->route('website.showLogin');
        }
        $wishlist = Wishlist::where('product_id',$productId)
            ->where('user_id',auth('web')->user()->id)->first();

        if($wishlist){
            $wishlist->delete();    
            $this->inWishlist = false;
        }
        $this->dispatch('removeFromWishlist'); // event

        $this->dispatch('wishlistCountRefresh'); // event decrement


    } 
    public function render()
    {
        return view('livewire.website.wishlist.product-wishlist');
    }
}
