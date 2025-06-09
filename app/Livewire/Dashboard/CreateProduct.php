<?php

namespace App\Livewire\Dashboard;

use App\Models\ProductVariant;
use App\Utils\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\VariantAttribute;
use App\Services\Dashboard\ProductService;

class CreateProduct extends Component
{
    use WithFileUploads;
    public $currentStep =1;
    public $brands , $categories; 
    public $successMessage = '';
    public $fullscreenImage = '';

    public $name_ar , $name_en , $small_desc_ar , $small_desc_en ,$desc_ar , $desc_en , $sku;
    public $price , $discount , $start_discount , $end_discount;
    public $quantity , $tags , $images , $available_for , $category_id , $brand_id;
    public $has_variants = 0, $manage_stock = 0, $has_discount = 0;
    public $prices = [], $quantities = [], $attributeValues = [];
    public $valueRowCount = 1;

    // protected ProductService $productService;
    // public function boot(ProductService $productService)
    // {
    //     $this->productService = $productService;
    // }

    public function mount($brands,$categories){
        $this->brands = $brands;
        $this->categories = $categories;
    }
    public function render()
    {
        $attributes = Attribute::with('attributeValues')->get();
        return view('livewire.dashboard.create-product',compact('attributes'));
    }


    public function firstStepSubmit(){
        $this->validate([
            'name_ar'=> ['required', 'string', 'max:80'],
            'name_en'=> ['required', 'string', 'max:80'],
            'desc_ar'=> ['required', 'string', 'max:1000'],
            'desc_en'=> ['required', 'string', 'max:1000'],
            'small_desc_ar'=> ['required', 'string', 'max:150'],
            'small_desc_en'=> ['required', 'string', 'max:150'],
            'sku'=> ['required', 'string', 'max:30'],
            'category_id'=> ['required', 'exists:categories,id'],
            'brand_id'=> ['required', 'exists:brands,id'],
            'available_for'=> ['required', 'date'],
            'tags'=>  ['required', 'string'],
        ]);
        $this->currentStep = 2;
    }

    public function secondStepSubmit(){

        $data = [
            'has_variants'  => ['required', 'in:1,0'],
            'manage_stock'  => ['required', 'in:0,1'],
            'has_discount'  => ['required', 'in:1,0'],
        ];
        if ($this->has_variants == 0) {
            $data['price'] = ['required', 'numeric', 'min:1', 'max:1000000'];
        }
        if ($this->manage_stock == 1 && $this->has_variants == 0) {
            $data['quantity'] = ['required', 'min:1', 'max:1000000'];
        }
        if ($this->has_discount == 1) {
            $data['discount'] = ['required', 'numeric', 'min:1', 'max:100'];
            $data['start_discount'] = ['date', 'before:end_discount'];
            $data['end_discount']  = ['date', 'after:start_discount']; 
        }
        if ($this->has_variants == 1) {
            $data['prices'] = 'required|array|min:1';
            $data['prices.*'] = 'required|numeric|min:1|max:1000000';
            $data['quantities'] = 'required|array|min:1';
            $data['quantities.*'] = 'required|integer|min:0';
            $data['attributeValues'] = 'required|array|min:1';
            $data['attributeValues.*'] = 'required|array';
            $data['attributeValues.*.*'] = 'required|integer|exists:attribute_values,id';
        }

        $this->validate($data);
        $this->currentStep = 3;
    }
    public function addNewVariant()
    {
        $this->prices[] = null;
        $this->quantities[] = null; 
        $this->attributeValues[] = [];
        $this->valueRowCount = count($this->prices); // Keep count synchronized
    }

    public function removeVariant()
    {
        if ($this->valueRowCount > 1) {
            $this->valueRowCount--;
            array_pop($this->prices);
            array_pop($this->quantities);
            array_pop($this->attributeValues);
        }
    }

    public function thirdStepSubmit()
    {
        $this->validate([
            'images' => ['required', 'array'],
            'images.*' => ['mimes:png,jpeg,jpg', 'max:1024'],
        ]);
        $this->currentStep = 4;
    }

    public function deleteImage($key){
        unset($this->images[$key]);
    } 

    public function submitForm(){
        $product = Product::create([
            'name' => ['ar' => $this->name_ar, 'en' => $this->name_en],
            'desc' => ['ar' => $this->desc_ar, 'en' => $this->desc_en],
            'small_desc' =>  ['ar' => $this->small_desc_ar, 'en' => $this->small_desc_en],
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'sku' => $this->sku, 
            'available_for' => $this->available_for,
            'has_variants'=>$this->has_variants,
            'price'=> $this->has_variants == 1 ? null : $this->price,
            'manage_stock'=>$this->has_variants == 1 ? 1 : $this->manage_stock,
            'quantity' => $this->manage_stock == 0 ? null : $this->quantity,
            'has_discount'=>$this->has_discount,
            'discount'=> $this->has_discount == 0 ? null : $this->discount,
            'start_discount'=> $this->has_discount == 0 ? null : $this->start_discount,
            'end_discount'=> $this->has_discount == 0 ? null : $this->end_discount,
        ]);

        // store has_variants
        if($this->has_variants){
            foreach ($this->prices as $index => $price) { // []
                $productVariants = ProductVariant::create([
                    'product_id'=>$product->id,
                    'price'=>$price,
                    'stock'=>$this->quantities[$index] ?? 0 ,
                ]);
                // create Variant Attributes
                foreach ($this->attributeValues[$index] as $attributeValueId) {
                    VariantAttribute::create([
                        'product_variant_id'=>$productVariants->id,
                        'attribute_value_id'=>$attributeValueId,
                    ]);
                }
            }
        }

        // strore product images
        $image = new Image;
        $image->uploadImages($this->images,$product,'products');

        $this->successMessage = __('dashboard.success_msg');
        // $this->reset();
        $this->reset(['name_ar', 'name_en', 'desc_ar', 'desc_en', 'small_desc_ar', 'small_desc_en', 'category_id', 'brand_id', 'sku', 'available_for', 'has_variants', 'price', 'manage_stock', 'quantity', 'has_discount', 'discount', 'start_discount', 'end_discount', 'images','tags']);
        $this->currentStep = 1;
    }


    public function openFullscreen($key){
        $this->fullscreenImage = $this->images[$key]->temporaryUrl();
        $this->dispatch('showFullscreenModal');
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }
    

    

}
// php artisan make:livewire Dashboard/CreateProduct