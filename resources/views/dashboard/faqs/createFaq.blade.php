<!-- Modal -->
<div class="modal fade" id="faqCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.create_faq') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{-- validation --}}
                <div class="alert alert-danger" id="error_div" style="display: none">
                    <ul id="error_list"></ul>
                </div>

                <form action="" id="createFaq" class="form" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label for="question">{{ __('dashboard.question_en') }}</label>
                        <input type="text" name="question[en]" class="form-control" id="question"
                            placeholder="{{ __('dashboard.question_en') }}">
                    </div>

                    <div class="form-group">
                        <label for="question">{{ __('dashboard.question_ar') }}</label>
                        <input type="text" name="question[ar]" class="form-control" id="question"
                            placeholder="{{ __('dashboard.question_ar') }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="answer">{{ __('dashboard.answer_en') }}</label>
                        <textarea name="answer[en]" class="form-control"></textarea>
                        
                    </div>

                    <div class="form-group">
                        <label for="answer">{{ __('dashboard.answer_ar') }}</label>
                        <textarea name="answer[ar]" class="form-control"></textarea>
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