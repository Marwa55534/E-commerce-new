@extends('layouts.dashboard.app')

@section('title')
    {{ __('dashboard.products_show') }}
@endsection

@section('body')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.products_table') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">
                                        {{ __('dashboard.products') }}</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ $product->name }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                {{-- @include('dashboard.includes.button-header') --}}
            </div>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-md-11">
                    <div class="content-body">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-colored-form-control">
                                    {{ $product->name }}
                                </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Product Details -->
                                        <div class="col-md-6">
                                            <h3>{{ $product->name }}</h3>
                                            <p class="text-muted">{{ $product->small_desc }}</p>
                                            <p>{{ $product->desc }}</p>

                                            <!-- Price and Discount -->
                                            <div class="mt-2">
                                                @if ($product->has_variants)
                                                    <span class="badge badge-warning">{{ __('dashboard.has_variants') }}</span>
                                                @else
                                                    <h4>
                                                        <span class="text-danger">
                                                            ${{ $product->price }}
                                                        </span>
                                                        @if ($product->has_discount)
                                                            <small class="text-muted">
                                                                <del>${{ $product->price + $product->discount }}</del>
                                                            </small>
                                                        @endif
                                                    </h4>
                                                    @if ($product->manage_stock && !$product->has_variants )
                                                    <h4>
                                                        <span class="text-danger">
                                                            {{ $product->quantity }}
                                                        </span>
                                                    </h4>
                                                    @endif
                                                @endif
                                            </div>

                                            <!-- Availability -->
                                            <div class="mt-3">
                                                <p>
                                                    <i class="fa fa-calendar-check text-success"></i>
                                                        {{ __('dashboard.available_for') }}:
                                                    {{ $product->available_for ? $product->available_for : 'N/A' }}
                                                </p>
                                                <p>
                                                    <i class="fa fa-box text-primary"></i>
                                                    {{ __('dashboard.manage_stock') }}: {{ $product->available_in_stock ? 'Yes' : 'No' }}
                                                </p>
                                            </div>

                                            <!-- SKU -->
                                            <div>
                                                <p>
                                                    <i class="fa fa-barcode text-info"></i>
                                                    {{ __('dashboard.product_sku') }}:: {{ $product->sku }}
                                                </p>
                                            </div>

                                            <!-- Views -->
                                            <div>
                                                <p>
                                                    <i class="fa fa-eye text-secondary"></i>
                                                    {{ __('dashboard.views') }}: {{ $product->views }}
                                                </p>
                                            </div>

                                            <!-- Category and Brand relation-->
                                            <div class="mt-2">
                                                <p>
                                                    <i class="fa fa-tag text-warning"></i>
                                                    {{ __('dashboard.category') }}: {{ $product->category->name }}
                                                </p>
                                                <p>
                                                    <i class="fa fa-industry text-danger"></i>
                                                    {{ __('dashboard.brand') }}: {{ $product->brand->name }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Product Image -->
                                        <div class="col-md-6 text-center">
                                            <!-- Product Image Slider -->
                                            <div id="productImageSlider" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($product->images as $key => $image)
                                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                            <img src="{{ asset('uploads/products/' . $image->file_name) }}"
                                                                class="d-block w-100 rounded shadow-sm"
                                                                alt="{{ $product->name }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#productImageSlider" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#productImageSlider" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                            <div class="mt-3">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#fullscreenModal">
                                                    <i class="fa fa-expand"></i> View Fullscreen
                                                </button>
                                            </div>
                                        </div>


                                    </div>
                                     <!-- Variants Section -->
                            @if ($product->has_variants) 
                            <div class="mt-5">
                                <h4>{{ __('dashboard.Product_Variants') }}</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('dashboard.price') }}</th>
                                                <th>{{ __('dashboard.quantity') }}</th>
                                                <th>{{ __('dashboard.attributes') }}</th>
                                                <th>{{ __('dashboard.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- ProductVariant-> Stock , Price , product_id --}}
                                            @foreach ($product->variants as $variant) 
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>${{ $variant->price }}</td>
                                                <td>{{ $variant->stock }}</td>
                                                <td>
                                                    {{-- relation  VariantAttribute , attributeValue->value , Attribute->name --}}
                                                    @foreach ($variant->VariantAttributes as $variantAttribute)
                                                    <span class="badge badge-primary">
                                                        {{ $variantAttribute->attributeValue->attribute->name }}: {{ $variantAttribute->attributeValue->value }}
                                                    </span>
                                                    @endforeach
                                                </td>
                                                {{-- <td>
                                                    <a href="{{ route('products.variants.delete', $variant->id) }}" class="btn btn-danger btn-sm"><i class="la la-trash"></i></a>
                                                </td> --}}
                                                <td>
                                                    @if($product->variants->count() > 1) <!-- تحقق من عدد الـ variants -->
                                                        {{-- <a href="{{ route('products.variants.delete', $variant->id) }}" class="btn btn-danger btn-sm">
                                                            <i class="la la-trash"></i>
                                                        </a> --}}

                                                        <button class="delete_btn" variant-id="{{ $variant->id }}" type="button">{{ __('dashboard.delete') }}</button>
                                                        
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @else
                            <p class="text-muted">This product has no variants.</p>
                            @endif
                        </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-secondary">
                                    <i class="fa fa-edit"></i> Edit to Products
                                </a>

                                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i> Back to Products
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fullscreen Modal -->
    <div class="modal fade" id="fullscreenModal" tabindex="-1" role="dialog" aria-labelledby="fullscreenModalLabel" aria-hidden="true">
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

@endsection

@push('js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// delete product variant
$(document).on('click','.delete_btn',function(e){ 
    e.preventDefault();
    // var currentPage = $('#yajra_table').DataTable().page();
    var variant_id = $(this).attr('variant-id');

    Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    onfirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
}).then((result) => {
    if(result.isConfirmed){
        $.ajax({
            url: "{{ route('products.variants.delete',':variant_id') }}".replace(':variant_id',variant_id),
            type: "DELETE",
            data: {
                _token: "{{ csrf_token()}}" ,
            },
            success: function(data){
                if(data.status == 'success'){
                    Swal.fire({
                        title: data.status,
                        text: data.message,
                        icon: "success"
                    });
                    location.reload();
                    // $('#yajra_table').DataTable().ajax.reload();
                }else{
                    Swal.fire({
                        title: data.status,
                        text: data.message,
                        icon: "error"
                    });
                }
            },
        });
    }
});
});
</script>
@endpush