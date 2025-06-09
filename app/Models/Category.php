<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Config;
use App\Models\Product;

class Category extends Model
{
    use Sluggable ;

    use HasTranslations;
    protected $translatable = ['name'];
    protected $fillable = [
        "name" , "parent" , "status" , "slug", "icon",
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
  
    public function getStatusTranslate(){
        if(Config::get('app.locale') == 'ar'){
            return $this->status == 1 ? 'مفعل' : 'غير مفعل';
        }
        return $this->status == 1 ? 'Active' : 'Inactive';
    }

    // local scope
    public function scopeActive($query){
        return $query->where('status',1);
    }
    public function scopeInactive($query){
        return $query->where('status',0);
    }

    // acssoss
    public function getCreatedAtAttribute($value){
      return date('d/m/Y h:i A',strtotime($value));

    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    // الكاتجوري مممكن يكون ليها اكتر من كاتجوري فرعي 
    // والكاتجوري الفرعي بينمتي الي كاتجوري رئيسي

    public function children(){
        return $this->hasMany(Category::class , 'parent');
    }

    public function parent(){
        return $this->belongsTo(Category::class , 'parent');
    }

    public function getIconAttribute($icon){
        return 'uploads/categories/' . $icon;
    } 
}
