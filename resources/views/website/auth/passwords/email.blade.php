@extends('layouts.website.app')

@section('title')
    email
@endsection

@section('body')

<section class="login footer-padding">
    <div class="container">
        <div class="login-section">
            <div class="review-form">
                <h5 class="comment-title">{{ __('Enter Your Email!') }}</h5>

                @if ($errors->any()) 
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="formSendOtp" method="POST" action="{{ route('website.sendOtp') }}">
                    @csrf

                    <div class="review-inner-form">
                        <div class="review-form-name">
                            <label for="email" class="form-label">{{ __('dashboard.email') }}</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-control" 
                                placeholder="{{ __('dashboard.email') }}" 
                                required 
                                autofocus
                            />
                        </div>
                    </div>

                    <div class="login-btn text-center">
                        <a href="javascript:void(0)" onclick="document.getElementById('formSendOtp').submit()" class="shop-btn">
                            {{ __('Send Password Reset Link') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


{{-- <section class="login footer-padding">
    <div class="container">
        <div class="login-section">
            <div class="review-form">
                <h5 class="h4 text-gray-900 mb-4">{{ __('Enter Your Email!') }}</h5>

                
                @if ($errors->any()) 
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('website.sendOtp') }}">
                    @csrf

                    <div class="review-inner-form">
                        <div class="review-form-name mb-3">
                            <label for="email" class="form-label">{{ __('dashboard.email') }}</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-control" 
                                placeholder="{{ __('dashboard.email') }}" 
                                required 
                                autofocus
                            />
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section> --}}

@endsection 
