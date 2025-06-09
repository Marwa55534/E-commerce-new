@extends('layouts.dashboard.app')

@section('title')
    {{ __('dashboard.products') }}
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
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">
                                        {{ __('dashboard.products') }}</a>
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
                                    {{ __('dashboard.products') }}
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

                                    {{-- create product modal --}}
                                    <a href="{{route('products.create')}}" class="btn btn-outline-success mb-1">
                                        {{ __('dashboard.create_product') }}
                                    </a>

                                    {{-- <p class="card-text">{{ __('dashboard.table_yajra_paragraph') }}.</p> --}}
                                    <p class="card-text">As well as being able to pass language information to DataTables
                                        through the language initialization option, you can also store
                                        the language information in a file, which DataTables can load
                                        by Ajax using the language.url option.</p>
                                    <table id="yajra_table" class="table table-striped table-bordered language-file">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('dashboard.product_name') }}</th>
                                                <th>{{ __('dashboard.has_variants') }}</th>
                                                <th>{{ __('dashboard.product_images') }}</th>
                                                <th>{{ __('dashboard.status') }}</th>
                                                <th>{{ __('dashboard.product_sku') }}</th>
                                                <th>{{ __('dashboard.available_for') }}</th>
                                                <th>{{ __('dashboard.category') }}</th>
                                                <th>{{ __('dashboard.brand') }}</th>
                                                <th>{{ __('dashboard.price') }}</th>
                                                <th>{{ __('dashboard.quantity') }}</th>
                                                <th>{{ __('dashboard.actions') }}</th>
                                            </tr>
                                        </thead>

                                        <body>
                                            {{-- empty --}}
                                        </body>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{--  Data tables  --}}
    <script>
        var lang = "{{ app()->getLocale() }}";

        // display data
        var table = $('#yajra_table').DataTable({
            
            processing: true,
            serverSide: true,
            fixedHeader: true,

            colReorder: true,
            rowReorder: {
                update: false,
                selector: "td:not(:first-child):not(:nth-child(4))",
            },
            // scroller: true,
            // scrollY: 900,
            select: true,
            responsive: {
                details: {
                    display: DataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details for product : ' + data['name'];
                        }
                    }),
                    renderer: DataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
            ajax: "{{ route('dashboard.products.all') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'has_variants',
                    name: 'has_variants',
                },
                {
                    data: 'images',
                    name: 'images',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'sku',
                    name: 'sku',
                },
                {
                    data: 'available_for',
                    name: 'available_for',

                },
                {
                    data: 'category',
                    name: 'category',

                },
                {
                    data: 'brand',
                    name: 'brand',
                },
                {
                    data: 'price',
                    name: 'price'

                },

                {
                    data: 'quantity',
                    name: 'quantity',

                },
                {
                    data: 'action',
                    searchable: false,
                    orderable: false,
                },

            ],

            layout: {
                topStart: {
                    buttons: ['colvis', 'copy', 'print', 'excel', 'pdf']
                }
            },


            language: lang === 'ar' ? {
                url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/ar.json',

            } : {},


        });

        // disable the row order when cliking
        $('table').on('mousedown', 'button', function(e) {
            table.rowReorder.disable();
        });
        $('table').on('mouseup', 'button', function(e) {
            table.rowReorder.enable();
        }); 

    // manage product status
    $(document).on('click', '.status_btn', function(e) {
            e.preventDefault();
            var currentPage = $('#yajra_table').DataTable().page(); // get the current page number

            var product_id = $(this).attr('product-id');

            $.ajax({
                url: "{{ route('dashboard.products.status') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token()}}" ,
                    id: product_id ,
                },

                success: function(data) {
                    if (data.status == 'success') {
                        $('#yajra_table').DataTable().page(currentPage).draw(false);
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }else{
                        Swal.fire({
                            position: "top-center",
                            icon: "erorr",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                }
            });
        });

    // delete product
    $(document).on('click','.delete_confirm_btn',function(e){
        e.preventDefault();
        var currentPage = $('#yajra_table').DataTable().page();
        var product_id = $(this).attr('product-id');

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
                url: "{{ route('products.destroy','id') }}".replace('id',product_id),
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
                        $('#yajra_table').DataTable().ajax.reload();
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