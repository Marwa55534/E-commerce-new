<div>
    @if ($screen == 'address')
        <div class="tab-pane fade @if($screen == 'address') show active @endif ">
    <div class="profile-section address-section addresses ">
        <div class="row gy-md-0 g-5">
            <div class="col-md-6">
                <div class="seller-info"> 
                    <h5 class="heading">Address-01</h5>
                    <div class="info-list">
                        <div class="info-title">
                            <p>Name:</p> 
                            <p>Email:</p>
                            <p>Phone:</p>
                            <p>Country:</p>
                            <p>Governorate:</p>
                            <p>City:</p>
                        </div>
                        <div class="info-details">
                            <p>{{$auth_user->name}}</p>
                            <p><a href="https://quomodothemes.website/cdn-cgi/l/email-protection" class="__cf_email__"
                                    data-cfemail="791d1c14161c14181015391e14181015571a1614">{{$auth_user->email}}</a>
                            </p>
                            <p>{{$auth_user->mobile == null ? 'Not Provided' : $auth_user->mobile}}</p>
                            <p>{{$auth_user->country->name}}</p>
                            <p>{{$auth_user->governorate->name}}</p>
                            <p>{{$auth_user->city->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
          
            {{-- <div class="col-lg-6">
                <a href="#" class="shop-btn" onclick="modalAction('.submit')">Add New
                    Address</a>

                <div class="modal-wrapper submit">
                    <div onclick="modalAction('.submit')" class="anywhere-away"></div>

                    <div class="login-section account-section modal-main">
                        <div class="review-form">
                            <div class="review-content">
                                <h5 class="comment-title">Add Your Address</h5>
                                <div class="close-btn">
                                    <img src="assets/images/homepage-one/close-btn.png" onclick="modalAction('.submit')"
                                        alt="close-btn">
                                </div>
                            </div>
                            <div class=" account-inner-form">
                                <div class="review-form-name">
                                    <label for="firstname" class="form-label">First
                                        Name*</label>
                                    <input type="text" id="firstname" class="form-control" placeholder="First Name">
                                </div>
                                <div class="review-form-name">
                                    <label for="lastname" class="form-label">Last Name*</label>
                                    <input type="text" id="lastname" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                            <div class=" account-inner-form">
                                <div class="review-form-name">
                                    <label for="useremail" class="form-label">Email*</label>
                                    <input type="email" id="useremail" class="form-control"
                                        placeholder="user@gmail.com">
                                </div>
                                <div class="review-form-name">
                                    <label for="userphone" class="form-label">Phone*</label>
                                    <input type="tel" id="userphone" class="form-control" placeholder="+880388**0899">
                                </div>
                            </div>
                            <div class="review-form-name address-form">
                                <label for="useraddress" class="form-label">Address*</label>
                                <input type="text" id="useraddress" class="form-control"
                                    placeholder="Enter your Address">
                            </div>
                            <div class=" account-inner-form city-inner-form">
                                <div class="review-form-name">
                                    <label for="usercity" class="form-label">Town /
                                        City*</label>
                                    <select id="usercity" class="form-select">
                                        <option>Choose...</option>
                                        <option>Newyork</option>
                                        <option>Dhaka</option>
                                        <option selected>London</option>
                                    </select>
                                </div>
                                <div class="review-form-name">
                                    <label for="usernumber" class="form-label">Postcode /
                                        ZIP*</label>
                                    <input type="number" id="usernumber" class="form-control" placeholder="0000">
                                </div>
                            </div>
                            <div class="login-btn text-center">
                                <a href="#" onclick="modalAction('.submit')" class="shop-btn">Add
                                    Address</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div> --}}
        </div>
    </div>
</div>
    @endif
</div>