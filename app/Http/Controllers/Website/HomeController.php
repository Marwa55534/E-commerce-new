<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Services\Website\HomeService;

class HomeController extends Controller
{
    protected $homeService;
    public function __construct(HomeService $homeService){
        $this->homeService = $homeService;
    }
    public function index(){
        $sliders = $this->homeService->getSliders();
        $someCategories = $this->homeService->getCategories(12);
        $someBrands = $this->homeService->getBrands(12); 
        $homePageProducts = $this->homeService->getHomePageProducts(12); 

        // $newArrivals = $this->homeService->newArrivalsProducts(8);  
        // $flashProducts = $this->homeService->getFlashProducts(8);  
        // $flashProductsTimer = $this->homeService->getFlashProductsTimer(8);    

        // return date('y-m-d');
        return view('website.index',compact('sliders','someCategories','someBrands','homePageProducts')); 
    }
}
