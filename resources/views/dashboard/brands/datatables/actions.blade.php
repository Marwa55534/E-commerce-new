
<div class="form-group">
  <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <a href="{{route('brands.edit', $brand->id)}}" class="btn btn-outline-success">{{ __('dashboard.edit') }} <i class="la la-edit"></i></a>
    <a href="{{route('brands.edit', $brand->id)}}" type="button" class="btn btn-outline-info">{{ __('dashboard.status') }} <i class="la la-stop"></i></a>
    <div class="btn-group" role="group">
      <button id="btnGroupDrop2" type="button" class="btn btn-outline-danger dropdown-toggle"
      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      {{ __('dashboard.delete') }}<i class="la la-trash"></i>
      </button> 
      <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
        <form action="{{route('brands.destroy',$brand->id)}}" method="POST">
          @csrf
          @method('DELETE') 
          <button type="submit" class="delete_comfirm  dropdown-item">{{ __('dashboard.delete') }}</button>
        </form> 
      </div>
    </div>
  </div>
</div>