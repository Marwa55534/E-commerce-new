<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Services\Website\HomeService;

class BrandController extends Controller
{
    protected $homeService;
    public function __construct(HomeService $homeService){
        $this->homeService = $homeService;
    }
    public function getBrands(){
        $brands = $this->homeService->getBrands();
        return view('website.brands',compact('brands'));
    }

    public function getProductsByBrand($slug){
        $products = $this->homeService->getProductsByBrand($slug); 
        return view('website.products',compact('products'));
    }
}
