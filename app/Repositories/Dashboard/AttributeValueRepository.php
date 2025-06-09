<?php

namespace App\Repositories\Dashboard;

use App\Models\AttributeValue;

class AttributeValueRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    { 
        //
    }

    
    public function getAll($attribute){
        // return AttributeValue::get();
        return $attribute->attributeValues()->get(); 
    }

    public function getAttributeValue($id){
        return AttributeValue::find($id);
    }

    public function createAttributeValue($attribute , $value){
        // relation
        return $attribute->attributeValues()->create([
            'value'=>$value,
        ]);
    }

    // public function updateAttributeValue($attribute,$key,$value){
    //     // relation
    //     return $attribute->attributeValues()->updateOrCreate( 
    //         ['id'=>$key],
    //         ['value'=>$value],
    //     );
        
    // }

    public function deleteAttributeValue($attribute){
        // relation
        return $attribute->attributeValues()->delete();
        
    }
}
