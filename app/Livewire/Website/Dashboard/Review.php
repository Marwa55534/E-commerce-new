<?php

namespace App\Livewire\Website\Dashboard;

use App\Models\ProductPreviews;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Review extends Component
{
    use WithPagination;

    protected $paginationThem = 'bootstrap' ;
     public $showModal = false;
    public $editReviewId;
    public $editReviewComment;
    public $screen = 'dashboard';
    public $auth_user;

    public function mount($auth_user){
        $this->auth_user = $auth_user;
    
    }

    #[On('reviewSelectScreen')] 
    public function selectScreen($screen){
        $this->screen = $screen;
    } 
 
    #[On('deleteReview')] 
    public function deleteReview($reviewId){
        ProductPreviews::find($reviewId)->delete();
        $this->dispatch('reviewDeleted','Preview deleted');
    }

    public function editReview($id){
        $review = ProductPreviews::find($id);
        $this->editReviewId = $review->id;
        $this->editReviewComment = $review->comment;
        $this->showModal = true;
    }

    public function updateReview(){
        $this->validate([
            'editReviewComment'=>'required|string|max:255'
        ]);

        $review = ProductPreviews::find($this->editReviewId);

        $review->update([
            'comment'=>$this->editReviewComment,
        ]);

        $this->showModal = false;
        $this->dispatch('reviewUpdated','Preview Updated');
    }

    public function render()
    {
        $reviews = $this->auth_user
            ->reviews()
            ->with('product')
            ->latest()
            ->paginate(4);

        return view('livewire.website.dashboard.review',compact('reviews'));
    } 
}
