
<div class="form-group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

        <a href="{{route('dashboard.order.show', $order->id)}}" class="btn btn-outline-success">
            {{ __('dashboard.show') }} <i class="la la-eye"></i>
        </a>


        <button type="button" id="btnGroupDrop2" order_id="{{$order->id}}" class="delete_confirm_btn btn btn-outline-danger">
            {{ __('dashboard.delete') }} <i class="la la-trash"></i>
        </button>      
    </div> 
</div>