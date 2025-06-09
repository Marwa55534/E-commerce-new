<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPreviews extends Model
{
    protected $table = "product_previews"; 

    protected $fillable = [
        "comment" , "user_id" , "product_id" 
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
