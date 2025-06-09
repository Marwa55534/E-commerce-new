<?php

namespace App\Livewire\Website;

use Livewire\Component;
use App\Services\Website\FaqService;

class FaqQuestion extends Component
{
    // form propert
    public $name , $email , $subject , $message;

    protected $faqService;
    public function boot(FaqService $faqService){
        $this->faqService = $faqService;
    }
    
    // valid
    public function rules(){
        return [
            'name'=>['required' , 'min:2' , 'max:60'],
            'email'=>['required' , 'email' , 'max:100'],
            'subject'=>['required' , 'min:2' , 'max:1000'],
            'message'=>['required' , 'min:2' , 'max:1000'],
        ];
    }

    public function update(){
        $this->validate();
    }

    public function submit(){
        $this->validate();
        $data =[
            'name'=>$this->name,
            'email'=>$this->email,
            'subject'=>$this->subject,
            'message'=>$this->message,
        ];
        // dd($data);
        $faq = $this->faqService->getCreateQuestionFaq($data);
        if(!$faq){
            $this->dispatch('faq-question-failed','FAQ question creation failed');
        }
        $this->reset();
        $this->dispatch('faq-question-create','FAQ question created successfully');
    }
    public function render()
    {
        return view('livewire.website.faq-question'); 
    }
} 
