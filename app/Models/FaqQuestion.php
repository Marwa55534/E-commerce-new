<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqQuestion extends Model
{
    protected $fillable = [
        "name" , "email" , "subject" , "message" 
    ];

    public function getCreatedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d/y/m H:i:s');
    }
}
