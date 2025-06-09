<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\PageService;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PageRequest;

class PageController extends Controller
{
    protected $pageService;
    public function __construct(PageService $pageService )
    {
        $this->pageService = $pageService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pages.index'); 
    }

    public function getAll(){
        return $this->pageService->getAll();  
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.create'); 
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $data = request()->only(['title','image','content']); 
        $page = $this->pageService->createPage($data);  
        if(!$page){
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
        $page = $this->pageService->getPage($id) ?? abort(404);
        return view('dashboard.pages.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, string $id)
    {
        $data = request()->only(['title','image','content']);
        $page = $this->pageService->updatePage($data,$id);
        if(!$page){
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
        $page = $this->pageService->deletePage($id);  
        if(!$page){
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        ], 201);        
    } 
    public function deleteImage($id)
    {
        $page = $this->pageService->deleteImage($id);   
        if(!$page){
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        ], 201);  
    }
}
