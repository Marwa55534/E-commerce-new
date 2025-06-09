@extends('layouts.website.app')

@section('title')
    checkout
@endsection

@section('body')

    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="index-2.html">Home</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:void(0)">Checkout</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">Checkout</h1>
            </div>
        </div>
    </section>


    <section class="checkout product footer-padding">
        <div class="container">
            <div class="checkout-section">
                <div class="row gy-5">
                    <div class="col-lg-6">
                        {{-- shipp --}}
                        @livewire('website.checkout.shipping-details')
                    </div>

                    <div class="col-lg-6">
                        {{-- cart deta --}}
                        @livewire('website.checkout.order-summary')

                        <div class="review-form">
                            @livewire('website.checkout.coupon')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection