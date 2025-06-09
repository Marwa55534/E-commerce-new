<?php

namespace App\Repositories\Dashboard;

use App\Models\FaqQuestion;

class FaqQuestionRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct() 
    {
        //
    }

    public function index(){
        return FaqQuestion::latest()->get();
    }

    public function getFaqQuestion($id){
        return FaqQuestion::find($id);
    }

    public function delete($question){
        return $question->delete();
    }
}
