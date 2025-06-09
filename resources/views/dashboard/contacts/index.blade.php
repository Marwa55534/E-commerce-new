@extends('layouts.dashboard.app')
@section('title')
    {{ __('dashboard.contacts') }}
@endsection

@section('body')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="row justify-content-center" style="display: flex; justify-content: center;">
                    <div class="card w-100 p-3">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control">
                                {{ __('dashboard.contacts') }}
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
                            <div class="card-body">
                                <div class="sidebar-left col-6">
                                    <div class="">
                                        <div class="sidebar-content email-app-sidebar d-flex">
                                            {{-- sidebar --}}
                                            <div class="email-app-menu col-md-4 card d-none d-lg-block">
                                                @livewire('dashboard.contact.contact-sidebar')
                                            </div>
                                            {{-- content Messages  --}}
                                            <div class="email-app-list-wraper col-md-8 card p-0">
                                                @livewire('dashboard.contact.contact-messages')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- content show --}}
                                <div class="content-right col-6">
                                    @livewire('dashboard.contact.contact-show')
                                    @livewire('dashboard.contact.replay-contact')
                                </div>
                            </div>
                    </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('delete-contact', (event) => {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: event,
            showConfirmButton: false,
            timer: 1500
        });
       });
    });
</script>
@endpush 