<div>
    <div class="content-wrapper">
        <div class="content-body">
            <div class="card email-app-details d-none d-lg-block">
                <div class="card-content">
                    @if ($contact)
                        <!-- Email Options (Buttons) -->
                        <div class="email-app-options card-body d-flex justify-content-between align-items-center">
                            <!-- Left Side Buttons -->
                            <div class="btn-group"> 
                                <button type="button" wire:click.prevent="replayContact({{ $contact->id }})"
                                    class="btn btn-primary" data-toggle="tooltip" title="{{ __('dashboard.Reply') }}">
                                    <i class="la la-reply"></i>
                                </button>

                                <button type="button" wire:click.prevent="markAsSpam({{ $contact->id }})"
                                    class="btn btn-warning" data-toggle="tooltip" title="{{ __('dashboard.Report_Spam') }}">
                                    <i class="ft-alert-octagon"></i>
                                </button>

                                <button @if($contact->deleted_at != null ) wire:click.prevent="forceDeleteContact({{ $contact->id }})" @else wire:click.prevent="deleteContact({{ $contact->id }})" @endif type="button"
                                    class="btn btn-danger" data-toggle="tooltip" @if($contact->deleted_at != null ) title="{{ __('dashboard.Force_Delete') }}" @else title="{{ __('dashboard.delete') }}" @endif >
                                    <i class="ft-trash-2"></i>
                                </button>

                               
                            </div>

                            <!-- Right Side More Options -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('dashboard.More') }}
                                </button> 
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" wire:click.prevent="markUnread({{ $contact->id }})" href="#">{{ __('dashboard.Mark_as_Unread') }}</a>
                                    <a class="dropdown-item" wire:click.prevent="markUnstarred({{ $contact->id }})" href="#">{{ __('dashboard.Mark_as_Unstarred') }}</a>
                                    <a class="dropdown-item" wire:click.prevent="markUnspam({{ $contact->id }})" href="#">{{ __('dashboard.mark_as_Unspam') }}</a>
                                    <a wire:click.prevent="forceDeleteContact({{ $contact->id }})" class="dropdown-item" href="#">{{ __('dashboard.Force_Delete') }}</a>
                                    @if ($contact->deleted_at != null)
                                        <a wire:click.prevent="restoreContact({{ $contact->id }})" class="dropdown-item" href="#">{{ __('dashboard.Restore') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Email Title -->
                        <div class="email-app-title card-body">
                            <h3 class="list-group-item-heading">{{ $contact->title }}</h3>
                            <p class="list-group-item-text">
                                <span class="badge badge-primary">{{ __('dashboard.Show_Message') }}</span>
                                <i class="float-right font-medium-3 ft-star warning"></i>

                            </p>
                        </div>

                        <!-- Message Content -->
                        <div class="media-list">
                            <div id="headingCollapse1" class="card-header p-0">
                                <a data-toggle="collapse" href="#collapse1" aria-expanded="true"
                                    aria-controls="collapse1"
                                    class="collapsed email-app-sender media border-0 bg-blue-grey bg-lighten-5">
                                    <div class="media-left pr-1">
                                        <span class="avatar avatar-md">
                                            <img class="media-object rounded-circle"
                                                src="{{ asset('assets/dashboard/images/avatar.jpg') }}"
                                                alt="Generic placeholder image">
                                        </span>
                                    </div>
                                    <div class="media-body w-100">
                                        <h6 class="list-group-item-heading">{{ $contact->name }}</h6>
                                        <p class="list-group-item-text">{{ $contact->subject }}
                                            <span class="float-right text-muted">{{ $contact->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1"
                                class="card-collapse collapse" aria-expanded="true">
                                <div class="card-content">
                                    <div class="card-body">
                                        <p>{{ $contact->message }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="text-center p-3">
                            <h5>{{ __('dashboard.No_Messages_Found') }}</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
