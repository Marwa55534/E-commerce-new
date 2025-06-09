
<table class="table table-responsive-sm">

        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('dashboard.name') }}</th>
                <th scope="col">{{ __('dashboard.email') }} </th>
                <th scope="col">{{ __('dashboard.role') }} </th>
                <th scope="col">{{ __('dashboard.status') }} </th>
                <th scope="col">{{ __('dashboard.created_at') }} </th>
                <th scope="col">{{ __('dashboard.operations') }} </th>
            </tr>
        </thead>
        <tbody>

            @forelse ($admins as $admin)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $admin->name }} </td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->role->role }}</td>
                    <td>{{ $admin->status }}</td>
                    <td>{{ $admin->created_at->format('Y-m-d h:m a')}}</td>
                    
                    <td>
                        <div class="dropdown float-md-left">
                            <button class="btn btn-danger dropdown-toggle round btn-glow px-2"
                                id="dropdownBreadcrumbButton" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">{{ __('dashboard.operations') }}</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton">

                                {{-- edit --}}
                                <a class="dropdown-item" href="{{ route('admins.edit', $admin->id) }}"><i
                                    class="la la-edit"></i>{{ __('dashboard.edit') }}</a>

                                    {{-- changeStatus --}}
                                <a class="dropdown-item" href="{{ route('admins.changeStatus', $admin->id) }}"><i
                                    class="la @if($admin->status == 'Active') la-toggle-on @else la-toggle-off @endif"></i>@if($admin->status == 'Active') {{ __('dashboard.Deactivate') }} @else {{ __('dashboard.Activate') }} @endif</a>

                                    {{-- delete --}}
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="javascript:void(0)"
                                    onclick="if(confirm('Are you sure you want to delete this admin?')){document.getElementById('delete-form-{{ $admin->id }}').submit();} return false"><i
                                        class="la la-trash"></i> {{ __('dashboard.delete') }}</a>
                            </div>
                        </div>
                    </td>
                </tr>


                {{-- delete form  --}}
                <form id="delete-form-{{ $admin->id }}"
                    action="{{ route('admins.destroy', $admin->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                </form>


            @empty
                <td colspan="4"> No Data</td>
            @endforelse
        </tbody>
    </table>




