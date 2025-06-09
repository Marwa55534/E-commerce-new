<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = "order_items";  

    protected $fillable = [
        "product_name" , "product_desc" , "product_quantity" , "product_price" ,
        "attributes" , "product_id" , "order_id" ,"product_variant_id"
    ]; 

    public function Order(){
        return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function variant(){
        return $this->belongsTo(Product::class ,'product_variant_id');
    }

    public function getAttributesAttribute($value){
        return json_decode($value);
    }
}
