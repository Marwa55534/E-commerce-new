@extends('layouts.website.app')

@section('title')
    Login
@endsection

@section('body')
    <section class="login footer-padding">
        <div class="container">
            <div class="login-section">
                <div class="review-form">
                    <h5 class="comment-title">{{__('dashboard.login')}}</h5>
                    @if ($errors->any()) 
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    
                    <form id="formLogin" action="{{route('website.login')}}" method="POST">
                        @csrf
                        <div class="review-inner-form">
                            <div class="review-form-name">
                                <label for="email" class="form-label">{{__('dashboard.email')}}</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="{{__('dashboard.email')}} "/>
                            </div>
                            <div class="review-form-name">
                                <label for="password" class="form-label">{{__('dashboard.password')}}</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="{{__('dashboard.password')}}" />
                            </div>
                            <div class="review-form-name checkbox">
                                <div class="checkbox-item">
                                    <input type="checkbox" name="remember"/>
                                    <span class="address"> Remember Me</span>
                                </div>
                                <a href="{{route('website.password.showEmail')}}" class="forget-pass">
                                    <p>Forgot password?</p>
                                </a>
                            </div>
                        </div>
                        <div class="login-btn text-center">
                            <a href="javascript:void(0)" onclick="document.getElementById('formLogin').submit()" class="shop-btn">{{__('dashboard.login')}}</a>
                            <span class="shop-account">Dont't have an account ?<a href="{{route('website.showRegister')}}">Sign Up
                                    Free</a></span>
                        </div> 
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
