@extends('layouts.website.app')

@section('title')
Categories
@endsection

@section('body')

<section class="blog about-blog">
    <div class="container">
        <div class="blog-bradcrum">
            <span><a href="{{route('website.home')}}">{{__('website.home')}}</a></span>
            <span class="devider">/</span>
            <span><a href="javascript:void(0)" class="active">Categories</a></span>
        </div>
        <div class="blog-heading about-heading">
            <h1 class="heading">Categories</h1>
        </div>
    </div>
</section>

 {{-- some category section --}} 
 <section class="product-category">
    <div class="container">
        {{-- <div class="section-title">
            <h5>Our Categories</h5>
            <br><br><br><br>
            <a href="javascript:void(0)" class="view"> All Categories</a>
        </div> --}}
        <div style="margin-bottom: 80px" class="category-section">
            @foreach ($categories as $category)
            <div class="product-wrapper" data-aos="fade-right" data-aos-duration="100">
                <div class="wrapper-img"> 
                    <img src="{{ asset($category->icon)}}" alt="{{$category->name}}">
                </div> 
                
                <div class="wrapper-info">
                    <a href="{{ route('website.categories.products', $category->slug) }}" class="wrapper-details">{{$category->name}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
</section>
@endsection
