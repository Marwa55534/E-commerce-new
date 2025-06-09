@extends('layouts.dashboard.app')

@section('title')
    Pages Edit
@endsection
@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush
@section('body')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-9 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.pages_tabel') }}</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">
                                    {{ __('dashboard.pages') }}</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="">
                                    {{ __('dashboard.edit_page') }}</a>
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
                                {{ __('dashboard.create_page') }}
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
                                {{-- alert --}}
                                @include('dashboard.includes.validation-error')

                                <p class="card-text">{{ __('dashboard.Basic_Forms') }}.</p>

                                <form class="form" action="{{ route('pages.update' , $page->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="eventRegInput1">{{ __('dashboard.title_en') }}</label>
                                            <input type="text" value="{{ old('title[en]',$page->getTranslation('title', 'en') )}}" class="form-control"
                                                placeholder="{{ __('dashboard.title_en') }}" name="title[en]">
                                        </div>

                                        <div class="form-group">
                                            <label for="eventRegInput1">{{ __('dashboard.title_ar') }}</label>
                                            <input type="text" value="{{ old('title[ar]', $page->getTranslation('title', 'ar') )}}" class="form-control"
                                                placeholder="{{ __('dashboard.title_ar') }}" name="title[ar]">
                                        </div> 
                                        
                                        <div  class="form-group">
                                            <label for="eventRegInput1">{{ __('dashboard.content_en') }}</label>
                                            <textarea id="summernote"  type="text" class="form-control" name="content[en]" class="form-control">{{  $page->getTranslation('content', 'en') }}</textarea>
                                            
                                        </div>
                    
                                        <div  class="form-group">
                                            <label for="eventRegInput1">{{ __('dashboard.content_ar') }}</label>
                                            <textarea id="summernote2" type="text" class="form-control"  name="content[ar]" class="form-control">{{  $page->getTranslation('content', 'ar') }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="image">{{ __('dashboard.image') }}</label>
                                            <input type="file"  name="image" class="form-control" id="single-image-edit"
                                                placeholder="{{ __('dashboard.image') }}">
                                        </div>

                                    </div>
                                    <div class="form-actions left">
                                        <a href="{{ url()->previous() }}" type="button" class="btn btn-warning mr-1">
                                            <i class="ft-x"></i> {{ __('dashboard.cancel') }}
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> {{ __('dashboard.save') }}
                                        </button>
                                    </div>
                                </form>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function () {
    $('#summernote').summernote({
        placeholder:'اكتب هنا ...',
        tabsize: 2,
        height: 500,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    $('#summernote2').summernote({
        placeholder:'write please ...',
        tabsize: 2,
        height: 500,
        lang: 'ar-AR',
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});

var lang = "{{ app()->getLocale() }}";
    // plugin
    $(function(){ 
        $("#single-image-edit").fileinput({
            theme: 'fa5',
            language: lang,
            allowedFileTypes: ['image'], 
            maxFileCount: 1,
            enableResumableUpload: false, 
            showUpload: false,
            initialPreviewAsData: true, // بعرض الصوره القديمه
            initialPreview: [
                "{{asset('uploads/pages/'.$page->image)}}",
            ],
            // تحذف الصور
            initialPreviewConfig: [ 
              @if($page->image !== null)
                      {
                        caption: "{{$page->image}}", 
                        width: '120px', 
                        url: "{{ route('pages.delete-image' , $page->id) }}",
                        key: "{{$page->id}}", 
                        extra: {
                            _token: "{{ csrf_token() }}" // هنا ترسل التوكن
                        }
                      },
              @endif
            ],
        
        });
    });


</script> 
@endpush