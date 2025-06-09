<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\AttributeRepository;
use App\Repositories\Dashboard\AttributeValueRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AttributeService
{
    /**
     * Create a new class instance.
     */
    protected $attributeRepository , $attributeValueRepository;
    public function __construct(AttributeRepository $attributeRepository , AttributeValueRepository $attributeValueRepository)
    {
        $this->attributeRepository = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
    }

    public function getattributes(){
        return $this->attributeRepository->getAll();
    }

    public function getAll(){
        $attributes = $this->attributeRepository->getAll();

        return DataTables::of($attributes) 

        ->addIndexColumn()
        ->addColumn('name', function ($attribute) {  
            return $attribute->getTranslation('name', app()->getLocale());
        })
        ->addColumn('attributeValues', function ($attribute) {  
            return view('dashboard.attributes.datatables.attribute-values', compact('attribute'));
        }) 
        ->addColumn('action', function ($attribute) {
            return view('dashboard.attributes.datatables.actions', compact('attribute'));
        })
        ->make(true); 
    }

    public function getAttribute($id){
        $attribute = $this->attributeRepository->getAttribute($id);
        if(! $attribute){
            abort(404);
        }
        return $attribute;
    }

    public function createAttribute($data){ 
        try{
            DB::beginTransaction();
             // create attribute name
            $attribute = $this->attributeRepository->createAttribute($data);

            // create value
            foreach($data['value'] as $value){ 
                $this->attributeValueRepository->createAttributeValue($attribute , $value);
            }
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            // Log::error('error attributes' , $e->getMessage()); 
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function updateAttribute($data,$id){ 
        try{
            DB::beginTransaction();
            // select one
            $attribute = $this->getAttribute($id); 

            // update attribute name
             $this->attributeRepository->updateAttribute($attribute,$data); // name
       
            // delete Attribute Value
            $this->attributeValueRepository->deleteAttributeValue($attribute);
            // create value
            foreach ($data['value'] as $value) { 
                $this->attributeValueRepository->createAttributeValue($attribute,$value);   
            }

            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            // dd($e->getMessage());
            // Log::error('Error creating attribute: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error',$e->getMessage());
            // return false;
        }

    }

    public function deleteAttribute($id){
        $attribute = $this->getAttribute($id); 
        if(!$attribute){
            abort(404);
        }
        return $this->attributeRepository->deleteAttribute($attribute); 

    }
}
