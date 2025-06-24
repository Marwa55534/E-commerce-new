<?php

namespace App\Livewire\Website;

use Livewire\Component;

class Review extends Component
{
    public $product;
    public $review;

    public function mount($product){

        $this->product = $product;
        $this->product->load('productPreviews');
        // dd($this->product);
    }

    public function submitPreview(){
        $this->validate([
            'review'=>'required|string|max:255'
        ]);

        $this->product->productPreviews()->create([
            'comment'=>$this->review,
            'user_id'=>auth('web')->user()->id,

        ]);
        $this->product->load('productPreviews');
        $this->reset('review');
        $this->dispatch('Reviewsubmitted','created successfully');

    }
    public function render()
    {
        return view('livewire.website.review');
    }
}
