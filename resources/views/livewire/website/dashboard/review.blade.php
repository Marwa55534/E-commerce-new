<div>
    @if ($screen == 'reviews')
        <div class="tab-pane fade @if($screen == 'reviews') show active @endif">
            <div class="top-selling-section">
                <div class="row g-5">
                    @if ($reviews->count() > 0)
                        @foreach ($reviews as $review)
                            <div class="col-md-6">
                                <div class="product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('uploads/products/' . $review->product->images->first()->file_name)}}"
                                            alt="product-img">
                                    </div>
                                    <div class="product-info">
                                        <div class="review-date">
                                            <p>{{$review->created_at->diffForHumans()}}</p>
                                        </div>
                                        <div class="ratings">
                                            <span>
                                                <svg width="75" height="15" viewBox="0 0 75 15" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z"
                                                        fill="#FFA800" />
                                                    <path
                                                        d="M22.5 0L24.1839 5.18237H29.6329L25.2245 8.38525L26.9084 13.5676L22.5 10.3647L18.0916 13.5676L19.7755 8.38525L15.3671 5.18237H20.8161L22.5 0Z"
                                                        fill="#FFA800" />
                                                    <path
                                                        d="M37.5 0L39.1839 5.18237H44.6329L40.2245 8.38525L41.9084 13.5676L37.5 10.3647L33.0916 13.5676L34.7755 8.38525L30.3671 5.18237H35.8161L37.5 0Z"
                                                        fill="#FFA800" />
                                                    <path
                                                        d="M52.5 0L54.1839 5.18237H59.6329L55.2245 8.38525L56.9084 13.5676L52.5 10.3647L48.0916 13.5676L49.7755 8.38525L45.3671 5.18237H50.8161L52.5 0Z"
                                                        fill="#FFA800" />
                                                    <path
                                                        d="M67.5 0L69.1839 5.18237H74.6329L70.2245 8.38525L71.9084 13.5676L67.5 10.3647L63.0916 13.5676L64.7755 8.38525L60.3671 5.18237H65.8161L67.5 0Z"
                                                        fill="#FFA800" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="product-description">
                                            <a href="{{route('website.products.show' , $review->product->slug)}}" class="product-details">{{$review->product->name}}</a>
                                            <p>{{$review->comment}}</p>
                                        </div>
                                    </div>
                                    <div class="product-cart-btn">
                                        <a href="" wire:click.prevent="editReview({{$review->id}})" class="product-btn">Edit Review</a>
                                        <a href="" data-id={{$review->id}} class="product-btn delete-review">delete Review</a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $reviews->links()}}
                    @else
                        {{-- Empty --}}
                        <section class="blog about-blog footer-padding">
                            <div class="container">
                                <div class="blog-item" data-aos="fade-up">
                                    <div class="cart-img">
                                        <img src="{{ asset('assets/website/assets')}}/images/homepage-one/empty-wishlist.webp"
                                            alt>
                                    </div>
                                    <div class="cart-content">
                                        <p class="content-title">Empty! You don’t Cart any Products </p>
                                        <a href="product-sidebar.html" class="shop-btn">Back to Shop</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif

                </div>
            </div>
        </div>

    @endif
 
    @if ($showModal)
        <div class="modal fade show d-block" tabinbox="-1" style="background-color: rgbe(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">edit Review</h5>
                        <button type="button" class="btn-close" wire:click="$set('showModal' , false)"></button>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" wire:model="editReviewComment" rows="4"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" wire:click="$set('showModal' , false)">Close</button>
                        <button  class="btn btn-primary" wire:click="updateReview">Save change</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>


@script
<script>
    // lisnting
    $wire.on('reviewUpdated', (event) => {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: event,
            showConfirmButton: false,
            timer: 1500
        });
    });


      
$(document).on('click', '.delete-review',function(e) {
    e.preventDefault();
    
    var review_id = $(this).attr('data-id');

    Swal.fire({ 
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        onfirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
           $wire.dispatch('deleteReview' , {
            reviewId : review_id
           });
        }
    });
});

$wire.on('reviewDeleted', (event) => {
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