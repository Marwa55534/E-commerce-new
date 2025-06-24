<div class="product-review-section" data-aos="fade-up">
        <h5 class="intro-heading">Reviews</h5>
        <div class="review-wrapper">

            @auth('web')
                <label for="review" class="mb-2">write Preview</label>
                <input wire:model="review" id="review" style="height: 40px" class="form-control me-2" type="text"
                    placeholder="write_a_Preview" style="flex: 1;"><br>
                
                <div class="d-flex mb-4">
                     <button wire:click="submitPreview" type="button" class="btn btn-primary">
                       Submit
                     
                    </button>
                </div>
            @endauth

            @forelse ($product->productPreviews as $preview)
                <div class="wrapper">
                    <div class="wrapper-aurthor">
                        <div class="wrapper-info">
                            <div class="aurthor-img">
                                <img src="{{ asset('assets/website/assets/images/homepage-one/aurthor-img-1.webp')}}"
                                    alt="aurthor-img">
                            </div>
                            <div class="author-details">
                                <h5>{{$preview->user->name}}</h5>
                                <p>{{$preview->user->country->name}},{{$preview->user->city->name}}</p>
                            </div>
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
                            <span>(5.0)</span>
                        </div>

                    </div>
                    <div class="wrapper-description">
                        <p class="wrapper-details">{{$preview->comment}}</p>
                    </div>
                </div>
            @empty
                <p class="text-muted">no comment</p>
            @endforelse

        </div>
</div>

@script
<script>
    // lisnting
    $wire.on('Reviewsubmitted', (event) => {
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