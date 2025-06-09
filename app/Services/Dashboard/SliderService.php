<?php

namespace App\Services\Dashboard;

use App\Utils\Image;
use App\Repositories\Dashboard\SliderRepository;
use Yajra\DataTables\Facades\DataTables;

class SliderService
{
    /**
     * Create a new class instance.
     */
    protected $sliderRepository , $image;
    public function __construct(SliderRepository $sliderRepository , Image $image)
    {
        $this->sliderRepository = $sliderRepository;
        $this->image = $image;
    }

    public function getSliders(){
        return $this->sliderRepository->getSliders();
    }

    public function getAll(){
        $sliders = $this->sliderRepository->getSliders();

        return DataTables::of($sliders)
        ->addIndexColumn()
        ->addColumn('note', function ($slider) {
            return $slider->getTranslation('note', app()->getLocale());
        })
        ->addColumn('file_name', function ($slider) {
            return view('dashboard.sliders.datatables.image', compact('slider'));
        })
        ->addColumn('action', function ($slider) {
            return view('dashboard.sliders.datatables.actions', compact('slider'));
        })
        ->rawColumns(['action', 'file_name'])
        ->make(true);
    }

    public function getSlider($id){
        return $this->sliderRepository->getSlider($id);
    }

    public function createSlider($data){
        if(array_key_exists('file_name',$data) && $data['file_name'] != null){ // يعني فيه صوره 
            $file_name = $this->image->uploadSingleImage('/' , $data['file_name'] , 'sliders');
            $data['file_name'] = $file_name;
        }
        return $this->sliderRepository->createSlider($data);
    }

    public function deleteSlider($id){
        // select one
        $slider = $this->getSlider($id);
        if(!$slider) {
            return false;
        }
        // check if has file_name
        if($slider->file_name != null){ // يعني فيه صوره 
            $this->image->deleteImageFromLocal($slider->file_name);
        }
        return $this->sliderRepository->deleteSlider($slider);
    }
}
