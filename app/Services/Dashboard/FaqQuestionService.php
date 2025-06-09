<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\FaqQuestionRepository;
use Yajra\DataTables\Facades\DataTables;

class FaqQuestionService
{
    /**
     * Create a new class instance.
     */ 
    protected $faqQuestionRepository;
    public function __construct(FaqQuestionRepository $faqQuestionRepository)
    {
        $this->faqQuestionRepository = $faqQuestionRepository;
    }

    public function index(){
        return $this->faqQuestionRepository->index();
    }

    public function getAll(){
        $faqQuestions = $this->index();

        return DataTables::of($faqQuestions)
        ->addIndexColumn()
        
        ->addColumn('message', function ($faqQuestion) {
            // return $page->getTranslation('content', app()->getLocale());
            return view('dashboard.faq-question.datatables.content', compact('faqQuestion'));
        })
        ->addColumn('action', function ($faqQuestion) {
            return view('dashboard.faq-question.datatables.actions', compact('faqQuestion'));
        })
        ->rawColumns(['action', 'image'])
        ->make(true);
    }

    public function delete($id){
        $faqQuestion = $this->faqQuestionRepository->getFaqQuestion($id);
        if(!$faqQuestion) {
            return false;
        }
        return $this->faqQuestionRepository->delete($faqQuestion);
    }
}
