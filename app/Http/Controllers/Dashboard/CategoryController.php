<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\Dashboard\CategoryService;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller 
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService ) 
    {
        $this->categoryService = $categoryService;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.categories.index');
    }

    // yajra dataTable
    public function getAll(){
        return $this->categoryService->getAll();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getParentCategory();
        return view('dashboard.categories.createCategory' , compact('categories'));
        
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->only(['name','parent','status','icon']);
        $category = $this->categoryService->store($data);
        if(!$category){
            Session::flash('error',__('dashboard.error_msg'));
            return redirect()->back(); 
        }
        Session::flash('success',__('dashboard.success_msg'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    { 
        // بجيب الكاتحوري نفسه اللي انا هعمله ايديت
        $category = $this->categoryService->categoryById($id);

        // ماعدا ابناء الكاتجوري وماعدا الكاتحوري نفسه
        $categories = $this->categoryService->getCategoryExceptChildren($id);
        return view('dashboard.categories.editCategory' , compact('categories' , 'category'));

    }

    /**
     * Update the specified resource in storage.
    */
    public function update(CategoryRequest $request, string $id)
    {
        $data = $request->only(['name','parent','status' , 'icon','id']); // unput hidden id
        $category = $this->categoryService->update($data);  
        if(!$category){
            Session::flash('error',__('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success',__('dashboard.success_msg'));
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) 
    {
        $category = $this->categoryService->delete($id);
        if(! $category){
            return redirect()->back()->with('error',__('dashboard.error_msg') );
        }
        return redirect()->back()->with('success',__('dashboard.success_msg') );
    }
}
