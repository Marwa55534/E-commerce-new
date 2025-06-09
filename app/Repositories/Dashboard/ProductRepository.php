<?php

namespace App\Repositories\Dashboard;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\VariantAttribute;

class ProductRepository
{
    /**
     * Create a new class instance.
     */
  
    public function getProduct($id){
        $product = Product::find($id);
        return $product;
    }

    public function getProductEgarLoading($id){
        $product = Product::with(['variants.VariantAttributes'])->find($id);
        return $product;

    }
 
    public function getAll(){
        return Product::latest()->get();
        // return $products;
    }

    public function createProduct($data){
        $product = Product::create($data);
        return $product;
    }

    public function createProductVariant($data){
        return ProductVariant::create($data);
    }

    public function createVariantAttribute($data){
        return VariantAttribute::create($data);
    }

    public function updateProduct($product ,$data){
        return $product->update($data);
    }

    public function deleteProduct($product){
        return $product->delete();
    }

    public function changeStatus($product, $status)
    {
        $product->status = $status;
        return $product->save(); 
    }

    public function deleteProductVariants($productId){
        return ProductVariant::where('product_id',$productId)->delete();
    }

    public function getVariant($id)
    {
        $variant = ProductVariant::find($id);
       return $variant;
    }

    public function deleteVariant($variant)
    {
        return $variant->delete();
    }

    public function deleteProductImage($imageId){
        return ProductImage::find($imageId)->delete();
    }


}
