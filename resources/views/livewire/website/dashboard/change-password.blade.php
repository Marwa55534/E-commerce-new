<div>
@if ($screen == 'change_password')
        <div class="tab-pane fade @if($screen == 'change_password') show active @endif" >
    <div class="row align-items-center">
        <div class="col-lg-6">
            <div class="form-section"> 
                <form action="#">
                    <div class="currentpass form-item">
                        <label for="currentpass" class="form-label">Current Password*</label>
                        <input wire:model="old_password" type="password" class="form-control" id="currentpass" placeholder="******">
                    </div>
                    <div class="password form-item">
                        <label for="pass" class="form-label">Password*</label>
                        <input wire:model="password" type="password" class="form-control" id="pass" placeholder="******">
                    </div>
                    <div class="re-password form-item">
                        <label for="repass" class="form-label">Re-enter Password*</label>
                        <input wire:model="password_confirmation" type="password" class="form-control" id="repass" placeholder="******">
                    </div>
                </form>
                <div class="form-btn">
                    <a href="javascript:void(0)" wire:click="upldatePassword" class="shop-btn">Update Password</a>
                    <a href="javascript:void(0)" wire:click="resetForm" class="shop-btn cancel-btn">Cancel</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="reset-img text-end">
                <img src="{{asset('assets/website/assets/images/homepage-one/reset.webp')}}" alt="reset">
            </div>
        </div>
    </div>
</div>
@endif
</div>

@script
<script>
    $wire.on('passwordUpdated', (event) => {
        Swal.fire({ 
            position: "top-center",
            icon: "success",
            title: event,
            showConfirmButton: false,
            timer: 1500
        }); 
    });

    $wire.on('oldPasswordNotMatched', (event) => {
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