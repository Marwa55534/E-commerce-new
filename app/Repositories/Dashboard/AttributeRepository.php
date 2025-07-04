<?php

namespace App\Repositories\Dashboard;

use App\Models\Attribute;

class AttributeRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAll(){

        return Attribute::with('attributeValues')->get();   
    }

    public function getAttribute($id){
        
        return Attribute::with('attributeValues')->find($id); 
    }

    public function createAttribute($data){
        
        return Attribute::create([ 
            'name'=>$data['name'],
        ]); 
    }

    public function updateAttribute($attribute,$data){ 
        
        return $attribute->update([
            'name'=>$data['name'],
        ]);
    }

    public function deleteAttribute($attribute){
        
        return $attribute->delete();
    }
}
