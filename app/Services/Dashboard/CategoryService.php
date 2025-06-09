<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CategoryRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Utils\Image;
use Illuminate\Support\Facades\Cache;


class CategoryService
{
    /**
     * Create a new class instance.
     */
    protected $categoryRepository , $image;
    public function __construct(CategoryRepository $categoryRepository  , Image $image)
    {
        $this->categoryRepository = $categoryRepository; 
        $this->image = $image; 
    } 

    public function getAll(){
        $categories = $this->categoryRepository->getAll();

        return DataTables::of($categories)
        ->addIndexColumn()
        ->addColumn('name',function($category){
            return $category->getTranslation('name' , app()->getLocale());
        })
        // هعمل اوفر رايد اللي راجع من الداتا تيبل
        ->addColumn('status',function($category){ 
            return $category->getStatusTranslate();
        })
        ->addColumn('products_count', function ($category) {
            return $category->products_count == 0 ? __('dashboard.not_found') : $category->products_count;
        })
        ->addColumn('icon', function ($category) {
            return view('dashboard.categories.icon' , compact('category'));
        })
        ->addColumn('operations',function($category){
            return view('dashboard.categories.actions' , compact('category'));
        })
        ->make(true); // بترجع الداتا في هيئه اوبجكت
    }

    public function categoryById($id){
        return $this->categoryRepository->categoryById($id);
    }

    public function store($data){ 
        
        if(array_key_exists('icon',$data) && $data['icon'] != null){ // يعني فيه صوره 
            $file_name = $this->image->uploadSingleImage('/' , $data['icon'] , 'categories');
            $data['icon'] = $file_name;
        }
        $category = $this->categoryRepository->store($data);
        $this->categoryCache();
        return $category;
    }
    public function update($data){
        // select one
        // dd($data);
        $category = $this->categoryRepository->categoryById($data['id']);
        if(!$category){
            return false;
        }
        if(array_key_exists('icon',$data) && $data['icon'] != null){ // asset
            // Delete old icon if a new one is provided
            $this->image->deleteImageFromLocal($category->icon);

            $file_name = $this->image->uploadSingleImage('/' , $data['icon'],'categories');
            $data['icon'] = $file_name;
        }
        return $this->categoryRepository->update($category, $data);
    }

    public function delete($id){
        // select one
        $category = $this->categoryRepository->categoryById($id);
        if($category->icon != null){ // يعني فيه صوره 
            $this->image->deleteImageFromLocal($category->icon);
        }
        $category = $this->categoryRepository->delete($category);
        $this->categoryCache();
        return $category;
    }

    public function getCategoryExceptChildren($id){
        return $this->categoryRepository->getCategoryExceptChildren($id);
    }

    public function getParentCategory(){
        return $this->categoryRepository->getParentCategory();
    }

    public function categoryCache(){
        Cache::forget('categories_count');
    }
    
}
