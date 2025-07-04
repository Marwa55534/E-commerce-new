<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory , HasTranslations;

    public $translatable = ['question','answer'];

    public $timestamps = false;

    protected $fillable = [
        "question" , "answer" 
    ];

}
