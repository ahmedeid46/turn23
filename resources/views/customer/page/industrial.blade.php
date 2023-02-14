@extends('customer.layout.master')
@section('style')

@endsection
@section('script')

@endsection
@section('popup')

@endsection
@section('content')
    <main class="main">
        <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase" data-owl-options="{'loop': false}">
            <div class="home-slide home-slide1 banner">
                <img class="slide-bg" src="{{ asset('assets/customer') }}/images/1.png" width="1903" height="499" alt="slider image">
                <div class="container d-flex align-items-center">
                    <div class="banner-layer appear-animate" data-animation-name="fadeInUpShorter">
                        <h4 style="color: white;font-size: 30px" class="text-transform-none m-b-3">Our industrial products !</h4>
                        <h5 class="d-inline-block mb-0">
                            <span>With us</span>
                            <b class="coupon-sale-text text-white bg-secondary align-middle">Coming soon</b>
                        </h5>
                        <a href="categories.html" class="btn btn-dark btn-lg">About us</a>
                    </div>
                    <!-- End .banner-layer -->
                </div>
            </div>
            <!-- End .home-slide -->
            <!-- End .home-slide -->
        </div>
        <!-- End .home-slider -->
    </main>
    <!-- End .main -->

@endsection
