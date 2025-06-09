@extends('layouts.website.app')

@section('title')
    Register
@endsection

@section('body')
    <section class="login account footer-padding">
        <div class="container">
            <form action="{{route('website.register')}}" method="POST" >
                @csrf
                <div class="login-section account-section"> 
                    <div class="review-form">
                        <h5 class="comment-title">Create Account</h5>

                        @if ($errors->any()) 
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class=" account-inner-form">
                            <div class="review-form-name">
                                <label for="fname" class="form-label">First Name*</label>
                                <input type="text" name="name" id="fname" class="form-control" placeholder="First Name">
                            </div>
                        </div>

                        <div class=" account-inner-form">
                            <div class="review-form-name">
                                <label for="email" class="form-label">Email*</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="user@gmail.com">
                            </div>
                        </div>

                        <div class=" account-inner-form">
                            <div class="review-form-name">
                                <label for="email" class="form-label">mobile*</label>
                                <input type="number" name="mobile" id="mobile" class="form-control" placeholder="mobile">
                            </div>
                        </div>

                        <div class="review-form-name">
                            @livewire('general.address-drop-down-dependent')
                        </div>


                        <div class="review-form-name address-form">
                            <label for="address" class="form-label">password*</label>
                            <input type="password" name="password" id="address" class="form-control" placeholder="Enter your Address">
                        </div>

                        <div class="review-form-name checkbox">
                            <div class="checkbox-item">
                                <input type="checkbox" name=terms>
                                <p class="remember" >
                                    I agree all terms and condition in <span class="inner-text">{{$setting->site_name}}</span></p>
                            </div>
                        </div>

                        <div class="login-btn text-center">
                            <button type="submit" class="shop-btn">Create an Account</button>
                            <span class="shop-account">Already have an account ?<a href="{{route('website.showLogin')}}">Log In</a></span>
                        </div>
                    </div>
                </div>
            </form>
<br>
<br>
         
        </div>
    </section>
    
@endsection


