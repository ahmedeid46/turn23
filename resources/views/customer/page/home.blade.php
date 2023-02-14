@extends('customer.layout.master')
@section('style')

@endsection
@section('script')

@endsection
@section('popup')
    <div class="newsletter-popup mfp-hide bg-img" id="newsletter-popup-form" style="background: #f1f1f1 no-repeat center/cover url({{ asset('assets/customer') }}/images/newsletter_popup_bg.jpg)">
        <div class="newsletter-popup-content">
            <img src="{{ asset('assets/customer') }}/images/logo.png" width="111" height="44" alt="Logo" class="logo-newsletter">
            <h2>Subscribe to newsletter</h2>

            <p>
                Subscribe to the Vendor mailing list to receive updates on new arrivals, special offers and our promotions.
            </p>

            <form action="#">
                <div class="input-group">
                    <input type="email" class="form-control" id="newsletter-email" name="newsletter-email" placeholder="Your email address" required />
                    <input type="submit" class="btn btn-primary" value="Submit" />
                </div>
            </form>
            <div class="newsletter-subscribe">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" value="0" id="show-again" />
                    <label for="show-again" class="custom-control-label">
                        Don't show this popup again
                    </label>
                </div>
            </div>
        </div>

        <button title="Close (Esc)" type="button" class="mfp-close">
            ×
        </button>
    </div>
    <!-- End .newsletter-popup -->
@endsection
@section('content')
<main class="main">
            <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase" data-owl-options="{'loop': false}">
                <div class="home-slide home-slide1 banner">
                    <img class="slide-bg" src="{{ asset('assets/customer') }}/images/1.png" width="1903" height="499" alt="slider image">
                    <div class="container d-flex align-items-center">
                        <div class="banner-layer appear-animate" data-animation-name="fadeInUpShorter">
                            <h4 style="color: white;font-size: 30px" class="text-transform-none m-b-3">We are one of the leading global manufacturers!</h4>
                            <h5 class="d-inline-block mb-0">
                                <span>Starting With</span>
                                <b class="coupon-sale-text text-white bg-secondary align-middle">Vendor</b>
                            </h5>
                            <a href="{{ route('customer.categories',$catHashids->encode(1)) }}" class="btn btn-dark btn-lg">Chemical Products</a>
                        </div>
                        <!-- End .banner-layer -->
                    </div>
                </div>
                <!-- End .home-slide -->

                <div class="home-slide home-slide2 banner banner-md-vw">
                    <img class="slide-bg" style="background-color: #ccc;" width="1903" height="499" src="{{ asset('assets/customer') }}/images/demoes/demo4/slider/slide-2.jpg" alt="slider image">
                    <div class="container d-flex align-items-center">
                        <div class="banner-layer d-flex justify-content-center appear-animate" data-animation-name="fadeInUpShorter">
                            <div class="mx-auto">
                                <h4 class="m-b-1">Our</h4>
                                <h3 class="m-b-2">Greatness</h3>
                                <h3 class="mb-2 heading-border">Service Provider</h3>
                                <a href="#" class="btn btn-block btn-dark">Our Services</a>
                            </div>
                        </div>
                        <!-- End .banner-layer -->
                    </div>
                </div>
                <!-- End .home-slide -->
            </div>
            <!-- End .home-slider -->

            <div class="container">
                <div class="info-boxes-slider owl-carousel owl-theme mb-2" data-owl-options="{
					'dots': false,
					'loop': false,
					'responsive': {
						'576': {
							'items': 2
						},
						'992': {
							'items': 3
						}
					}
				}">
                    <div class="info-box info-box-icon-left">
                        <i class="icon-shipping"></i>

                        <div class="info-box-content">
                            <h4>FREE SHIPPING &amp; RETURN</h4>
                            <p class="text-body">Free shipping on all orders over $99.</p>
                        </div>
                        <!-- End .info-box-content -->
                    </div>
                    <!-- End .info-box -->

                    <div class="info-box info-box-icon-left">
                        <i class="icon-money"></i>

                        <div class="info-box-content">
                            <h4>MONEY BACK GUARANTEE</h4>
                            <p class="text-body">100% money back guarantee</p>
                        </div>
                        <!-- End .info-box-content -->
                    </div>
                    <!-- End .info-box -->

                    <div class="info-box info-box-icon-left">
                        <i class="icon-support"></i>

                        <div class="info-box-content">
                            <h4>ONLINE SUPPORT 24/7</h4>
                            <p class="text-body">Lorem ipsum dolor sit amet.</p>
                        </div>
                        <!-- End .info-box-content -->
                    </div>
                    <!-- End .info-box -->
                </div>
                <!-- End .info-boxes-slider -->

                <div class="banners-container mb-2">
                    <div class="banners-slider owl-carousel owl-theme" data-owl-options="{
						'dots': false
					}">
                        <div class="banner banner1 banner-sm-vw d-flex align-items-center appear-animate" style="background-color: #ccc;" data-animation-name="fadeInLeftShorter" data-animation-delay="500">
                            <figure class="w-100">
                                <img src="{{ asset('assets/customer') }}/images/demoes/demo4/banners/banner-1.jpg" alt="banner" width="380" height="175" />
                            </figure>
                            <div class="banner-layer">
                                <h3 class="m-b-2">Our Categories</h3>
                                <h4 class="m-b-3 text-primary">Chemical Products</h4>
                                <a href="{{ route('customer.categories',$catHashids->encode(1)) }}" class="btn btn-sm btn-dark">Shop Now</a>
                            </div>
                        </div>
                        <!-- End .banner -->

                        <div class="banner banner2 banner-sm-vw text-uppercase d-flex align-items-center appear-animate" data-animation-name="fadeInUpShorter" data-animation-delay="200">
                            <figure class="w-100">
                                <img src="{{ asset('assets/customer') }}/images/demoes/demo4/banners/banner-2.jpg" style="background-color: #ccc;" alt="banner" width="380" height="175" />
                            </figure>
                            <div class="banner-layer text-center">
                                <div class="row align-items-lg-center">
                                    <div class="col-lg-7 text-lg-right">
                                        <h3> Our Categories</h3>
                                        <h4 class="pb-4 pb-lg-0 mb-0 text-body">Industrial Products</h4>
                                    </div>
                                    <div class="col-lg-5 text-lg-left px-0 px-xl-3">
                                        <a href="{{ route('customer.industrial') }}" class="btn btn-sm btn-dark">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .banner -->

                        <div class="banner banner3 banner-sm-vw d-flex align-items-center appear-animate" style="background-color: #ccc;" data-animation-name="fadeInRightShorter" data-animation-delay="500">
                            <figure class="w-100">
                                <img src="{{ asset('assets/customer') }}/images/demoes/demo4/banners/banner-3.jpg" alt="banner" width="380" height="175" />
                            </figure>
                            <div class="banner-layer text-right">
                                <h3 class="m-b-2">Our Categories</h3>
                                <h4 class="m-b-2 text-secondary text-uppercase">Service Provider</h4>
                            </div>
                        </div>
                        <!-- End .banner -->
                    </div>
                </div>
            </div>
            <!-- End .container -->

            <section class="featured-products-section">
                <div class="container">
                    <h2 class="section-title heading-border ls-20 border-0">Last Chemical Products</h2>

                    <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center" data-owl-options="{
						'dots': false,
						'nav': true
					}">
                        @foreach($last_chemical_products as $lastProduct)
                            <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                                <figure>
                                    <a href="{{ route('customer.product.show',$ProductHashids->encode($lastProduct->id)) }}">
                                        <img src="{{ route('product.files',[encrypt('cover'),encrypt($lastProduct->cover)]) }}" width="280" height="280" alt="product">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="" class="product-category"></a>
                                    </div>
                                    <h3 class="product-title">
                                        <a href="{{ route('customer.product.show',$ProductHashids->encode($lastProduct->id)) }}">{{ $lastProduct->allproduct->name }}</a>
                                    </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:80%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">${{ $lastProduct->price }}</span>
                                    </div>
                                    <!-- End .price-box -->
                                    <div class="product-action">
                                        <a href="{{ route('customer.product.show',$ProductHashids->encode($lastProduct->id)) }}" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i><span>SELECT OPTIONS</span></a>
                                    </div>
                                </div>
                                <!-- End .product-details -->
                            </div>
                        @endforeach
                    </div>
                    <!-- End .featured-proucts -->
                </div>
            </section>

            <section class="new-products-section">
                <div class="container">
                    <h2 class="section-title heading-border ls-20 border-0">Industrial Products</h2>
                    <section class="promo-section bg-dark" data-parallax="{'speed': 2, 'enableOnMobile': true}" data-image-src="{{ asset('assets/customer') }}/images/demoes/demo4/banners/banner-5.jpg">
                        <div class="promo-banner banner container text-uppercase">
                            <div class="banner-content row align-items-center text-center">
                                <div class="col-md-4 ml-xl-auto text-md-right appear-animate" data-animation-name="fadeInRightShorter" data-animation-delay="600">
                                    <h2 class="mb-md-0 text-white">Out<br>Industrial products</h2>
                                </div>
                                <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate" data-animation-name="fadeIn" data-animation-delay="300">
                                    <a href="{{ route('customer.industrial') }}" class="btn btn-dark btn-black ls-10">Industrial Page</a>
                                </div>
                                <div class="col-md-4 mr-xl-auto text-md-left appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="600">
                                    <h4 class="mb-1 mt-1 font1 coupon-sale-text p-0 d-block ls-n-10 text-transform-none">
                                        <b>Cooming Sooon</b></h4>
                                    <h5 class="mb-1 coupon-sale-text text-white ls-10 p-0"><i class="ls-0">UP TO</i><b class="text-white bg-secondary ls-n-10">Wait</b></h5>
                                </div>
                            </div>
                        </div>
                    </section>
                    </div>

                    <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate" data-animation-delay="100" data-animation-name="fadeInUpShorter">Our Service Provider
                    </h2>

                 <div class="container cta">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cta-simple cta-border bg-primary">
                                <h3 class="font-weight-normal text-white"> <b>Our Companies Services</b></h3>
                                <p class="text-white">We are one of the leading global manufacturers of heat exchangers and have been providing solutions for almost every industrial application imaginable since the 1920s, specializing in customized solutions suitable for extreme environmental conditions - as of 2015 under the name of Kelvion.</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="cta-simple cta-border bg-primary">
                                <h3 class="font-weight-normal text-white"> <b>Our ManPower Services</b></h3>
                                <p class="text-white">We are one of the leading global manufacturers of heat exchangers and have been providing solutions for almost every industrial application imaginable since the 1920s, specializing in customized solutions suitable for extreme environmental conditions - as of 2015 under the name of Kelvion.</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="cta-simple cta-border bg-primary">
                                <h3 class="font-weight-normal text-white"> <b>Our Training Services</b></h3>
                                <p class="text-white">We are one of the leading global manufacturers of heat exchangers and have been providing solutions for almost every industrial application imaginable since the 1920s, specializing in customized solutions suitable for extreme environmental conditions - as of 2015 under the name of Kelvion.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="feature-boxes-container">
                <div class="container appear-animate" data-animation-name="fadeInUpShorter">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="feature-box px-sm-5 feature-box-simple text-center">
                                <div class="feature-box-icon">
                                    <i class="icon-earphones-alt"></i>
                                </div>

                                <div class="feature-box-content p-0">
                                    <h3>Customer Support</h3>
                                    <h5>You Won't Be Alone</h5>
                                </div>
                                <!-- End .feature-box-content -->
                            </div>
                            <!-- End .feature-box -->
                        </div>
                        <!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="feature-box px-sm-5 feature-box-simple text-center">
                                <div class="feature-box-icon">
                                    <i class="icon-credit-card"></i>
                                </div>

                                <div class="feature-box-content p-0">
                                    <h3>Fully Customizable</h3>
                                    <h5>Tons Of Options</h5>
                                </div>
                                <!-- End .feature-box-content -->
                            </div>
                            <!-- End .feature-box -->
                        </div>
                        <!-- End .col-md-4 -->

                        <div class="col-md-4">
                            <div class="feature-box px-sm-5 feature-box-simple text-center">
                                <div class="feature-box-icon">
                                    <i class="icon-action-undo"></i>
                                </div>
                                <div class="feature-box-content p-0">
                                    <h3>Powerful Admin</h3>
                                    <h5>Made To Help You</h5>
                                </div>
                                <!-- End .feature-box-content -->
                            </div>
                            <!-- End .feature-box -->
                        </div>
                        <!-- End .col-md-4 -->
                    </div>
                    <!-- End .row -->
                </div>
                <!-- End .container-->
            </section>
            <!-- End .feature-boxes-container -->



            <section class="blog-section pb-0">
                <div class="container">
                    <div class="brands-slider owl-carousel owl-theme images-center appear-animate" data-animation-name="fadeIn" data-animation-duration="500" data-owl-options="{
					'margin': 0}">
                        <img src="{{ asset('assets/customer') }}/images/brands/brand1.png" width="130" height="56" alt="brand">
                        <img src="{{ asset('assets/customer') }}/images/brands/brand2.png" width="130" height="56" alt="brand">
                        <img src="{{ asset('assets/customer') }}/images/brands/brand3.png" width="130" height="56" alt="brand">
                        <img src="{{ asset('assets/customer') }}/images/brands/brand4.png" width="130" height="56" alt="brand">
                        <img src="{{ asset('assets/customer') }}/images/brands/brand5.png" width="130" height="56" alt="brand">
                        <img src="{{ asset('assets/customer') }}/images/brands/brand6.png" width="130" height="56" alt="brand">
                    </div>
                    <!-- End .brands-slider -->
                </div>
            </section>
        </main>
        <!-- End .main -->
@endsection
