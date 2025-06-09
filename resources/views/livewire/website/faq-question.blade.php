<div >
    <form wire:submit.prevent="submit" >
        <div class="question-section login-section " >
            <div class="review-form">
                <h5 class="comment-title">Have Any Question</h5>
                <div class=" account-inner-form">
                    <div class="review-form-name">
                        <label for="fname" class="form-label">Name*</label>
                        <input wire:model.live="name" type="text" id="fname" class="form-control" placeholder="Name">
                        @error('name')
                        <span class="text-danger" role="alert">{{ $message }}</span> 
                    @enderror
                    </div>
                    <div class="review-form-name">
                        <label for="email" class="form-label">Email*</label>
                        <input type="email" wire:model.live="email" id="email" class="form-control" placeholder="user@gmail.com">
                        @error('email')
                        <span class="text-danger" role="alert">{{ $message }}</span> 
                    @enderror
                    </div>
                    <div class="review-form-name">
                        <label for="subject" class="form-label">Subject*</label>
                        <input type="text" wire:model.live="subject" id="subject" class="form-control" placeholder="Subject">
                        @error('subject')
                        <span class="text-danger" role="alert">{{ $message }}</span> 
                    @enderror
                    </div>
                </div>
                <div class="review-textarea">
                    <label for="floatingTextarea">Massage*</label>
                    <textarea class="form-control" wire:model.live="message" placeholder="Write Massage..........." id="floatingTextarea"
                        rows="3"></textarea>
                        @error('message')
                        <span class="text-danger" role="alert">{{ $message }}</span> 
                    @enderror
                </div>
                <div class="login-btn">
                    <button type="submit"  class="shop-btn">Send Now</button>
                </div>
            </div>
        </div>
    </form>
</div>
  
