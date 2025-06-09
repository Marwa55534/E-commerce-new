<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\BrandRepository;
use Laravel\Sail\Console\AddCommand;
use Yajra\DataTables\Facades\DataTables;
use App\Utils\Image;
use Illuminate\Support\Facades\Cache;

class BrandService
{
    protected $brandRepository , $image;
    /**
     * Create a new class instance.
     */
    public function __construct(BrandRepository $brandRepository , Image $image)
    {
        $this->brandRepository = $brandRepository;
        $this->image = $image;

    }

    public function getAll(){
        $brands = $this->brandRepository->getAll();

        return DataTables::of($brands)
        ->addIndexColumn()
        ->addColumn('status', function ($brand) { 
            return $brand->getStatus();
        })
        ->addColumn('name', function ($brand) {
            return $brand->getTranslation('name', app()->getLocale());
        })
        ->addColumn('logo', function ($brand) {
            return view('dashboard.brands.datatables.logo', compact('brand'));
        })
        ->addColumn('products_count', function ($brand) {
            return $brand->products_count == 0 ? __('dashboard.not_found') : $brand->products_count;
        })
        ->addColumn('action', function ($brand) {
            return view('dashboard.brands.datatables.actions', compact('brand'));
        })
        ->rawColumns(['action', 'logo'])
        ->make(true);
    }

    public function getBrand($id){
        $brand = $this->brandRepository->getBrand($id);
        if(! $brand){
            abort(404);
        }
        return $brand;
    }

    public function store($data){ // data []
        // name , logo , status
       if(array_key_exists('logo',$data) && $data['logo'] != null){ // يعني فيه صوره 
            $file_name = $this->image->uploadSingleImage('/' , $data['logo'] , 'brands');
            $data['logo'] = $file_name;
        }
        $brand = $this->brandRepository->store($data);
        $this->brandCache();
        return $brand; 
    }

    public function update($data , $id){ 
        // select one
        $brand = $this->getBrand($id); 

        // تحقق من وجود "الشعار" في مصفوفة البيانات
        if(array_key_exists('logo',$data) && $data['logo'] != null){ // asset
            // Delete old logo if a new one is provided
            $this->image->deleteImageFromLocal($brand->logo);

            $file_name = $this->image->uploadSingleImage('/' , $data['logo'],'brands');
            $data['logo'] = $file_name;
        }
        return $this->brandRepository->update($data , $brand);
    }

    public function delete($id){ 
        // select one
        $brand = $this->getBrand($id); 

        // check if has logo
        if($brand->logo != null){ // يعني فيه صوره 
            $this->image->deleteImageFromLocal($brand->logo);
        }
        $brand = $this->brandRepository->delete($brand);
        $this->brandCache();
        return $brand;
        
    }

    public function brandCache(){
        Cache::forget('brands_count');
    }
}


 