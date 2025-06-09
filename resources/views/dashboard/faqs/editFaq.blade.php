<!-- Modal -->
<div class="modal fade" id="faqEditModal_{{$faq->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.edit_faq') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{-- validation --}}
                <div class="alert alert-danger" id="error_div_{{$faq->id}}" style="display: none">
                    <ul id="error_list_{{$faq->id}}"></ul>
                </div>

                <form action="" faq-id="{{$faq->id}}" class="form update_faq_form" method="POST" >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="question">{{ __('dashboard.question_en') }}</label>
                        <input type="text" name="question[en]" value="{{$faq->getTranslation('question','en')}}" class="form-control" id="question"
                            placeholder="{{ __('dashboard.question_en') }}">
                    </div>

                    <div class="form-group">
                        <label for="question">{{ __('dashboard.question_ar') }}</label>
                        <input type="text" name="question[ar]" value="{{$faq->getTranslation('question','ar')}}" class="form-control" id="question"
                            placeholder="{{ __('dashboard.question_ar') }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="answer">{{ __('dashboard.answer_en') }}</label>
                        <textarea name="answer[en]" class="form-control">
                            {{$faq->getTranslation('answer','en')}}
                        </textarea>
                        
                    </div>

                    <div class="form-group">
                        <label for="answer">{{ __('dashboard.answer_ar') }}</label>
                        <textarea name="answer[ar]" class="form-control">
                            {{$faq->getTranslation('answer','ar')}}
                        </textarea>
                        
                    </div>
                    

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><i class="ft-x"></i>{{ __('dashboard.close') }}</button>
                        <button type="submit" class="btn btn-primary">  <i class="la la-check-square-o"></i> {{ __('dashboard.save') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>