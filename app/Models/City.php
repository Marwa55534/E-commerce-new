<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Governorate;

class City extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    public $timestamps = false;
    
    protected $fillable = [
        "name" , "governorate_id"
    ];

    public function governorate(){
        return $this->belongsTo(Governorate::class);
    }
}
