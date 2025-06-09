<?php

namespace App\Repositories\Dashboard;

use App\Models\Brand;

class BrandRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAll(){
        $brands = Brand::withCount('products')->latest()->get();
        return $brands;
    }

    public function getBrand($id){
        $brand = Brand::find($id);
        return $brand;
    }

    public function store($data){
        $brand = Brand::create($data);
        return $brand;
    }

    public function update($data , $brand){ // id
        $brand = $brand->update($data);
        return $brand;
    }

    public function delete($brand){ // id
        return $brand->delete($brand);
    }
}
