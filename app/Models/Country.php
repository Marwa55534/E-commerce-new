<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Support\Facades\Config;

class Country extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    public $timestamps = false;

    protected $fillable = [
        "name" , "phone_code" , "flag_code" ,"is_active"
    ];

    public function governorates(){
        return $this->hasMany(Governorate::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function getIsActiveAttribute($value){
        if(Config::get('app.locale') == 'ar'){
            return $value == 1 ? 'مفعل' : 'غير مفعل';
        }
        return $value == 1 ? 'Active' : 'Inactive';
    }
}
