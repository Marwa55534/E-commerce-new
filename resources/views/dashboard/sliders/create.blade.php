<!-- Modal -->
<div class="modal fade" id="createSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.create_sliders') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">   
                @include('dashboard.includes.validation-error')      
                      
                <form action="{{ route('dashboard.slider.store') }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="note">{{ __('dashboard.note_ar') }}</label>
                        <input type="text" name="note[ar]" class="form-control" id="note"
                            placeholder="{{ __('dashboard.note_ar') }}"> 
                    </div>
                    <div class="form-group">
                        <label for="note">{{ __('dashboard.note_en') }}</label>
                        <input type="text" name="note[en]" class="form-control" id="note"
                            placeholder="{{ __('dashboard.note_en') }}">
                    </div>

                    <div class="form-group">
                        <label for="file_name">{{ __('dashboard.file_name') }}</label>
                        <input type="file"  name="file_name" class="form-control" id="single-image"
                            placeholder="{{ __('dashboard.file_name') }}">
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