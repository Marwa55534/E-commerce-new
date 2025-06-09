<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Translatable\HasTranslations;
class Page extends Model
{
    use Sluggable , HasTranslations;

    public $translatable = ['title','content'];
    protected $fillable = [
        "title" , "slug" , "content" ,"image",  
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getCreatedAtAttribute($value){
        return date('d/m/Y h:i A',strtotime($value));
    }

    // public function getImageAttribute($value){
    //     return asset('uploads/pages/' . $value);
    // } 
}
