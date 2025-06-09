<?php

namespace App\Services\Website;

use App\Models\Product;

class ProductService
{
    /**
     * Create a new class instance.
     */
    public function __construct() 
    {
        //
    }

    public function getProductBySlug($slug){
        return Product::with('images','brand','category','productPreviews')
        ->active()
        ->select('id','name','desc','small_desc','slug','price','sku','has_discount','has_variants','category_id','brand_id','discount')
        ->where('slug',$slug) 
        ->first();
    }
    
    public function getRelatedProductsBySlug($slug , $limit = null){
        $categoryId = Product::whereSlug($slug)->first()->category_id;
        $products =  Product::with('images','brand','category')
        ->active()
        ->whereCategoryId($categoryId)
        ->latest()
        ->select('id','name','slug','price','has_discount','has_variants','category_id','brand_id','discount');
        if($limit){
            return $products->paginate($limit);
        }
        return $products->paginate(30);
    }

    public function newArrivalsProducts($limit = null) {
        $products = Product::query()->with('images','brand','category')
        ->active()
        ->latest()
        ->select('id','name','slug','price','has_discount','has_variants','category_id','brand_id','discount');
        if($limit){
            return $products->paginate($limit);
        }
        return $products->paginate(30);
    }

    public function getFlashProducts($limit = null){
        $products =  Product::with('images','brand','category')
        ->active()
        ->where('has_discount',1)
        ->latest()
        ->select('id','name','slug','price','has_discount','has_variants','category_id','brand_id','discount');
        if($limit){
            return $products->paginate($limit);
        }
        return $products->paginate(30);
    }

    public function getFlashProductsTimer($limit = null){
        $products =  Product::with('images','brand','category')
        ->active()
        ->where('available_for',date('y-m-d'))->whereNotNull('available_for')
        ->where('has_discount',1)
        ->latest()
        ->select('id','name','slug','price','has_discount','has_variants','category_id','brand_id','discount');
        if($limit){
            return $products->paginate($limit);
        }
        return $products->paginate(30);
    }
}
