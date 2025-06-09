<?php

namespace App\Livewire\Website\Wishlist;

use Livewire\Component;
use App\Models\Wishlist;
use Livewire\Attributes\On; 
class WishlistIcon extends Component
{
    // public $count = 0;

    // protected $listeners = ['wishlistUpdated' => 'updateCount'];

    // public function mount()
    // {
    //     $this->updateCount();
    // }

    // public function updateCount()
    // {
    //     if (auth('web')->check()) {
    //         $this->count = Wishlist::where('user_id', auth('web')->id())->count();
    //     } else {
    //         $this->count = 0;
    //     }
    // }

    #[On('wishlistCountRefresh')] 
    public function render()
    {
        $count = auth('web')->check() ? auth('web')->user()->wishlists()->get()->count() : 0;
        return view('livewire.website.wishlist.wishlist-icon',[
            'count'=>$count, 
        ]);
    }
}
