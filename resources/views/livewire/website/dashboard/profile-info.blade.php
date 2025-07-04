<div>
    @if ($screen == 'parsonal_info')
        <div class="tab-pane fade @if($screen == 'parsonal_info') show active @endif">
            <div class="seller-application-section">
                <div class="row ">
                    <div class="col-lg-7">
                        <div class=" account-section">
                            <div class="review-form">
                                <div class=" account-inner-form">
                                    <div class="review-form-name">
                                        <label for="firname" class="form-label">Name*</label>
                                        <input wire:model="name" type="text" id="firname" class="form-control"
                                            placeholder="Name">
                                    </div>

                                </div>
                                <div class=" account-inner-form">
                                    <div class="review-form-name">
                                        <label for="gmail" class="form-label">Email*</label>
                                        <input wire:model="email" type="email" id="gmail" class="form-control"
                                            placeholder="user@gmail.com">
                                    </div>
                                    <div class="review-form-name">
                                        <label for="telephone" class="form-label">mobile*</label>
                                        <input wire:model="mobile" type="tel" id="telephone" class="form-control"
                                            placeholder="+880388**0899">
                                    </div>
                                </div>
                                
                                <div class="review-form-name">
                                    <label for="region">Country</label>
                                    <select name="country_id" wire:model.live="country_id" class="form-control"
                                        id="region">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>

                                <div class="review-form-name">
                                    <label for="region">Governorate</label>
                                    <select name="governorate_id" wire:model.live="governorate_id" class="form-control"
                                        id="region">
                                        @foreach ($governorates as $governorate)
                                            <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>

                                <div class="review-form-name">
                                    <label for="city_id">City</label>
                                    <select name="city_id" wire:model.live="city_id" class="form-control" id="region">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>

                                <div class="submit-btn">
                                    <a href="javascript:void(0)" wire:click="cancel" class="shop-btn cancel-btn">Cancel</a>
                                    <a href="javascript:void(0)" wire:click="updateProfile" class="shop-btn update-btn">Update Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="img-upload-section">
                            <div class="logo-wrapper">
                                <h5 class="comment-title">Update Logo</h5>
                                <p class="paragraph">Size300x300. Gifs work
                                    too.Max 5mb.</p>
                                <div class="logo-upload">
                                    <img src="assets/images/homepage-one/sallers-cover.png" alt="upload" class="upload-img"
                                        id="upload-img">
                                    <div class="upload-input">
                                        <label for="input-file">
                                            <span>
                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M16.5147 11.5C17.7284 12.7137 18.9234 13.9087 20.1296 15.115C19.9798 15.2611 19.8187 15.4109 19.6651 15.5683C17.4699 17.7635 15.271 19.9587 13.0758 22.1539C12.9334 22.2962 12.7948 22.4386 12.6524 22.5735C12.6187 22.6034 12.5663 22.6296 12.5213 22.6296C11.3788 22.6334 10.2362 22.6297 9.09365 22.6334C9.01498 22.6334 9 22.6034 9 22.536C9 21.4009 9 20.2621 9.00375 19.1271C9.00375 19.0746 9.02997 19.0109 9.06368 18.9772C10.4123 17.6249 11.7609 16.2763 13.1095 14.9277C14.2295 13.8076 15.3459 12.6913 16.466 11.5712C16.4884 11.5487 16.4997 11.5187 16.5147 11.5Z"
                                                        fill="white"></path>
                                                    <path
                                                        d="M20.9499 14.2904C19.7436 13.0842 18.5449 11.8854 17.3499 10.6904C17.5634 10.4694 17.7844 10.2446 18.0054 10.0199C18.2639 9.76139 18.5261 9.50291 18.7884 9.24443C19.118 8.91852 19.5713 8.91852 19.8972 9.24443C20.7251 10.0611 21.5492 10.8815 22.3771 11.6981C22.6993 12.0165 22.7105 12.4698 22.3996 12.792C21.9238 13.2865 21.4443 13.7772 20.9686 14.2717C20.9648 14.2792 20.9536 14.2867 20.9499 14.2904Z"
                                                        fill="white"></path>
                                                </svg>
                                            </span>
                                        </label>
                                        <input type="file" accept="image/jpeg, image/jpg, image/png, image/webp"
                                            id="input-file">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>


@script
<script>
    $wire.on('profileUpdated', (event) => {
        Swal.fire({ 
            position: "top-center",
            icon: "success",
            title: event,
            showConfirmButton: false,
            timer: 1500
        }); 
    });
</script>
@endscript 