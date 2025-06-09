<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        "payment_method" , "transaction_id" , "order_id" ,"user_id"

    ];
}
