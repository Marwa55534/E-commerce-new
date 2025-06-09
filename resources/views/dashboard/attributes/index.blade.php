@extends('layouts.dashboard.app')

@section('title')
Attributes
@endsection

@section('body')
 
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.attributes_tabel') }}</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a> 
                            </li>
                           
                            <li class="breadcrumb-item"><a href="{{ route('attributes.index') }}">{{ __('dashboard.attributes') }}</a>
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
                  
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.attributes') }}
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
                           data-target="#attributeModal">
                           {{ __('dashboard.create_attribute') }}
                       </button>
                        {{-- modal --}}
                        @include('dashboard.attributes.createAttribute')
                        @include('dashboard.attributes.editAttribute')

                        <p class="card-text">As well as being able to pass language information to DataTables
                            through the language initialization option, you can also store
                            the language information in a file, which DataTables can load
                            by Ajax using the language.url option.</p>
                            <table id="yajra_table" class="table table-striped table-bordered language-file">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('dashboard.attribute_name') }}</th>
                                        <th>{{ __('dashboard.attribute_values') }}</th>
                                        <th>{{ __('dashboard.created_at') }}</th>
                                        <th>{{ __('dashboard.operations') }}</th>
                                    </tr>
                                </thead>

                                <body>
                                    {{-- empty --}}
                                </body>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('dashboard.attribute_name') }}</th>
                                        <th>{{ __('dashboard.attribute_values') }}</th>
                                        <th>{{ __('dashboard.created_at') }}</th>
                                        <th>{{ __('dashboard.operations') }}</th>
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

<script>

var lang = "{{ app()->getLocale() }}";

// data tables
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
                    return 'Details for Attribute : ' + data['name'];
                }
            }),
            renderer: DataTable.Responsive.renderer.tableAll({
                tableClass: 'table'
            })
        }
    },
    ajax: "{{ route('dashboard.attributes.all') }}",
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
            data: 'attributeValues',
            name: 'attributeValues',
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
</script>


<script>

//  add new values to attribute in case create
$(document).ready(function() {
        let valueIndex = 2;

    $('#add_more').on('click',function(e) {
        e.preventDefault();


        let newRow = `
            <div class="row attribute_values_row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="value_ar_${valueIndex}">{{ __('dashboard.attribute_value_ar') }}</label>
                                <input type="text" name="value[${valueIndex}][ar]" class="form-control" id="value_ar_${valueIndex}"
                                    placeholder="{{ __('dashboard.attribute_value_ar') }}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="value_en_${valueIndex}">{{ __('dashboard.attribute_values_en') }}</label>
                                <input type="text" name="value[${valueIndex}][en]" class="form-control" id="value_en_${valueIndex}"
                                    placeholder="{{ __('dashboard.attribute_values_en') }}">
                            </div>
                        </div>
                        
                        <div class="col-md-2 mt-2">
                            <button type="button" class="btn btn-danger remove"><i class="ft-x"></i></button>
                        </div>
        </div>`;

            // append the new row to the form
        $('.attribute_values_row:last').after(newRow);

        valueIndex++; // increment the counter
    
    });

    $(document).on('click', '.remove', function() {
        $(this).closest('.attribute_values_row').remove();
    });
});

//  create attributes 
$('#createAttribute').on('submit' , function(e){
    e.preventDefault();
    var currentPage = $('#yajra_table').DataTable().page();
    $.ajax({
        url: "{{ route('attributes.store') }}",
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType:false,
        success: function(data){
            if(data.status == 'success'){
                $('#createAttribute')[0].reset();
                $('#yajra_table').DataTable().page(currentPage).draw(false);
                $('#attributeModal').modal('hide');
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
                    icon: "error",
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        error: function(data){
            if (data.responseJSON.errors) {
                $('#error_list').empty();
                    // check 
                $.each(data.responseJSON.errors, function(key, value) {

                    // $('#errors_' + key).text(value[0]); 

                    $('#error_list').append('<li>' + value[0] + '</li>');
                    $('#error_div').show();
                            
                }); 

            }
        },
    }); 
   // عند فتح الـ modal مرة أخرى، تأكد من إخفاء الأخطاء إذا كانت موجودة
    $('#attributeModal').on('show.bs.modal', function() {
        $('#error_div').hide();  // إخفاء الأخطاء عند فتح الـ modal
        $('#error_list').empty();  // تفريغ الأخطاء
    });
});

// عند فتح الـ modal مرة أخرى، تأكد من إخفاء الأخطاء إذا كانت موجودة
// $('#attributeModal').on('show.bs.modal', function() {
//     $('#error_div').hide();  // إخفاء الأخطاء عند فتح الـ modal
//     $('#error_list').empty();  // تفريغ الأخطاء
// });


// edit Attribute
$(document).on('click', '.edit-attribute', function() {
    let id = $(this).data('id');
    let nameAr = $(this).data('name-ar');
    let nameEn = $(this).data('name-en');
    let values = $(this).data('values');

    $('.attributeValuesContainer').empty(); // Remove old rows

    // Populate name fields
    $('#attributeId').val(id);
    $('#attributeNameAr').val(nameAr);
    $('#attributeNameEn').val(nameEn);

    // Clear and populate values container
    let valuesContainer = $('.attributeValuesContainer:last');
    valuesContainer.empty();

    values.forEach(value => {
        valuesContainer.after(`
            <div class="row attributeValuesContainer">
                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="name">{{ __('dashboard.attribute_value_ar') }}</label>
                                        <input type="text" name="value[${value.id}][ar]" class="form-control" id="code"
                                            value="${value.value_ar}"
                                            placeholder="{{ __('dashboard.attribute_value_ar') }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="name">{{ __('dashboard.attribute_value_en') }}</label>
                                        <input type="text" name="value[${value.id}][en]" class="form-control" id="code"
                                            value="${value.value_en}"
                                            placeholder="{{ __('dashboard.attribute_value_en') }}">
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <button  type="button" class="btn btn-danger remove"><i class="ft-x"></i></button>
                 </div>
            </div>

        `);
    });

    // delete validation error on click
    $('#error_list_edit').empty();
    $('#error_div_edit').hide();
    // Show the modal
    $('#editAttributeModal').modal('show');
});


// add new values to attribute in case edit
$(document).ready(function(){
    let valueIndex = 100;

    $('.add_more_edit').on('click',function(e){
        e.preventDefault();

        let newRow = `
        <div class="row attributeValuesContainer">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="value_ar_">{{ __('dashboard.attribute_value_ar') }}</label>
                                        <input type="text" name="value[${valueIndex}][ar]" class="form-control" id="value_ar_${valueIndex}"
                                            placeholder="{{ __('dashboard.attribute_value_ar') }}">
                                        <strong class="text-danger"></strong>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="value_en_">{{ __('dashboard.attribute_value_en') }}</label>
                                        <input type="text" name="value[${valueIndex}][en]" class="form-control" id="value_en_${valueIndex}"
                                            placeholder="{{ __('dashboard.attribute_value_en') }}">
                                        <strong class="text-danger"></strong>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                        <button type="button" class="btn btn-danger remove" ><i class="ft-x"></i></button>
                                </div>
                            </div>`;
        // Append the new row to the form
        $('.attributeValuesContainer:last').after(newRow);
        valueIndex++; 
    });
});

// Update attribute Using Ajax
$('.updateAttributeForm').on('submit', function(e) {
    e.preventDefault();
    var currentPage = $('#yajra_table').DataTable().page(); // get the current page number
    var attribute_id = $('#attributeId').val();
    $.ajax({
        url: "{{ route('attributes.update', 'id') }}".replace('id', attribute_id),
        method: 'post',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(data){
            if(data.status == 'success'){
                $('#yajra_table').DataTable().page(currentPage).draw(false);
                $('#editAttributeModal').modal('hide');
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }if(data.status == 'error') {
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
                $.each(data.responseJSON.errors,function(key , value){
                    $('#error_list_edit').empty();

                    $('#error_list_edit').append('<li>' + value[0] + '</li>');
                    $('#error_div_edit').show();
                });
            }
        }, 
    });
});

// delete attribute using ajax & Jquery
$(document).on('click', '.delete_confirm_btn',function(e) {
    e.preventDefault();
    
    var attribute_id = $(this).attr('attribute-id');

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
                url: "{{ route('attributes.destroy', 'id') }}".replace('id', attribute_id),
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

 // Delete Attribute Value Input Field 
$(document).on('click', '.remove', function() {
    $(this).closest('.attribute_values_row').remove(); // create
    $(this).closest('.attributeValuesContainer').remove();   // edit
});


</script> 

@endpush 
