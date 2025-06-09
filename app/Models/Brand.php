<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Translatable\HasTranslations;
use App\Models\Product;
use Illuminate\Support\Facades\Config;

class Brand extends Model
{
    use Sluggable , HasTranslations;

    public $translatable = ['name'];
    protected $fillable = [
        "name" , "logo" , "status" ,"slug",  
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    // relation
    public function products(){
        return $this->hasMany(Product::class);
    }

    // local scop
    public function scopeActive($query){
        return $query->where('status',1);
    }
    public function scopeInactive($query){
        return $query->where('status',0);
    }

    // accessors مش بتتبطق غير لو  انا عملت اكسس ع الاتربيوت بشكل مباشر
    public function getCreatedAtAttribute($value){
        return date('d/m/Y h:i A',strtotime($value));
    }
    public function getLogoAttribute($logo){
        return 'uploads/brands/' . $logo;
    } 

    public function getStatus(){
        if(Config::get('app.locale') == 'ar'){
            return $this->status == 1 ? 'مفعل' : 'غير مفعل';
        }
        return $this->status == 1 ? 'Active' : 'Inactive'; 
    }
}
