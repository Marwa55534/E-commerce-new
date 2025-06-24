<div>
    <form wire:submit="submitContactForm">
        <div class="question-section login-section">
        <div class="review-form">
            <h5 class="comment-title">Get In Touch</h5>
            <div class="account-inner-form">
                <div class="review-form-name">
                    <label for="fname" class="form-label">Name*</label>
                    <input type="text" wire:model.live="name" id="fname" class="form-control" placeholder="Name" />
                </div>
                <div class="review-form-name">
                    <label for="email" class="form-label">Email*</label>
                    <input type="email" wire:model.live="email" id="email" class="form-control" placeholder="user@gmail.com" />
                </div>
                <div class="review-form-name">
                    <label for="subject" class="form-label">Subject*</label>
                    <input type="text" wire:model.live="subject" id="subject" class="form-control" placeholder="Subject" />
                </div>
                <div class="review-form-name">
                    <label for="phone" class="form-label">phone*</label>
                    <input type="number" wire:model.live="phone" id="phone" class="form-control" placeholder="phone" />
                </div>
            </div>
            <div class="review-textarea">
                <label for="floatingTextarea">Massage*</label>
                <textarea class="form-control"  wire:model.live="message" placeholder="Write Massage..........." id="floatingTextarea"
                    rows="3"></textarea>
            </div>
            <div class="login-btn">
                <button  type="submit" class="shop-btn">Send Now</button>
            </div>
        </div>
    </div>
    </form>
</div>

@script
<script>
    $wire.on('contact-form-submit', (event) => {
        Swal.fire({ 
            position: "top-center",
            icon: "success",
            title: event,
            showConfirmButton: false,
            timer: 1500
        }); 
    });
</script>
@endscript 
