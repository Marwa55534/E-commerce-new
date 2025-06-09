<?php

namespace App\Repositories\Dashboard;

use App\Models\Category;

class CategoryRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAll(){
        $categories = Category::all();
        return $categories;
    }

    public function categoryById($id){
        $category = Category::find($id);
        return $category;
    }
    
    public function store($data){
        $category = Category::create($data); 
        return $category;
    }

    public function update($category, $data){  //id
        // select one
        $category = $category->update($data); 
        return $category;
    }

    public function delete($category){ // id
        // select one
        return $category->delete(); 
    }

    // هنحتجها ف ايديت
    public function getCategoryExceptChildren($id){
        $categories = Category::where('id' , '!=' , $id) // مش ترجع الكاتجوري اللي انا رايح اعدل عليه
        ->whereNull('parent') // لا يساوي null
        ->get();
        return $categories;
    }
    public function getParentCategory(){
        $categories =  Category::whereNull('parent')->get(); 
        return $categories;
    }
}


// الكاتيجوري عندنا هيكون ليه ابناء صح فمحتاج ان انا اخد له كل الكاتيجوري عشان لو عايز يغير الاب بتاع الكاتيجوري معين يغيره
// لكن في حاجه ايه هي انا محتاج اخد كل الكاتجوري معايا تمام
// ما عدا الكاتجوري نفسه اللي انا رايح اعدل عليه طيب دي اول نقطه
// 