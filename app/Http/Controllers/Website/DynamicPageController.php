<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class DynamicPageController extends Controller
{
    public function showDynamicPage($slug){
        $page = Page::where('slug',$slug)->first();
        if(!$page){
            abort(404);
        }
        return view('website.dynamic-page',compact('page'));
    }
}
