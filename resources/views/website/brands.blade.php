@extends('layouts.website.app')

@section('title')
    Brands
@endsection

@section('body')

<section class="blog about-blog">
    <div class="container">
        <div class="blog-bradcrum">
            <span><a href="{{route('website.home')}}">{{__('website.home')}}</a></span>
            <span class="devider">/</span>
            <span><a href="javascript:void(0)" class="active">Brands</a></span>
        </div>
        <div class="blog-heading about-heading">
            <h1 class="heading">Brands</h1>
        </div>
    </div>
</section>

<section class="product brand" data-aos="fade-up">
    <div class="container">
        {{-- <div class="section-title">
            <h5>Brand of Prodcuts</h5>
            <a href="javascript:void(0)" class="view"> All Brands</a>
        </div> --}}
        <div style="margin-bottom: 80px" class="brand-section">
            @foreach ($brands as $brand)
            <div style="margin: 6px" class="product-wrapper">
                <div class="wrapper-img">
                    <a href="{{ route('website.brands.products', $brand->slug)}}">
                        <img src="{{ asset($brand->logo)}}" alt="{{$brand->name}}">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
