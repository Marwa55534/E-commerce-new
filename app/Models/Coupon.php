<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Config;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        "code" , "discount_percentage" , "start_date" , "end_date" ,"limit" , "time_used" , "is_active"
    ];

     // accessors مش بتتبطق غير لو  انا عملت اكسس ع الاتربيوت بشكل مباشر
    public function getCreatedAtAttribute($value){
        return date('d/m/Y h:i A',strtotime($value));
    }
    public function getUpdatedAtAttribute($value){
        return date('d/m/Y h:i A',strtotime($value));
    }

     // local scop
  
    public function scopeValid($query)
    {
        return $query->where('is_active', 1)
            ->whereColumn('time_used', '<', 'limit') // اقل
            ->where('end_date', '>', now()) // اكبر
            ->where('start_date', '<=', now());
    }

      public function scopeNotValid($query)
    {
        return $query->where('is_active', 0)
            ->orWhere('time_used', '>=', 'limit') // اكبر من 
            ->orWhere('end_date', '<', now()); // اقل 
    }
   
     public function couponIsValid()
    {
        return $this->is_active == 1 && $this->time_used < $this->limit && $this->end_date > now();
    }

    public function getStatus(){
        if(Config::get('app.locale') == 'ar'){
            return $this->is_active == 1 ? 'مفعل' : 'غير مفعل';
        }
        return $this->is_active == 1 ? 'Active' : 'Inactive'; 
    }

    // عايزه يستخدمو 100 شخص
    // دالة لزيادة عدد مرات الاستخدام
    // public function incrementUsage()
    // {
    //     $this->time_used += 1;
    //     $this->save();
    // }

}
