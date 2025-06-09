@extends('layouts.dashboard.app') 

@section('title')
    Sliders
@endsection

@section('body')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.sliders_tabel') }}</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a> 
                            </li>
                           
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.sliders.index') }}">{{ __('dashboard.sliders') }}</a>
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
                  
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.sliders') }}
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
                           data-target="#createSliderModal">
                           {{ __('dashboard.create_sliders') }}
                       </button> 
                        {{-- modal --}}
                        @include('dashboard.sliders.create')


                        <p class="card-text">As well as being able to pass language information to DataTables
                            through the language initialization option, you can also store
                            the language information in a file, which DataTables can load
                            by Ajax using the language.url option.</p>
                            <table id="yajra_table" class="table table-striped table-bordered language-file">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('dashboard.file_name') }}</th>
                                        <th>{{ __('dashboard.note') }}</th>
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
                                        <th>{{ __('dashboard.file_name') }}</th>
                                        <th>{{ __('dashboard.note') }}</th>
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
                        return 'Details for '+ data[0] + ' ' + data[1];
                    }
                }),
                renderer: DataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        ajax: "{{ route('dashboard.sliders.all') }}",
        columns: [{
                data: 'DT_RowIndex',
                searchable: false,
                orderable: false,
            },
            {
                data: 'file_name',
                name: 'file_name',
            },
            {
                data: 'note',
                name: 'note',
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
                buttons: ['colvis', 'copy']
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

    $(document).on('click','.delete_comfirm_btn',function(e){
        e.preventDefault();
        var slider_id = $(this).attr('slider-id');

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
                url: "{{ route('dashboard.slider.destroy', ':id') }}".replace(':id', slider_id),
                method: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: 'DELETE'
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