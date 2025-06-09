<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\BrandService;
use App\Http\Requests\BrandRequest;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }
    /**
     * Display a listing of the resource. 
     */
    public function index()
    {
        return view('dashboard.brands.index'); 
        
    }

    public function getAll(){
        return $this->brandService->getAll(); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.brands.createBrand'); 
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $data = $request->only(['name','status','logo']);
        $brand = $this->brandService->store($data);
        if(! $brand){ 
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
        $brand = $this->brandService->getBrand($id);
        return view('dashboard.brands.editBrand',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        $data = $request->only(['name','status','logo']);
        
        $brand = $this->brandService->update($data , $id); 
        if(! $brand){
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
        $brand = $this->brandService->delete($id); 
        if(! $brand){
            return redirect()->back()->with('error',__('dashboard.error_msg') );
        }
        return redirect()->back()->with('success',__('dashboard.success_msg') );
    }
}
