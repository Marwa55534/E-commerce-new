<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        "cart_id" , "product_id" , "product_variant_id" ,"quantity","price" ,"attributes"
    ];

    public function cart(){
        return $this->belongsTo(Cart::class );
    }

    public function product(){
        return $this->belongsTo(Product::class ,'product_id');
    }

    public function variant(){
        return $this->belongsTo(Product::class ,'product_variant_id');
    }

     // accessores

    public function getAttributesAttribute($attributes)
    {
        return json_decode($attributes , true);
    }

}
