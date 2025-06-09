<?php

namespace App\Livewire\Website\Wishlist;

use Livewire\Component;
use App\Models\Wishlist;

class WishlistTable extends Component
{

    public function removeFromWishlist($wishlistsId){
        $Wishlist = Wishlist::find($wishlistsId);
        $Wishlist->delete();

        $this->dispatch('wishlistCountRefresh'); // event decrement
    } 

    public function cleanWishlist(){
        auth('web')->user()->Wishlists()->delete();
        $this->dispatch('wishlistCountRefresh'); // event decrement
    } 

     
    public function render()
    {
        return view('livewire.website.wishlist.wishlist-table',[
            'Wishlists'=> auth('web')->user()->wishlists()->get(),

        ]);
    } 
}


