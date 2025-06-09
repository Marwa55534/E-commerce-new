<div>
    {{-- model --}}

    <div class="modal fade" id="replayContactModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{asset($setting->logo)}}" alt="logo" width="40">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.replay_contact') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 

                {{-- prevent مش يعمل ريلود عندي ف الصفحه --}}
                <form wire:submit.prevent="replayContact" class="form" > 
                    @csrf
                     <input type="hidden" wire:model="id" class="form-control" id="contactId">

                    <div class="form-group">
                        <label for="UserEmail"><i class="fas fa-envelope"></i> {{ __('dashboard.email') }}</label>
                        <input readonly wire:model="email" type="email" class="form-control be-light border-0" id="UserEmail">
                    </div>

                    <div class="form-group">
                        <label for="contactSubject"><i class="fas fa-tag"></i> {{ __('dashboard.subject') }}</label>
                        <input readonly wire:model="subject" type="text"  class="form-control be-light border-0" id="contactSubject">
                    </div>

                    <div class="form-group">
                        <label for="replayMessage"><i class="fas fa-comment-dots"></i> {{ __('dashboard.replay_Message') }}</label>
                        <textarea rows="4" wire:model="replayMessage"  class="form-control be-light border-primary" id="replayMessage"></textarea>
                    </div>
               
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><i class="ft-x"></i>{{ __('dashboard.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">  <i class="la la-check-square-o"></i> {{ __('dashboard.send') }}</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
</div>


@script
<script> 
    // lisnting
    Livewire.on('luanch-replay-contact-model', () => {
        $('#replayContactModel').modal('show');
    });
    Livewire.on('close-model', () => {
        $('#replayContactModel').modal('hide');
    });
</script> 
@endscript


