@extends('layouts.dashboard.app')

@section('title')
    Categories
@endsection

@section('body')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.orders_table') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a>
                                </li>

                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.orders.index') }}">{{ __('dashboard.orders') }}</a>
                                </li>



                            </ol>
                        </div>
                    </div>
                </div>
                {{-- @include('dashboard.includes.button-header') --}}
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.orders') }}
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

                            {{-- <a href="{{route('orders.create')}}" class="btn btn-outline-success">{{
                                __('dashboard.orders') }}</a> --}}
                            {{-- alert --}}
                            @include('dashboard.includes.tostar-success')
                            @include('dashboard.includes.tostar-error')

                            <p class="card-text">As well as being able to pass language information to DataTables
                                through the language initialization option, you can also store
                                the language information in a file, which DataTables can load
                                by Ajax using the language.url option.</p>
                            
                                <div class="form-group">
                                    <select id="status_filter" class="form-control" 
                                        style="width:200px; display:inline-block; margin-bottom: 10px;">
                                        <option value="">All status</option>
                                        <option value="pending">pending</option>
                                        <option value="paid">paid</option>
                                        <option value="cancelled">cancelled</option>
                                        <option value="delivered">delivered</option>
                                    </select>

                                </div>
                                <table id="yajra_table" class="table table-striped table-bordered language-file">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('dashboard.user_name') }}</th>
                                        <th>{{ __('dashboard.user_phone') }}</th>
                                        <th>{{ __('dashboard.user_email') }}</th>
                                        <th>{{ __('dashboard.status') }}</th>
                                        <th>{{ __('dashboard.country') }}</th>
                                        <th>{{ __('dashboard.governorate') }}</th>
                                        <th>{{ __('dashboard.city') }}</th>
                                        <th>{{ __('dashboard.street') }}</th>
                                        <th>{{ __('dashboard.price') }}</th>
                                        <th>{{ __('dashboard.shapping_price') }}</th>
                                        <th>{{ __('dashboard.total_price') }}</th>
                                        <th>{{ __('dashboard.coupon') }}</th>
                                        <th>{{ __('dashboard.coupon_discount') }}</th>
                                        <th>{{ __('dashboard.note') }}</th>
                                        <th>{{ __('dashboard.created_at') }}</th>
                                        <th>{{ __('dashboard.operations') }}</th>
                                    </tr>
                                </thead>

                                <body>

                                </body>

                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('dashboard.user_name') }}</th>
                                        <th>{{ __('dashboard.user_phone') }}</th>
                                        <th>{{ __('dashboard.user_email') }}</th>
                                        <th>{{ __('dashboard.status') }}</th>
                                        <th>{{ __('dashboard.country') }}</th>
                                        <th>{{ __('dashboard.governorate') }}</th>
                                        <th>{{ __('dashboard.city') }}</th>
                                        <th>{{ __('dashboard.street') }}</th>
                                        <th>{{ __('dashboard.price') }}</th>
                                        <th>{{ __('dashboard.shapping_price') }}</th>
                                        <th>{{ __('dashboard.total_price') }}</th>
                                        <th>{{ __('dashboard.coupon') }}</th>
                                        <th>{{ __('dashboard.coupon_discount') }}</th>
                                        <th>{{ __('dashboard.note') }}</th>
                                        <th>{{ __('dashboard.created_at') }}</th>
                                        <th>{{ __('dashboard.operations') }}</th>
                                    </tr>
                                </tfoot>

                            </table>
                            {{-- {{ $categories->links() }} --}}

                            {{-- {{$categories->appends(request()->query())->links()}} --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script>
        var lang = "{{ app()->getLocale() }}";

        $('#yajra_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: true,

            colReorder: true,
            rowReorder: {
                update: false,
                selector: "td:not(:first-child)",
            },
            // scroller: true,
            // scrollY: 900,
            select: true,
            responsive: {
                details: {
                    display: DataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details for ' + data[0] + ' ' + data[1];
                        }
                    }),
                    renderer: DataTable.Responsive.renderer.tableAll()
                }
            },

            ajax: {
                url: "{{ route('dashboard.orders.all') }}",
                data: function (d) {
                    d.status = $('#status_filter').val();
                }
            },
            // ajax: "{{ route('dashboard.orders.all') }}", // اللي انا هجيب منها الداتا 
            columns: [
                {
                    data: 'DT_RowIndex',
                    searchable: false,  // تعطيل البحث
                    orderable: false,   // تعطيل الترتيب
                },
                {
                    data: 'user_name',
                    name: 'user_name',
                },
                {
                    data: 'user_phone',
                    name: 'user_phone',
                },
                {
                    data: 'user_email',
                    name: 'user_email',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'country',
                    name: 'country',
                },
                {
                    data: 'governorate',
                    name: 'governorate',
                },
                {
                    data: 'city',
                    name: 'city',
                },
                {
                    data: 'street',
                    name: 'street',
                },
                {
                    data: 'price',
                    name: 'price',
                },
                {
                    data: 'shapping_price',
                    name: 'shapping_price',
                },
                {
                    data: 'total_price',
                    name: 'total_price',
                },
                {
                    data: 'coupon',
                    name: 'coupon',
                },
                {
                    data: 'coupon_discount',
                    name: 'coupon_discount',
                },
                {
                    data: 'note',
                    name: 'note',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'operations',
                    searchable: false,  // تعطيل البحث
                    orderable: false,   // تعطيل الترتيب
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

         $('#status_filter').on('change', function (e) {
            $('#yajra_table').DataTable().ajax.reload(); // ابديت للجدول بعد المسح الرو
        });

        // disable the row order when cliking
        $('table').on('mousedown', 'button', function (e) {
            table.rowReorder.disable();
        });

        $('table').on('mouseup', 'button', function (e) {
            table.rowReorder.enable();
        });



        // delete Coupon Using Ajax
        $(document).on('click', '.delete_confirm_btn', function (e) {
            e.preventDefault();

            var order_id = $(this).attr('order_id');

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
                    $.ajax({
                        url: "{{ route('dashboard.order.destroy', ':id') }}".replace(':id', order_id),
                        method: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    title: data.status,
                                    text: data.message,
                                    icon: "success"
                                });
                                $('#yajra_table').DataTable().ajax.reload(); // ابديت للجدول بعد المسح الرو
                            }
                            if (data.status == 'error') {
                                Swal.fire({
                                    title: data.status,
                                    text: data.message,
                                    icon: "error"
                                });
                            }
                        }
                    });

                }
            });
        });

    </script>
@endpush