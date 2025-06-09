<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations , HasFactory;
    public $timestamps = false;

    protected $translatable = [
        'site_name',
        'address',
        'site_desc',
        'meta_description',
    ];
    protected $fillable = [
        "site_name" , "site_desc", "email" , "email_support" , "phone" , "address" , "facebook" ,
        "twitter" , "youtupe" , "logo" , "favicon" ,"site_copyright" , "meta_description",
        "promotion_video_url" 

    ];

    // ass
    public function getLogoAttribute(){
        return 'uploads/settings/' . $this->attributes['logo'];
    }

    public function getFaviconAttribute(){
        return 'uploads/settings/' . $this->attributes['favicon'];
    }

    public function getPromotionVideoUrlAttribute($value){
        return $this->convertEmbedUrl($value);
    }
    public function convertEmbedUrl($url){
        if(strpos($url,'watch?v=') !== false){
            return str_replace('watch?v=','embed/',$url);
        }
        return $url;
    }
}
