@extends('layouts.dashboard.app')
@section('title')
    {{ __('dashboard.users') }}
@endsection

@section('body')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.users_table') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">
                                        {{ __('dashboard.users') }}</a>
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
                                    {{ __('dashboard.users') }}
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
                                    {{-- create user modal --}}
                                    <button type="button" class="btn btn-outline-success mb-1" data-toggle="modal"
                                        data-target="#userModal">
                                        {{ __('dashboard.create_user') }}
                                    </button> 

                                    {{-- include livewire address dropdown dependon --}}
                                    @include('dashboard.users.createUser')

                                    <p class="card-text">As well as being able to pass language information to DataTables
                                        through the language initialization option, you can also store
                                        the language information in a file, which DataTables can load
                                        by Ajax using the language.url option.</p>                                    <table id="yajra_table" class="table table-striped table-bordered language-file">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('dashboard.name') }}</th>
                                                <th>{{ __('dashboard.email') }}</th>
                                                <th>{{ __('dashboard.mobile') }}</th>
                                                <th>{{ __('dashboard.email_verified_at') }}</th>
                                                <th>{{ __('dashboard.status') }}</th>
                                                <th>{{ __('dashboard.image') }}</th>
                                                <th>{{ __('dashboard.country') }}</th>
                                                <th>{{ __('dashboard.governorates') }}</th>
                                                <th>{{ __('dashboard.city') }}</th>
                                                <th>{{ __('dashboard.num_of_orders') }}</th>
                                                <th>{{ __('dashboard.created_at') }}</th>
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
    <script>
        var lang = "{{ app()->getLocale() }}";
        $('#yajra_table').DataTable({
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
                            return 'Details for User : ' + data['name'];
                        }
                    }),
                    renderer: DataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
            ajax: "{{ route('dashboard.users.all') }}",
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
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'mobile',
                    name: 'mobile',
                },
                {
                    data: 'email_verified_at',
                    name: 'email_verified_at',

                },
                {
                    data: 'status',
                    name: 'status',

                },
                {
                    data: 'image',
                    name: 'image',

                },
                {
                    data: 'country',
                    name: 'country'

                },
                {
                    data: 'governorate',
                    name: 'governorate'

                },
                {
                    data: 'city',
                    name: 'city'

                },
                {
                    data: 'num_of_orders',
                    name: 'num_of_orders'
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
        
    // manage user status
    $(document).on('click', '.manage_user_status', function(e) {
            e.preventDefault();
            var currentPage = $('#yajra_table').DataTable().page(); // get the current page number

            var user_id = $(this).attr('user-id');

            $.ajax({
                url: "{{ route('dashboard.users.status') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token()}}" ,
                    id: user_id ,
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
     
    // delete user 
    $(document).on('click','.delete_confirm_btn',function(e){
        e.preventDefault();
        var currentPage = $('#yajra_table').DataTable().page();

        var user_id = $(this).attr('user-id');

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
                url: "{{ route('users.destroy','id') }}".replace('id',user_id),
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
 
    // create user
    $(document).on('submit','#CreateUserForm',function(e){
        e.preventDefault();
        var currentPage = $('#yajra_table').DataTable().page();
        $.ajax({
            url: "{{ route('users.store') }}",
            method:'POST',
            data: new FormData(this),
            processData:false,
            contentType:false,

            success: function(data){
                if(data.status == 'success'){
                    $('#CreateUserForm')[0].reset();
                    $('#yajra_table').DataTable(currentPage).draw(false);
                    $('#userModal').modal('hide');
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
                if(data.responseJSON.errors){
                    $('#error_list').empty();
                    $('#error_div').hide();
                    $.each(data.responseJSON.errors, function(key, value) {
                        $('#error_list').append('<li>' + value[0] + '</li>');
                        $('#error_div').show();
                    });
                }
            }
        });
        // عند فتح الـ modal مرة أخرى، تأكد من إخفاء الأخطاء إذا كانت موجودة
        $('#userModal').on('show.bs.modal', function() {
            $('#error_div').hide();  // إخفاء الأخطاء عند فتح الـ modal
            $('#error_list').empty();  // تفريغ الأخطاء
        });
    });


    </script>
@endpush