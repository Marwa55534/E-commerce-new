<div>
    <div class="checkout-wrapper">
        {{-- <a href="#" class="shop-btn">Enter Coupon Code</a> --}}
        <div class="account-section billing-section">
            <h5 class="wrapper-heading">Order Summary</h5>
            <div class="order-summery">
                <div class="subtotal product-total">
                    <h5 class="wrapper-heading">PRODUCT</h5>
                    <h5 class="wrapper-heading">QUANTITY</h5>
                    <h5 class="wrapper-heading">TOTAL</h5>
                </div>
                <hr>
                <div class="subtotal product-total">
                    <ul class="product-list">
                        @foreach ($cart->cartItems as $cartItem)
                            <li>
                            <div class="product-info">
                                <h5 class="wrapper-heading">{{$cartItem->product->name}}</h5>
                                <p class="paragraph">
                                    
                                     @if ($cartItem->attributes != null)
                                    @foreach ($cartItem->attributes as $attribute=>$value)
                                        <p style="margin-right: 4px" class="heading">{{$attribute . ':' . $value}}</h4>
                                    @endforeach
                                        
                                    @else
                                       <p class="heading">no attributes</p> 
                                    @endif
                                </p>
                            </div>
                            <div class="price">
                                <h5 class="wrapper-heading">{{$cartItem->quantity}}</h5>
                            </div>
                            
                            <div class="price">
                                <h5 class="wrapper-heading">{{$cartItem->price * $cartItem->quantity}}</h5>
                            </div>
                        </li>
                        @endforeach
                        
                    </ul>
                </div>
                <hr>

                <div class="subtotal product-total">
                    <h5 class="wrapper-heading">SUBTOTAL</h5>
                    <h5 class="wrapper-heading">{{$cart->cartItems->sum(fn($cartItem) => $cartItem->price * $cartItem->quantity)}}</h5>
                </div>
                <div class="subtotal product-total">
                    <ul class="product-list">
                        <li>
                            <div class="product-info">
                                <p class="paragraph">SHIPPING</p>
                            </div>
                            <div class="price">
                                <h5 class="wrapper-heading">+{{$shippingPrice}}</h5>
                            </div>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="subtotal total">
                    <h5 class="wrapper-heading">TOTAL</h5>
                    <h5 class="wrapper-heading price">{{$cart->cartItems->sum(fn($cartItem) => $cartItem->price * $cartItem->quantity) + $shippingPrice}}</h5>
                </div>
                {{-- <div class="subtotal payment-type">
                    <div class="checkbox-item">
                        <input type="radio" id="bank" name="bank">
                        <div class="bank">
                            <h5 class="wrapper-heading">Direct Bank Transfer</h5>
                            <p class="paragraph">Make your payment directly into our bank account.
                                Please use
                                <span class="inner-text">
                                    your Order ID as the payment reference.
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="checkbox-item">
                        <input type="radio" id="cash" name="bank">
                        <div class="cash">
                            <h5 class="wrapper-heading">Cash on Delivery</h5>
                        </div>
                    </div>
                    <div class="checkbox-item">
                        <input type="radio" id="credit" name="bank">
                        <div class="credit">
                            <h5 class="wrapper-heading">Credit/Debit Cards or Paypal</h5>
                        </div>
                    </div>
                </div> --}}
        {{-- <a href="#" class="shop-btn">Enter Coupon Code</a> --}}

                {{-- <a href="#" class="shop-btn">Place Order Now</a> --}}
            </div>
        </div>
    </div>
</div>