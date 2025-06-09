<div>
    <div class="email-app-list">
        {{-- Search --}}
        <div class="card-body chat-fixed-search">
            <fieldset class="form-group position-relative has-icon-left m-0 pb-1">
                <input type="text" wire:model.live="itemSearch" class="form-control" id="iconLeft4" placeholder="Search email">
                <div class="form-control-position">
                    <i class="ft-search"></i>
                </div>
            </fieldset>
        </div>

        <div id="users-list" class="list-group"> 
            <div class="users-list-padding media-list">
                
                @forelse ($contacts as $contact)
                <a @if ($contact->id == $opendContactId) style="background-color: dodgerblue" @endif wire:click.prevent="showContact({{$contact->id}})" href="#" class="media border-0">
                    <div class="media-left pr-1">
                        <span class="avatar avatar-md">
                            <span class="media-object rounded-circle text-circle bg-info">{{ strtoupper(substr($contact->name, 0, 1)) }}</span>
                            {{-- <span class="media-object rounded-circle text-circle bg-info">T</span> --}}
                        </span>
                    </div>
                    <div class="media-body w-100">
                        <h6 class="list-group-item-heading text-bold-500">{{ $contact->name }}
                            <span class="float-right">
                                <span class="font-small-2 primary">{{ $contact->created_at->diffForHumans() }}</span>
                            </span>
                        </h6>
                        <p class="list-group-item-text text-truncate text-bold-600 mb-0">
                            {{$contact->subject}}</p>
                        <p class="list-group-item-text mb-0">{{$contact->Message}}
                            <span class="float-right primary">
                                @if($contact->is_read == 0)
                                <span class="badge badge-danger mr-1">{{ __('dashboard.New_Contact') }}</span> 
                                @else
                                <span class="badge badge-success mr-1">{{ __('dashboard.Readed') }}</span> 
                                @endif
                                <button wire:click.prevent="markAsStarred({{ $contact->id }})" class="btn btn-link">
                                    <i class="ft-star {{ $contact->is_starred ? 'text-warning' : 'text-muted' }}"></i>
                                </button>
                                {{-- <i class="font-medium-1 ft-star blue-grey lighten-3"></i> --}}
                            </span>
                        </p>
                    </div>
                </a>
                @empty
                    <div class="text-center">
                        {{ __('dashboard.No_Messages_Found') }}
                    </div>
                @endforelse
               {{ $contacts->links('vendor.livewire.simple-bootstrap')}}
            </div>
        </div>
    </div>
</div>
