@extends('layouts.website.app')

@section('title')
    wishlist Table
@endsection

@section('body')
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{route('website.home')}}">Home</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:void(0)">Wishlist</a></span>
            </div>
            {{-- <div class="blog-heading about-heading">
                <h1 class="heading">Wishlist</h1>
            </div> --}}
        </div>
    </section>

    <section class="cart product wishlist footer-padding" data-aos="fade-up">
        @livewire('website.wishlist.wishlist-table',['Wishlists'=>$Wishlists])
    </section>
@endsection