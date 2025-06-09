@extends('layouts.website.app')

@section('title')
    reset password
@endsection

@section('body')

<section class="login footer-padding">
    <div class="container">
        <div class="login-section">
            <div class="review-form">
                <h5 class="comment-title">Enter Your New Password!</h5>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="formResetPassword" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="review-inner-form">
                        <div class="review-form-name">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                                placeholder="{{ __('Email Address') }}">

                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="review-form-name">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                required autocomplete="new-password" placeholder="{{ __('Password') }}">

                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="review-form-name">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" name="password_confirmation" class="form-control"
                                required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                        </div>
                    </div>

                    <div class="login-btn text-center">
                        <a href="javascript:void(0)" onclick="document.getElementById('formResetPassword').submit()" class="shop-btn">
                            {{ __('Reset Password') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

