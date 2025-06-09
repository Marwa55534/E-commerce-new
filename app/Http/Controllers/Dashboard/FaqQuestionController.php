<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Dashboard\FaqQuestionService;

class FaqQuestionController extends Controller
{
    protected $faqQuestionService;
    public function __construct(FaqQuestionService $faqQuestionService)
    {
        $this->faqQuestionService = $faqQuestionService;
    }

    public function index(){
        return view('dashboard.faq-question.index');
    }

    public function getAll(){
        return $this->faqQuestionService->getAll();
    }

    public function delete($id){
        $faqQuestion = $this->faqQuestionService->delete($id);  
        if(!$faqQuestion){
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
