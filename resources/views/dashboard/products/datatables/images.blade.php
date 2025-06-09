<div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
      
        @foreach ($product->images as $key=>$image)
            <div class="carousel-item @if( $key == 0 ) active @endif">
                <img src="{{ asset('uploads/products/' . $image->file_name)}}" class="d-block w-100" alt="...">
            </div>
        @endforeach

    </div>
    <a href="#carouselExample" class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </a>
    <a href="#carouselExample" class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </a>
  </div>
  <div class="mt-1">
    <button class="btn btn-outline-primary" data-toggle="modal"
        data-target="#fullscreenModal_{{$product->id}}">
        <i class="fa fa-expand"></i> View Fullscreen
    </button>

   
    
</div>

<!-- Fullscreen Modal -->
<div class="modal fade" id="fullscreenModal_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="fullscreenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullscreenModalLabel">Fullscreen View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="fullscreenCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($product->images as $key => $image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ asset('uploads/products/'.$image->file_name) }}" class="d-block w-100" alt="Fullscreen Image">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#fullscreenCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#fullscreenCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                
                
            </div>
        </div>
    </div>
</div>


