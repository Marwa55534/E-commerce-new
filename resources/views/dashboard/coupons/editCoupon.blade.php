<!-- Modal -->
<div class="modal fade" id="editCouponModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.edit_coupon') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{-- validations error --}}
                <div class="alert alert-danger" id="error_div_edit" style="display: none;">
                    <ul id="error_list_edit"></ul>
                </div>


                <form action="" id="updateCoupon" class="form" method="POST" >
                    @csrf
                    @method('PUT')
                    <input id="coupon_id" hidden name="id" value="">
                    <div class="form-group">
                        <label for="code">{{ __('dashboard.code') }}</label>
                        <input type="text" id="coupon_code" name="code" class="form-control"
                            placeholder="{{ __('dashboard.code') }}">
                            <strong class="text-danger" id="error_code"></strong>
                    </div> 
                    <div class="form-group">
                        <label for="discount_percentage">{{ __('dashboard.discount_percentage') }}</label>
                        <input type="number" id="coupon_discount_percentage" name="discount_percentage" class="form-control" 
                            placeholder="{{ __('dashboard.discount_percentage') }}">
                            <strong class="text-danger" id="error_discount_percentage"></strong>

                    </div>

                    <div class="form-group">
                        <label for="limitation">{{ __('dashboard.limit') }}</label>
                        <input type="number" id="coupon_limit" name="limit" class="form-control"
                            placeholder="{{ __('dashboard.limit') }}">
                            <strong class="text-danger" id="error_limit"></strong>

                    </div>

                    <div class="form-group">
                        <label for="">{{ __('dashboard.start_date') }}</label>
                        <input type="date" id="coupon_start_date" name="start_date" class="form-control" 
                            placeholder="{{ __('dashboard.start_date') }}">
                            <strong class="text-danger" id="error_start_date"></strong>

                    </div>

                    <div class="form-group">
                        <label for="limitation">{{ __('dashboard.end_date') }}</label>
                        <input type="date" id="coupon_end_date" name="end_date" class="form-control" 
                            placeholder="{{ __('dashboard.end_date') }}">
                            <strong class="text-danger" id="error_end_date"></strong>

                    </div>

                    <div class="form-group">
                        <label>{{ __('dashboard.is_active') }}</label>
                        <div class="input-group">
                            <div class="d-inline-block custom-control custom-radio mr-1">
                                <input type="radio" value="1"  name="is_active" class="custom-control-input"
                                id="coupon_active">
                                <label class="custom-control-label" for="yes1">{{ __('dashboard.active') }}</label>
                            </div>
                            <div class="d-inline-block custom-control custom-radio">
                                <input type="radio" value="0"  name="is_active" class="custom-control-input"
                                    id="coupon_inactive">
                                <label class="custom-control-label" for="no1">{{ __('dashboard.inactive') }}</label>
                            </div>

                            <strong class="text-danger" id="error_is_active"></strong>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"><i class="ft-x"></i>{{ __('dashboard.close') }}</button>
                        <button type="submit" class="btn btn-primary">  <i class="la la-check-square-o"></i> {{ __('dashboard.save') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>