@extends('layouts.dashboard.app')

@section('title')
Faqs
@endsection

@section('body')

<div class="app-content content"> 
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.faqs_table') }}</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a> 
                            </li>
                           
                            <li class="breadcrumb-item"><a href="{{ route('faqs.index') }}">{{ __('dashboard.faqs') }}</a>
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
                  
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.faqs') }}
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
                           data-target="#faqCreateModal">
                           {{ __('dashboard.create_faq') }}
                       </button>
                        {{-- modal --}}
                        @include('dashboard.faqs.createFaq')
                        {{-- @include('dashboard.faqs.editFaq') --}}

                         <!-- Collapsible with Border Color -->
            <div class="col-xl-12 col-lg-12">
                <div class="mb-1">
                  <h5 class="mb-0">Collapsible with Border Color</h5>
                  {{-- <small class="text-muted">Use class <code>.border-COLOR</code>to collapse toggle for Collapse
                    heading border color.</small> --}}
                </div>
                <div class="card faq_row" id="headingCollapse51">

                  @forelse ($faqs as $faq)
                  <div id="faq_div_{{ $faq->id }}">
                  <div role="tabpanel" class="card-header border-success">
                    <a id="question_{{ $faq->id }}" data-toggle="collapse" href="#collapse51_{{$faq->id}}" 
                      aria-expanded="true" aria-controls="collapse51_{{$faq->id}}"
                      class="font-medium-1 success">{{$faq->question}}</a>
                    
                    <a faq-id="{{ $faq->id }}"  class="delete_confirm_btn" href=""><i class="la la-trash float-right"></i></a>  
                    <a data-target="#faqEditModal_{{ $faq->id }}" data-toggle="modal" href=""><i class="la la-edit float-right"></i></a>  
                  </div>
                  <div id="collapse51_{{$faq->id}}" role="tabpanel" aria-labelledby="headingCollapse51" class="card-collapse collapse @if($loop->index==0)show @endif"
                  aria-expanded="true">
                    <div id="answer_{{ $faq->id }}" class="card-body">
                      {{$faq->answer}}
                    </div>
                  </div>
                </div>
                  @include('dashboard.faqs.editFaq')

                  @empty
                      <div class="alert alert-info">no data</div>
                  @endforelse
                  
                 

                            </div>
                          </div>
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
    // create use ajax
    $(document).on('submit', '#createFaq', function(e){
      e.preventDefault();
      var data = new FormData($(this)[0]);
      var lang = "{{ app()->getLocale() }}"; // ar , en

      $.ajax({ // url , method , data , success , error
            url: "{{ route('faqs.store') }}", 
            type: 'post',
            data: data,
            processData: false,
            contentType: false,
            success: function(data) {
              if (data.status == 'error') {
                Swal.fire({
                    position: "top-center",
                    icon: "error",
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
              }else{
                var question = lang=='ar' ? data.faq.question.ar : data.faq.question.en
                var answer = lang=='ar' ? data.faq.answer.ar : data.faq.answer.en

                $('#createFaq')[0].reset();
                // $('#faqModal').modal('hide');
                $('.faq_row').prepend(` <div role="tabpanel" class="card-header border-success">
                    <a data-toggle="collapse" href="#collapse51_" 
                      aria-expanded="true" aria-controls="collapse51_"
                      class="font-medium-1 success">${question}</a>
                    
                    <a href=""><i class="la la-trash float-right"></i></a>  
                    <a href=""><i class="la la-edit float-right"></i></a>  
                  </div>
                  <div id="collapse51_{{$faq->id}}" role="tabpanel" aria-labelledby="headingCollapse51" class="card-collapse collapse show"
                  aria-expanded="true">
                    <div class="card-body">
                      ${answer}
                    </div>
                  </div>`);
                  Swal.fire({
                      position: "top-center",
                      icon: "success",
                      title: data.message,
                      showConfirmButton: false,
                      timer: 1500
                  });
                   // close modal
                   $('#faqCreateModal').modal('hide');
              }
            },
            error: function(data) {
              if (data.responseJSON.errors) {
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('#error_list').append('<li>' + value[0] + '</li>');
                            $('#error_div').show();
                      });
                  }
            },
      });     
    });  

    // update use ajax
    $(document).on('submit', '.update_faq_form', function(e){
      e.preventDefault();
      var lang="{{ app()->getLocale() }}"

      var faq_id = $(this).attr('faq-id');
      var data = new FormData($(this)[0]);
      var url = "{{ route('faqs.update' , ':id') }}";
      url = url.replace(':id' , faq_id);

      $.ajax({
        url: url,
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(data) {
          if(data.success == 'error'){
                  Swal.fire({
                      position: "top-center",
                      icon: "error",
                      title: data.message,
                      showConfirmButton: false,
                      timer: 1500
                  });
          }else{
            var question = lang=='ar' ? data.faq.question.ar : data.faq.question.en
            var answer = lang == 'ar' ? data.faq.answer.ar : data.faq.answer.en;

            $('#faqEditModal_'+faq_id).modal('hide');
            $('#question_'+faq_id).empty().text(question);
            $('#answer_'+faq_id).empty().text(answer);

            Swal.fire({
                position: "top-center",
                icon: "success",
                title: data.message,
                showConfirmButton: false,
                timer: 2000
            });

          }
        },
        error: function(data) {
              if (data.responseJSON.errors) {
                $('#error_list_'+faq_id).empty();
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('#error_list_'+faq_id).append('<li>' + value[0] + '</li>');
                            $('#error_div_'+faq_id).show();
                        });
              }
        },
      })

    });

    // delete use ajax
    $(document).on('click', '.delete_confirm_btn', function(e){
      e.preventDefault();
      var faq_id = $(this).attr('faq-id');

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
            url: "{{ route('faqs.destroy', 'id') }}".replace('id', faq_id),
                method: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}"
                },
              success: function(data) {
                if (data.status == 'success') {
                  $('#faq_div_'+faq_id).remove(); // بيمسح ف ساعتها من غير ريلود
                  Swal.fire({
                      title: data.status,
                      text: data.message,
                      icon: "success"
                  });
                }else{
                  Swal.fire({
                      title: data.status,
                      text: data.message,
                      icon: "error"
                  });
                }
              }

          })
        }
      });
    })
  </script>  
    
@endpush
