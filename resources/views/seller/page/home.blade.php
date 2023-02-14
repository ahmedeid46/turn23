@extends('seller.layout.master')
@section('styles')
@endsection
@section('script')
@endsection
@section('content')
    <main class="main">


        <div class="container account-container custom-account-container">
            <div class="container">
                <h2 class="section-title heading-border ls-20 border-0">Categories</h2>
                @foreach($cats as $cat)
                    <div class="container">
                        <section class="promo-section bg-dark" data-parallax="{'speed': 2, 'enableOnMobile': true}" data-image-src="http://vendor.zatech.tech/assets/customer/images/demoes/demo4/banners/banner-5.jpg" style="position: relative; overflow: hidden;"><div class="parallax-background" style="background-image: url(&quot;http://vendor.zatech.tech/assets/customer/images/demoes/demo4/banners/banner-5.jpg&quot;); background-size: cover; background-position: 50% 0%; position: absolute; top: 0px; left: 0px; width: 100%; height: 200%; transform: translate3d(0px, -80.2891px, 0px);"></div>
                    <div class="promo-banner banner container text-uppercase">
                        <div class="banner-content row align-items-center text-center">
                            <div class="col-md-4 ml-xl-auto text-md-right appear-animate animated fadeInRightShorter appear-animation-visible" data-animation-name="fadeInRightShorter" data-animation-delay="600" style="animation-duration: 1000ms;">
                                <h2 class="mb-md-0 text-white"><br> {{ $cat->title }}</h2>
                            </div>
                            @if($cat->id == 1)

                            <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate animated fadeIn appear-animation-visible" data-animation-name="fadeIn" data-animation-delay="300" style="animation-duration: 1000ms;">
                                <a href="{{ route('seller.chemical') }}" class="btn btn-dark btn-black ls-10">Enter To {{ $cat->title }}</a>
                            </div>
                            @elseif ($cat->id == 3)

                            <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate animated fadeIn appear-animation-visible" data-animation-name="fadeIn" data-animation-delay="300" style="animation-duration: 1000ms;">
                                <a href="{{ route('seller.service') }}" class="btn btn-dark btn-black ls-10">Enter To {{ $cat->title }}</a>
                            </div>
                            @elseif($cat->id == 4)

                            <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate animated fadeIn appear-animation-visible" data-animation-name="fadeIn" data-animation-delay="300" style="animation-duration: 1000ms;">
                                <a href="{{ route('seller.man.power') }}" class="btn btn-dark btn-black ls-10">Enter To {{ $cat->title }}</a>
                            </div>
                            @elseif ($cat->id == 5)
                            <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate animated fadeIn appear-animation-visible" data-animation-name="fadeIn" data-animation-delay="300" style="animation-duration: 1000ms;">
                                <a href="{{ route('seller.trainer') }}" class="btn btn-dark btn-black ls-10">Enter To {{ $cat->title }}</a>
                            </div>
                            @endif

                            <div class="col-md-4 mr-xl-auto text-md-left appear-animate animated fadeInLeftShorter appear-animation-visible" data-animation-name="fadeInLeftShorter" data-animation-delay="600" style="animation-duration: 1000ms;">
                                <h4 class="mb-1 mt-1 font1 coupon-sale-text p-0 d-block ls-n-10 text-transform-none">
                                    <b>Dashboard</b></h4>
                                <h5 class="mb-1 coupon-sale-text text-white ls-10 p-0"><i class="ls-0"></i><b class="text-white bg-secondary ls-n-10"></b></h5>
                            </div>

                        </div>
                    </div>
                </section>
                    </div>
                    <br><br>
                @endforeach
            </div>

        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main>


@endSection
