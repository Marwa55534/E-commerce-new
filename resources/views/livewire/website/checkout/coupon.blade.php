<div>
    @if ($couponInfo != null)
        <p class="paragraph" style="coler: red">{{$couponInfo}}</p>
    @endif
  
    @if ($cartItemsCount > 0 && $cart->coupon == null)
    <div class="account-inner-form">
        <div class="review-form-name">
            <input wire:model="code"  class="form-control" placeholder="coupon code">
            <button wire:click="applyCode" type="button" class="shop-btn">Aplay</button>
        </div>
    </div>
    @endif
</div>


@script
<script>
    // lisnting
    $wire.on('couponApplied', (event) => {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: event,
            showConfirmButton: false,
            timer: 1500
        });
    });

     // lisnting
    $wire.on('couponNotVaild', (event) => {
        Swal.fire({
            position: "top-center",
            icon: "error",
            title: event,
            showConfirmButton: false,
            timer: 1500
        }); 
    });
</script>
@endscript 
