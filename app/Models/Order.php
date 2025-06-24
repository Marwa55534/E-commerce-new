<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        "user_id" , "user_name" , "user_phone" , "user_email" ,
        "price" , "shapping_price" , "total_price" , "note" , 
        "status" , "country" , "governorate" , "city" , "street" ,"coupon_discount","coupon"
    ];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    } 

    public function user(){
        return $this->belongsTo(User::class);
    } 

    // acssoss
    public function getCreatedAtAttribute($value){
      return date('d/m/Y h:i A',strtotime($value));

    }
}
