<div class="form-group">
  <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

    {{-- edit --}}
    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary ">
        {{ __('dashboard.edit') }} <i class="la la-eye"></i>
    </a>


      <button product-id="{{ $product->id }}"  type="button" class="btn btn-outline-info status_btn"> 
          {{ __('dashboard.status_management') }} <i class="la la-stop"></i>
      </button>
      {{-- show --}}
      <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary ">
          {{ __('dashboard.show_product') }} <i class="la la-eye"></i>
      </a>

{{-- delete --}}
      <button id="btnGroupDrop2" product-id="{{ $product->id }}" type="button"
          class="delete_confirm_btn btn btn-outline-danger">
          {{ __('dashboard.delete') }}<i class="la la-trash"></i>
      </button>


  </div>
</div>