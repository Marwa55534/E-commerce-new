<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\AttributeService;
use App\Http\Requests\AttributeRequest;

class AttributeController extends Controller
{
    protected $attributeService;
    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.attributes.index'); 
    }

    public function getAll()
    {
        return $this->attributeService->getAll();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.attributes.createAttribute');  
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        $data = $request->except(['_token']);
        $attribute = $this->attributeService->createAttribute($data); 
        if(! $attribute){
            response()->json([ 
                'status'=>'error',
                'message' => __('dashboard.error_msg'),
            ],500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        ], 201);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeRequest $request, string $id)
    {
        $data = $request->except(['_token']);
        $attribute = $this->attributeService->updateAttribute($data, $id);  
        if(!$attribute){  
            response()->json([
                'status'=>'error',
                'message' => __('dashboard.error_msg'),
            ],500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        ], 201); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attribute = $this->attributeService->deleteAttribute($id);
        if(!$attribute){  
            response()->json([
                'status'=>'error',
                'message' => __('dashboard.error_msg'),
            ],500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        ], 201); 
       
    }
}
