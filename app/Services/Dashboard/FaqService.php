<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\FaqRepository;

class FaqService
{
    /**
     * Create a new class instance.
     */
    protected $faqRepository;
    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function getAll(){
       $faqs = $this->faqRepository->getAll();
       return $faqs;
    }

    public function getFaq($id){
        $faq = $this->faqRepository->getFaq($id);
        if(! $faq){
            abort(404);
        }
        return $faq;
    }

    public function store($data){
        $faq = $this->faqRepository->store($data);
        return $faq;
    }

    public function update($data , $id){
        $faq = $this->getFaq($id);
        return $this->faqRepository->update($data , $faq);
    }

    public function delete($id){
        $faq = $this->getFaq($id);
        return $this->faqRepository->delete($faq);
    }
}
