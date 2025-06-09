<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasTranslations;
    protected $translatable = ['note'];
    protected $fillable = [
        "file_name" , "note" 
    ];

     // accessors مش بتتبطق غير لو  انا عملت اكسس ع الاتربيوت بشكل مباشر
     public function getCreatedAtAttribute(){
        return date('d/m/Y h:i a',strtotime($this->attributes['created_at']));
    }
    public function getFileNameAttribute($file_name){
        return 'uploads/sliders/' . $file_name;
    } 
}
