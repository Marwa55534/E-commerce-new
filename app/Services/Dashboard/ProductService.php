<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\ProductRepository;
use App\Utils\Image;
use Yajra\DataTables\Facades\DataTables;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * Create a new class instance.
     */
    protected $productRepository , $image;
    public function __construct(ProductRepository $productRepository , Image $image)
    {
        $this->productRepository = $productRepository;
        $this->image = $image;
    }

    public function getProduct($id){
        $product = $this->productRepository->getProduct($id);
        return $product ?? abort(404); 
    }

    public function getProductEgarLoading($id){
        $product = $this->productRepository->getProductEgarLoading($id);
        return $product ?? abort(404); 

    }

    public function getAll(){

        $products = $this->productRepository->getAll();
        return DataTables::of($products)

            ->addIndexColumn()
            ->addColumn('name' , function($product){
                return $product->getTranslation('name' , app()->getLocale());
            })
            ->addColumn('has_variants' , function($product){
                return $product->hasVariantsTranslated();
            })
            ->addColumn('images', function($product){
                $product->load('images');
                return view('dashboard.products.datatables.images' , compact('product'));
            })
            ->addColumn('status' , function($product){
                return $product->getStatusTranslated();
            })
            ->addColumn('category' , function($product){ // relation
                return $product->category->name;
            })
            ->addColumn('brand' , function($product){ // relation
                return $product->brand->name;
            })
            ->addColumn('price' , function($product){ // relation
                return $product->priceAttribute();
            })
            ->addColumn('quantity' , function($product){ // relation
                return $product->quantityAttribute();
            })
            ->addColumn('action', function ($product) {
                return view('dashboard.products.datatables.actions' , compact('product'));
            })

        ->make(true);
    } 

    public function updateProductWithDetails($product , $productData , $productVariant , $images)
    {
        try {
            DB::beginTransaction();
             // update Product simple
            $productStatus = $this->productRepository->updateProduct($product,$productData);
            if(! $productStatus){
                return false;
            }
            // delete old Variants
            $this->productRepository->deleteProductVariants($product->id);

        // update Product new Variant 
        foreach($productVariant as $variant){
            $productVariant = $this->productRepository->createProductVariant($variant);
            if(! $productVariant){
                return false;
            }
            // create Variant Attributes
            foreach($variant['attriubte_value_ids'] as $attribute_value_id){
                $variantAttribute = $this->productRepository->createVariantAttribute([
                    'product_variant_id' => $productVariant->id,
                    'attribute_value_id' => $attribute_value_id,
                ]);
                if(! $variantAttribute){
                    return false;
                }
            }
        } 

        // create Product Images
        // $this->image->uploadImages($images , $product , 'products');

            if (is_array($images) || is_object($images)) {
                $this->image->uploadImages($images, $product, 'products');
            }
            DB::commit();
            return true; 

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('update product with details error' . $e->getMessage());
            return false;
        }

    }
   
    public function updateProduct($id ,$data){
        $product = $this->getProduct($id);
        return $this->productRepository->updateProduct($product,$data);
    }

    public function deleteProduct($id){
        $product = $this->getProduct($id);  // select one
        return $this->productRepository->deleteProduct($product);
    }

    public function changeStatus($request)
    {
        $product = $this->getProduct($request->id); // select one
        $product->status == 1 ? $status = 0 : $status = 1;
        return $this->productRepository->changeStatus($product, $status);
    }
    public function getVariant($id)
    {
        return $this->productRepository->getVariant($id);
    }

    public function deleteVariant($id)
    {
        $variant = $this->getVariant($id);
        $product = $variant->product;  
        if($product->variants->count() == 1){
            return false;
        }
        return $this->productRepository->deleteVariant($variant);
    }

    public function deleteProductImage($imageId,$file_name){  
        // delete imafe from local
         $this->image->deleteImageFromLocal('uploads/products/'.$file_name);
        return $this->productRepository->deleteProductImage($imageId); // delete db

    }

    
}
