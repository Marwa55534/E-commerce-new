 <div>
    <div class="form-group text-center">
        <!-- Dropup Button -->
        <div class="btn-group dropup w-80">
            <button class="btn btn-danger btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ft-mail"></i> {{ __('dashboard.actions') }}
            </button> 
            <div class="dropdown-menu w-80 text-center">
                <a wire:click.prevent="markAllAsRead" href="#" class="dropdown-item">
                    <i class="ft-trash-2"></i>{{ __('dashboard.Mark_All_As_Read') }}
                </a>
                <a wire:click.prevent="deleteAllReadContacts" href="#" class="dropdown-item">
                    <i class="ft-trash-2"></i>{{ __('dashboard.Delete_All_Read_Contacts') }}
                </a>
                <a wire:click.prevent="deleteAllAnswereContacts" href="#" class="dropdown-item">
                    <i class="ft-trash-2"></i>{{ __('dashboard.Delete_All_Answere_Contacts') }}
                </a>
                <a wire:click.prevent="restoreAllContacts" href="#" class="dropdown-item">
                    <i class="ft-restore"></i>{{ __('dashboard.Restore_All_Contacts') }}
                </a>
                <a wire:click.prevent="cancelSpams" href="#" class="dropdown-item">
                    <i class="ft-inbox"></i>{{ __('dashboard.Cancel_Spams') }}
                </a>
            </div>
        </div>
    </div> 
    
    
    
    <h6 class="text-muted text-bold-500 mb-1">{{ __('dashboard.messages') }}</h6>
    <div class="list-group list-group-messages">
        <a wire:click.prevent="selectScreen('inbox')" href="#" class="list-group-item @if($screen == 'inbox') active @endif border-0">
            <i class="ft-inbox mr-1"></i> {{ __('dashboard.Inbox') }}
            <span class="badge badge-secondary badge-pill float-right">{{ $inboxCount }}</span>
        </a>
        <a wire:click.prevent="selectScreen('readed')" href="#" class="list-group-item list-group-item-action @if($screen == 'readed') active @endif border-0">
            <i class="la la-paper-plane-o mr-1"></i> {{ __('dashboard.Readed') }}
            <span class="badge badge-secondary float-right">{{ $readedCount }}</span>
        </a>
        <a wire:click.prevent="selectScreen('answered')" href="#" class="list-group-item list-group-item-action @if($screen == 'answered') active @endif border-0">
            <i class="ft-file mr-1"></i> {{ __('dashboard.Answered') }}
            <span class="badge badge-secondary float-right">{{ $answeredCount }}</span>
        </a>
        
        <a wire:click.prevent="selectScreen('starred')" href="#" class="list-group-item list-group-item-action @if($screen == 'starred') active @endif border-0">
            <i class="ft-star mr-1"></i> {{ __('dashboard.Starred') }}
            <span class="badge badge-secondary float-right">{{ $starredCount }}</span> 
        </a>

        <a wire:click.prevent="selectScreen('spam')" href="#" class="list-group-item list-group-item-action @if($screen == 'spam') active @endif border-0">
            <i class="ft-alert-octagon mr-1"></i> {{ __('dashboard.Spam') }}
            <span class="badge badge-secondary float-right">{{ $spamCount }}</span>
        </a>
        <a wire:click.prevent="selectScreen('trashed')" href="#" class="list-group-item list-group-item-action @if($screen == 'trashed') active @endif border-0">
            <i class="ft-trash-2 mr-1"></i> {{ __('dashboard.Trash') }}
            <span class="badge badge-secondary float-right">{{ $trashedCount }}</span>
        </a>
    </div>
</div> 

