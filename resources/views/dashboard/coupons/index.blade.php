@extends('layouts.dashboard.app')

@section('title')
Coupons
@endsection

@section('body')
 
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.coupons_tabel') }}</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a> 
                            </li>
                           
                            <li class="breadcrumb-item"><a href="{{ route('coupons.index') }}">{{ __('dashboard.coupons') }}</a>
                            </li>

                            {{-- <li class="breadcrumb-item active"><a href="{{ route('brands.create') }}">{{ __('dashboard.create_brand') }}</a>
                            </li> --}}

                        </ol>
                    </div>
                </div>
            </div>
            {{-- @include('dashboard.includes.button-header') --}}
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                  
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.coupons') }}
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

                           {{-- create coupon modal --}}
                           <button type="button" class="btn btn-outline-success mb-1" data-toggle="modal"
                           data-target="#couponModal">
                           {{ __('dashboard.create_coupon') }}
                       </button> 
                        {{-- modal --}}
                        @include('dashboard.coupons.createCoupon')
                        @include('dashboard.coupons.editCoupon')


                        <p class="card-text">As well as being able to pass language information to DataTables
                            through the language initialization option, you can also store
                            the language information in a file, which DataTables can load
                            by Ajax using the language.url option.</p>
                            <table id="yajra_table" class="table table-striped table-bordered language-file">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('dashboard.code') }}</th>
                                        <th>{{ __('dashboard.discount_percentage') }}</th>
                                        <th>{{ __('dashboard.limit') }}</th>
                                        <th>{{ __('dashboard.time_used') }}</th>
                                        <th>{{ __('dashboard.start_date') }}</th>
                                        <th>{{ __('dashboard.end_date') }}</th>
                                        <th>{{ __('dashboard.is_active') }}</th>
                                        <th>{{ __('dashboard.created_at') }}</th>
                                        <th>{{ __('dashboard.actions') }}</th>
                                    </tr>
                                </thead>

                                <body>
                                    {{-- empty --}}
                                </body>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('dashboard.code') }}</th>
                                        <th>{{ __('dashboard.discount_percentage') }}</th>
                                        <th>{{ __('dashboard.limit') }}</th>
                                        <th>{{ __('dashboard.time_used') }}</th>
                                        <th>{{ __('dashboard.start_date') }}</th>
                                        <th>{{ __('dashboard.end_date') }}</th>
                                        <th>{{ __('dashboard.is_active') }}</th>
                                        <th>{{ __('dashboard.created_at') }}</th>
                                        <th>{{ __('dashboard.actions') }}</th>
                                    </tr>
                                </tfoot>
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

    var table = $('#yajra_table').DataTable({
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
                    header: function(row) {
                        var data = row.data();
                        return 'Details for Coupon : ' + data['code'];
                    }
                }),
                renderer: DataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        ajax: "{{ route('dashboard.coupons.all') }}",
        columns: [{
                data: 'DT_RowIndex',
                searchable: false,
                orderable: false,
            },
            {
                data: 'code',
                name: 'code',
            },
            {
                data: 'discount_percentage',
                name: 'discount_percentage',
            },
            {
                data: 'limit',
                name: 'limit',
            },
            {
                data: 'time_used',
                name: 'time_used',
            },
            {
                data: 'start_date',
                name: 'start_date',
            },
            { 
                data: 'end_date',
                name: 'end_date',
            },
            {
                data: 'is_active',
                name: 'is_active',
            },
            {
                data: 'created_at',
                name: 'created_at'

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

    // create coupon using Ajax
    $('#createCoupon').on('submit' , function(e){
        e.preventDefault();
        var currentPage = $('#yajra_table').DataTable().page(); // الصفحه اللي انا واقف فيها حاليا
        $.ajax({ // url , method , data , success , error
            url: "{{ route('coupons.store') }}",
            method: 'post',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status == 'success') {
                    $('#createCoupon')[0].reset(); // empty form
                    $('#yajra_table').DataTable().page(currentPage).draw(false);
                    $('#couponModal').modal('hide'); // form
                    Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                    });
                } else {
                        Swal.fire({
                            position: "top-center",
                            icon: "error",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                }
            },
            error: function(data){
                if (data.responseJSON.errors) {
                   
                    // check 
                        $.each(data.responseJSON.errors, function(key, value) {

                            $('#error_' + key).text(value[0]);  

                            // $('#error_list').append('<li>' + value[0] + '</li>');
                            // $('#error_div').show();
                    });

                }
            },
        });
    });

    // edit coupon using Ajax
    $(document).on('click', '.edit_coupon', function(e) {
        e.preventDefault();

        // اخد القيم واحطها ف ال فاليو
        $("#coupon_id").val($(this).attr('coupon_id')); 
        $("#coupon_code").val($(this).attr('coupon_code'));
        $("#coupon_discount_percentage").val($(this).attr('coupon_discount_percentage'));
        $("#coupon_limit").val($(this).attr('coupon_limit'));
        $("#coupon_start_date").val($(this).attr('coupon_start_date'));
        $("#coupon_end_date").val($(this).attr('coupon_end_date'));
        $("#coupon_start_date").val($(this).attr('coupon_start_date')); 

        var is_active = $(this).attr('coupon_is_active')

        if(is_active == 1){
            $('#coupon_active').prop('checked',true)
        }else{
            $('#coupon_inactive').prop('checked',true)
        }
        $('#editCouponModal').modal('show');
    });

      // Update Coupon Using Ajax
    $('#updateCoupon').on('submit', function(e) {
            e.preventDefault();
            var currentPage = $('#yajra_table').DataTable().page();
            var coupon_id = $('#coupon_id').val();
            $.ajax({
                url: "{{ route('coupons.update', 'id') }}".replace('id', coupon_id),
                method: 'post',
                data: new FormData(this),
                processData: false, 
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        $('#yajra_table').DataTable().page(currentPage).draw(false);
                        $('#editCouponModal').modal('hide');
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            position: "top-center",
                            icon: "error",
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                error: function(data) {
                    if (data.responseJSON.errors) {
                        $('#error_list_edit').empty();
                        $.each(data.responseJSON.errors, function(key, value) {

                            $('#error_list_edit').append('<li>' + value[0] + '</li>');
                            $('#error_div_edit').show();
                        });
                    }
                },
            });
        });




// delete Coupon Using Ajax
    
$(document).on('click', '.delete_comfirm_coupon',function(e) {
    e.preventDefault();
    
    var coupon_id = $(this).attr('coupon_id');

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
                url: "{{ route('coupons.destroy', 'id') }}".replace('id', coupon_id),
                method: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.status == 'success') { // عمليه المسح تمت بنجاج
                        Swal.fire({
                            title: data.status,
                            text: data.message,
                            icon: "success"
                        }); 
                        $('#yajra_table').DataTable().ajax.reload(); // ابديت للجدول بعد المسح الرو
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