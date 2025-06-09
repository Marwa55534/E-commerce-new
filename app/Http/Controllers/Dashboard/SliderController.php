<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\SliderService;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\SliderRequest;

class SliderController extends Controller
{
    protected $sliderService;
    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }
    public function index()
    {
        return view('dashboard.sliders.index'); 
    }

    public function getAll(){
        return $this->sliderService->getAll();  
    }

    public function store(SliderRequest $request)
    {
        $data = $request->only(['note','file_name']);
        // dd($data);

        $slider = $this->sliderService->createSlider($data);
        if(! $slider){
            Session::flash('error',__('dashboard.error_msg'));
            return redirect()->back();
        }
        Session::flash('success',__('dashboard.success_msg'));
        return redirect()->back(); 
    }

    public function destroy(string $id)
    {
        $slider = $this->sliderService->deleteSlider($id); 
        // dd($id);
        if(! $slider){
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg')
        ], 201);        
    }
}
