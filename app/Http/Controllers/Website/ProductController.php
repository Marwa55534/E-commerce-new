<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Website\ProductService;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService) 
    { 
        $this->productService = $productService;
    }
    public function showProductPage($slug){
        $product = $this->productService->getProductBySlug($slug);
        if(!$product){
            abort(404);
        }
        $relatedProducts =$this->productService->getRelatedProductsBySlug($product->slug,4);
        return view('website.show',compact('product','relatedProducts'));
    }
    public function relatedProductsBySlug($productSlug){
        $relatedProducts =$this->productService->getRelatedProductsBySlug($productSlug);

        return view('website.products',[
            'products'=>$relatedProducts, 
            'flash_timer'=> false
        ]);

    }

    public function getProductsByType($type){
        // return $type;
        if($type == 'new-arrivals'){
            $products = $this->productService->newArrivalsProducts();
        }elseif($type =='flash-products'){
            $products = $this->productService->getFlashProducts();
        }elseif($type =='flash-timer'){
            $products = $this->productService->getFlashProductsTimer();
        }else{
            abort(404);
        }
        return view('website.products',[
            'products'=>$products,
            'flash_timer'=>$type == 'flash-timer' ? true : false
        ]);
    }
}
