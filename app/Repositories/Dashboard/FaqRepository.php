<?php

namespace App\Repositories\Dashboard;

use App\Models\Faq; 

class FaqRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAll(){
        $faqs = Faq::orderBy('id','desc')->get();
        return $faqs;
    }

    public function getFaq($id){
        $faq = Faq::find($id);
        return $faq;
    }

    public function store($data){
        $faq = Faq::create($data);
        return $faq;
    }

    public function update($data , $faq){
        $faq = $faq->update($data);
        return $faq;
    }

    public function delete($faq){
        return $faq->delete($faq);
    }
}
