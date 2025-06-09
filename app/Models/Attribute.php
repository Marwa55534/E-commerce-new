<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\AttributeValue;

class Attribute extends Model
{
    use HasTranslations;

    protected $table = 'attributes';
    public $translatable = ['name'];
    protected $fillable = [
        "name",  
    ];

    // relation
    public function attributeValues(){
        return $this->hasMany(AttributeValue::class);
    }

     // accessors مش بتتبطق غير لو  انا عملت اكسس ع الاتربيوت بشكل مباشر
    public function getCreatedAtAttribute($value){
        return date('d/m/Y h:i A',strtotime($value));
    }
}
