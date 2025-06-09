
<div class="form-group">
  <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <button
      class="edit_coupon btn btn-outline-success"
    
    coupon_id="{{ $coupon->id}}"
    coupon_code="{{ $coupon->code}}"
    coupon_discount_percentage="{{ $coupon->discount_percentage}}"
    coupon_limit="{{ $coupon->limit}}"
    coupon_start_date="{{ $coupon->start_date}}"
    coupon_end_date="{{ $coupon->end_date}}"
    coupon_is_active="{{ $coupon->is_active}}"  

    >
      {{ __('dashboard.edit') }} <i class="la la-edit"></i>
    </button>
    
    <a href="{{route('coupons.edit', $coupon->id)}}" type="button" class="btn btn-outline-info">{{ __('dashboard.status') }} <i class="la la-stop"></i></a>
    
      <button id="btnGroupDrop2" coupon_id="{{$coupon->id}}" type="button" class="delete_comfirm_coupon btn btn-outline-danger">
      {{ __('dashboard.delete') }}<i class="la la-trash"></i>
      </button> 

  </div>
</div>