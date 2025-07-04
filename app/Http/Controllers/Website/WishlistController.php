<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('website.wishlist-table',[
            'Wishlists'=>$request->user()->wishlists()->get(),
        ]);
    }
}
// php artisan make:controller Website/WishlistController --invokable