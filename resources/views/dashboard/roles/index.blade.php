@extends('layouts.dashboard.app') 

@section('title')
     Roles
@endsection

@section('body')

<div class="app-content content" > 
     <div class="content-wrapper">
         <div class="content-header row" >
             <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                 <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.Basic_Forms')}}</h3>
                 <div class="row breadcrumbs-top d-inline-block">
                     <div class="breadcrumb-wrapper col-12"> 
                         <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a
                                     href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a>
                             </li>
                             <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">{{ __('dashboard.roles') }}</a>
                             </li>
                             <li class="breadcrumb-item active"><a href="{{ route('roles.create') }}">{{ __('dashboard.create_role') }}</a>
                             </li>
                         </ol>
                     </div>
                 </div>
             </div>
             <div class="content-header-right col-md-6 col-12">
                 <div class="dropdown float-md-right">
                     <button class="btn btn-danger dropdown-toggle round btn-glow px-2" id="dropdownBreadcrumbButton"
                         type="button" data-toggle="dropdown" aria-haspopup="true"
                         aria-expanded="false">Actions</button>
                     <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a class="dropdown-item"
                             href="#"><i class="la la-calendar-check-o"></i> Calender</a>
                         <a class="dropdown-item" href="#"><i class="la la-cart-plus"></i> Cart</a>
                         <a class="dropdown-item" href="#"><i class="la la-life-ring"></i> Support</a>
                         <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i
                                 class="la la-cog"></i> Settings</a>
                     </div>
                 </div>
             </div>
         </div>
         <div class="content-body">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.roles') }} </h4>
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

                 <div class="card-content" >
                     <div class="card-body">
                         <a href="{{ route('roles.create') }}" class="btn btn-primary">{{ __('dashboard.add') }}</a><br><br>
                         <table class="table table-responsive-sm">
                             <thead>
                                 <tr>
                                     <th scope="col">#</th>
                                     <th scope="col">{{ __('dashboard.role_name') }}</th>
                                     <th scope="col">{{ __('dashboard.role_permissions') }} </th>
                                     <th scope="col">{{ __('dashboard.operations') }} </th>
                                 </tr>
                             </thead>
                             <tbody>

                                 @forelse ($roles as $role)
                                     <tr>
                                         <th scope="row">{{ $loop->iteration }}</th>
                                         <td>{{ $role->role }} </td>
                                         <td>

                                            @if (config('app.locale') == 'ar')
                                                @foreach ($role->permession as $perm)
                                                    @foreach (Config::get('permessions_ar') as $key=>$value )
                                                        {{ $key== $perm ? $value . ' , ' : '' }}
                                                    @endforeach
                                                @endforeach
                                             @else
                                                @foreach ($role->permession as $perm) 
                                                    {{ $perm }},
                                                @endforeach
                                             @endif

                                         </td> 
                                         <td>
                                              <div class="dropdown float-md-left">
                                                 <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                                     id="dropdownBreadcrumbButton" type="button" data-toggle="dropdown"
                                                     aria-haspopup="true" aria-expanded="false">{{ __('dashboard.operations') }} </button>
                                                 <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton">
                                                     <a class="dropdown-item" href="{{ route('roles.edit' , $role->id) }}"><i
                                                         class="la la-edit"></i>{{ __('dashboard.edit') }}</a>   

                                                      <div class="dropdown-divider"></div><a class="dropdown-item"
                                                         href="javascript:void(0)"
                                                         onclick="if(confirm('Are you sure you want to delete this role?')){document.getElementById('delete-form-{{ $role->id }}').submit();} return false"><i
                                                            class="la la-trash"></i> {{ __('dashboard.delete') }}</a> 
                                                 </div>
                                             </div>
                                         </td> 
                                     </tr>


                                     {{-- delete form  --}}
                                     <form id="delete-form-{{ $role->id }}"
                                         action="{{ route('roles.destroy', $role->id) }}" method="post">
                                         @csrf
                                         @method('DELETE')
                                     </form>


                                 @empty
                                     <td colspan="4"> No Data</td>
                                 @endforelse
                             </tbody>
                         </table>
                         {{-- {{ $roles->links() }} --}}
                        <div id="ajax_paginate">

                            {{$roles->appends(request()->query())->links()}} 
                        </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

@endsection

@push('js') 

<script> 
    $(document).on('click' , '#ajax_paginate a' , function(e){
        e.preventDefault();

        var link = $(this).attr('href');

            $.ajax({
                url: link,
                type:'GET',
                dataType:'html',

                success:function(data){ 
                    // $('#ajax_paginate').html(data)

                    // تحديث الجدول والمحتوى
                    $('table tbody').html($(data).find('table tbody').html());
                    // تحديث التصفح
                    $('#ajax_paginate').html($(data).find('#ajax_paginate').html());
                },
            });
        });
</script> 
@endpush
