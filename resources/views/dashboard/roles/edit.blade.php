@extends('layouts.dashboard.app')

@section('title')
    Edit Role
@endsection

@section('body')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
              <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.Basic_Forms')}}</h3>
              <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.welcome')}}">{{ __('dashboard.home')}}</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('roles.index')}}">{{ __('dashboard.role')}}</a>
                    </li>
                    <li class="breadcrumb-item active"><a href="#">{{ __('dashboard.edit_role')}}</a>
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>

<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.edit_role')}}</h4>
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
      <div class="card-content collapse show">
        <div class="card-body">
         @include('dashboard.includes.validation-error') 
          <form class="form" action="{{route('roles.update' , $role->id)}}" method="POST">
            @csrf
            @method('PUT') 
            <div class="form-body">
              <input hidden name="id" value="{{$role->id}}"> 

              <h4 class="form-section"><i class="la la-eye"></i>{{ __('dashboard.edit_role')}}</h4>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="userinput1">{{ __('dashboard.role_ar')}}</label>
                    <input type="text" id="userinput1" class="form-control border-primary" placeholder="{{ __('dashboard.role')}}"
                    name="role[ar]" value="{{$role->getTranslation('role','ar')}}">
                  </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <label for="userinput1">{{ __('dashboard.role_en')}}</label>
                      <input type="text" id="userinput1" class="form-control border-primary" placeholder="{{ __('dashboard.role')}}"
                      name="role[en]" value="{{$role->getTranslation('role','en')}}">
                    </div>
                  </div>
              </div>

            <div class="row">
             @if (Config::get('app.locale') == 'ar')
             @foreach (config('permessions_ar') as $Key=>$value)
             <div class="col-md-4">
               <input value="{{ $Key }}" type="checkbox" name="permession[]" class="checkbox" @checked(in_array($Key , $role->permession))>
               <label>{{$value}}</label>
             </div>
             @endforeach

             @else 
             @foreach (config('permessions_en') as $Key=>$value)
             <div class="col-md-4">
               <input value="{{ $Key }}" type="checkbox" name="permession[]" class="checkbox" @checked(in_array($Key , $role->permession))>
               <label>{{$value}}</label>
             </div>
             @endforeach

             @endif
            </div>

            <div class="form-actions right">
              <button type="button" class="btn btn-warning mr-1">
                <i class="ft-x"></i>{{ __('dashboard.cancel')}}</button>

              <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> {{ __('dashboard.save')}}</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection
