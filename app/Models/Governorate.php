<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use App\Models\ShippingGovernorate;

class Governorate extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    public $timestamps = false;
    
    protected $fillable = [
        "name" , "country_id" , "is_active"
    ];

    public function cities(){
        return $this->hasMany(City::class);
    }

    public function country(){
        return $this->belongsTo(Country::class); 
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    //  1 : 1
    public function shippingPrice(){
        return $this->hasOne(ShippingGovernorate::class);
    }

    public function getIsActiveAttribute($value)
    {
        if(Config::get('app.locale') == 'ar'){
            return $value == 1 ? 'مفعل' : 'غير مفعل';
        }
        return $value == 1 ? 'Active' : 'Inactive';
    }

    protected $casts = [
        'name' => 'array', // Casts JSON to array
    ];
}
