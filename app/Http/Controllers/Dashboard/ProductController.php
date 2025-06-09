<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\AttributeService;
use Illuminate\Http\Request;
use App\Services\Dashboard\ProductService;
use App\Models\Brand;
use App\Models\Category;
use App\Services\Dashboard\CategoryService;
use App\Services\Dashboard\BrandService;
use App\Models\ProductVariant;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productService , $categoryService ,$brandService ,$attributeService;
    public function __construct(ProductService $productService ,BrandService $brandService ,CategoryService $categoryService,AttributeService $attributeService)
    {
        $this->productService = $productService;
        $this->brandService = $brandService;
        $this->categoryService = $categoryService;
        $this->attributeService = $attributeService;  

    } 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        return view('dashboard.products.index');  
        
    }

    public function getAll(){
        return $this->productService->getAll();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        // $brands = $this->brandService->getAll();
        // $categories = $this->categoryService->getAll();

        return view('dashboard.products.createProduct', compact('brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productService->getProduct($id);       
        return view('dashboard.products.showProduct', compact('product'));
    } 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productId = $id;
        $brands = Brand::all(); 
        $categories = Category::all();
        // $categories = $this->categoryService->getAll();  
        // $brands = $this->brandService->getAll(); 
        $attributes = $this->attributeService->getattributes();
        return view('dashboard.products.editProduct',compact('productId','categories','brands','attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) 
    {
        $product = $this->productService->deleteProduct($id);
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'), 
            ], 500);
        } 
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        ], 200);

    }

    public function changeStatus(Request $request){
        $product = $this->productService->changeStatus($request);
        if ($product) {
            return response()->json([
                'status' => 'success',
                'message' => __('dashboard.success_msg')
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => __('dashboard.error_msg'),
        ], 500);
    }
    public function deleteVariant($variant_id)
    {
        $variant = $this->productService->deleteVariant($variant_id); 
        if( $variant){
            return response()->json([
                'status' => 'success',
                'message' => __('dashboard.success_msg')   
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => __('dashboard.error_msg'),
        ], 500);
    }


}
