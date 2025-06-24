<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $new_order_count = auth('web')
        ->user()
        ->orders()
        ->where('status','paid')
        ->count();

        $delivered_order_count = auth('web')
        ->user()
        ->orders()
        ->where('status','delivered')
        ->count();

        $auth_user = auth('web')->user()->load(['country','governorate','city']);

        return view('website.profile.index',[
            'auth_user'=>$auth_user,
            'new_order_count'=>$new_order_count,
            'delivered_order_count'=>$delivered_order_count,

        ]);
    }
}
