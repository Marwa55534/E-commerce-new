<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
use Spatie\Translatable\HasTranslations;

class Role extends Model
{
    use HasTranslations; 
    protected $fillable = [
        "role" , "permession" 
    ];
    public $translatable = ['role'];

    // 1 : m
    public function admins(){
        return $this->hasMany(Admin::class);
    }

    public function getPermessionAttribute($permession){
        return json_decode($permession); 
    }
}
