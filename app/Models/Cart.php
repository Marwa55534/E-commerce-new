<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        "user_id" ,"coupon"
    ];

    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }
}
