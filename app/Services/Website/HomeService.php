<?php

namespace App\Services\Website;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Brand;

class HomeService
{
    /**
     * Create a new class instance.
     */
    protected $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    public function getSliders(){
        return Slider::get();
    }

    // some Category , all categories
    public function getCategories($limit = null){
       if($limit == null){
        return Category::active()->get();
       }
       return Category::active()->limit($limit)->get(); 
    }

    // some Brand , all brands
    public function getBrands($limit = null){
        if($limit == null){
         return Brand::active()->get();
        }
        return Brand::active()->limit($limit)->get();
    }

    public function getProductsByBrand($slug){
        $brand_id = Brand::where('slug',$slug)->first()->id;

        return Product::with('images','brand','category')
        ->active()
        ->latest()
        ->where('brand_id',$brand_id)
        ->select('id','name','slug','price','has_discount','has_variants','category_id','brand_id','discount')
        ->paginate(2);
    }
 
    public function getProductsByCategory($slug){
       $category_id = Category::where('slug',$slug)->first()->id;

       return Product::with('images','brand','category')
       ->active()
       ->latest()
       ->where('category_id',$category_id)
       ->select('id','name','slug','price','has_discount','has_variants','category_id','brand_id','discount')
       ->paginate(2);
    }

    public function getHomePageProducts($limit = null){
        return [
            'newArrivals'=>$this->productService->newArrivalsProducts($limit),
            'flashProducts'=>$this->productService->getFlashProducts($limit),
            'flashProductsTimer'=>$this->productService->getFlashProductsTimer($limit),
        ];
    }
    // public function newArrivalsProducts($limit = null) {
    //     return $this->productService->newArrivalsProducts($limit); 
    // }

    // public function getFlashProducts($limit = null){
    //     return $this->productService->getFlashProducts($limit); 
    // }

    // public function getFlashProductsTimer($limit = null){
    //     return $this->productService->getFlashProductsTimer($limit); 
    // }

}
