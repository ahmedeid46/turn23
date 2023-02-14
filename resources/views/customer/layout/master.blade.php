<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Vendor - Home</title>

    <meta name="keywords" content="vendor" />

    <meta name="description" content="Vendor ecommerce website">

    <meta name="author" content="ZATECH">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/customer') }}/images/icons/favicon.png">

    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '{{ asset('assets/customer') }}/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="stylesheet" href="{{ asset('assets/customer') }}/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('assets/customer') }}/css/demo4.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer') }}/vendor/fontawesome-free/css/all.min.css">

    <link rel="preload" href="{{ asset('assets/customer') }}/fonts/porto6e1d.woff2?64334846" as="font" type="font/ttf" crossorigin>

    <link rel="preload" href="{{ asset('assets/customer') }}/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2"
          crossorigin>

    <link rel="preload" href="{{ asset('assets/customer') }}/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font" type="font/woff2"
          crossorigin>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer') }}/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer') }}/vendor/simple-line-icons/css/simple-line-icons.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/customer') }}/css/style.min.css">
    @yield('style')
</head>
<body>
<div class="page-wrapper">
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="header-left d-none d-sm-block">
                    <p class="top-message text-uppercase">Welcome with Vendor. Wish a good day</p>
                </div>
                <!-- End .header-left -->

                <div class="header-right header-dropdowns ml-0 ml-sm-auto w-sm-100">
                    <div class="header-dropdown dropdown-expanded d-none d-lg-block">
                        <a href="#">Links</a>
                        <div class="header-menu">
                            <ul>
                                <li><a href="{{ route('customer.about') }}">About Us</a></li>
                                @auth('customer')
                                    @if(auth('customer')->user()->customer_type != 3)
                                        <li><a href="{{ route('customer.wishlist') }}">My Wishlist</a></li>
                                        <li><a href="{{ route('customer.chart') }}">Cart</a></li>
                                        <li><a href="{{ route('customer.order.show') }}">Orders</a></li>

                                    @endif
{{--                                    <li><a href="profile.html">My Account</a></li>--}}
                                    <li><a href="javascript:" onclick="$('#logout').submit()" >Logout</a></li>
                                    <form id="logout" method="post" action="{{ route('customer.logout') }}">
                                        @csrf
                                    </form>
                                @endauth
                                @guest()
                                    <li><a href="{{ route('customer.show.login') }}" >Login</a></li>
                                @endguest
                            </ul>
                        </div>
                        <!-- End .header-menu -->
                    </div>
                    <!-- End .header-dropdown -->

                    <span class="separator"></span>

                    <span class="separator"></span>

                    <div class="social-icons">
                        <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"></a>
                        <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"></a>
                        <a href="#" class="social-icon social-instagram icon-instagram" target="_blank"></a>
                    </div>
                    <!-- End .social-icons -->
                </div>
                <!-- End .header-right -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .header-top -->

        <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
            <div class="container">
                <div class="header-left col-lg-2 w-auto pl-0">
                    <button class="mobile-menu-toggler text-primary mr-2" type="button">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a href="{{ route('customer.home') }}" class="logo">
                        <img src="{{ asset('assets/customer') }}/images/logo.png" width="111" height="44" alt="Porto Logo" style="max-width: 40px;">
                    </a>
                </div>
                <!-- End .header-left -->

                <div class="header-right w-lg-max">
                    <div class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                        <form action="#" method="get">
                            <div class="header-search-wrapper">
                                <input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
                                <!-- End .select-custom -->
                                <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                            </div>
                            <!-- End .header-search-wrapper -->
                        </form>
                    </div>
                    <!-- End .header-search -->

                    <div class="header-contact d-none d-lg-flex pl-4 pr-4">
                        <img alt="phone" src="{{ asset('assets/customer') }}/images/phone.png" width="30" height="30" class="pb-1">
                        <h6><span>Call us now</span><a href="tel:#" class="text-dark font1">+201099378744</a></h6>
                    </div>

                    <a href="{{ route('customer.show.login') }}" class="header-icon" title="login"><i class="icon-user-2"></i></a>
                    @auth('customer')
{{--                    <a href="notifications.html" class="header-icon" title="wishlist"><i class="sicon-bell"></i></a>--}}
                    <div class="dropdown cart-dropdown">
                        <a href="{{ route('customer.chart') }}" title="Cart">
                            <i class="minicart-icon"></i>
                        </a>

                        <div class="cart-overlay"></div>

                        <!-- End .dropdown-menu -->
                    </div>
                @endauth
                    <!-- End .dropdown -->
                </div>
                <!-- End .header-right -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .header-middle -->

        <div  class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
            <div class="container">
                <nav class="main-nav w-100">
                    <ul class="menu">

                        @auth('customer')
                            @if(auth('customer')->user()->customer_type == 3)
                                <li><a href="">Training</a></li>
                            @else
                                <li class="active">
                                    <a href="{{ route('customer.home') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('customer.categories',$catHashids->encode(1)) }}">Chemical</a>
                                    <div class="megamenu megamenu-fixed-width megamenu-3cols">
                                        <div class="row">
                                            @foreach($navbar_menu['chemical'] as $chemical)
                                                <div class="col-lg-4">
                                                    <a href="{{ route('customer.products',$subCatHashids->encode($chemical->id)) }}">{{ $chemical->title }}</a>
{{--                                                    <ul class="submenu">--}}
{{--                                                        @foreach($chemical->subsubCat as $chemicalSubSubCat)--}}
{{--                                                            <li><a href="{{ route('customer.products',$subCatHashids->encode($chemicalSubSubCat->id)) }}">{{ $chemicalSubSubCat->title }}</a></li>--}}
{{--                                                        @endforeach--}}
{{--                                                    </ul>--}}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- End .megamenu -->
                                </li>
                                <li>
                                    <a href="#">Service Provider</a>
                                    <div class="megamenu megamenu-fixed-width">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <a href="#" class="nolink">Company</a>
                                                <div class="row">
                                            @foreach($navbar_menu['service'] as $service)
                                                <div class="col-lg-4">
                                                    <a href="#" class="nolink">{{ $service->title }}</a>
                                                    <ul class="submenu">
                                                        @foreach($service->subsubCat as $serviceSubSubCat)
                                                            <li><a href="{{ route('customer.service',$subCatHashids->encode($serviceSubSubCat->id)) }}">{{ $serviceSubSubCat->title }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endforeach
                                                </div>

                                            </div>
                                            <div class="col-lg-6">
                                                <a href="#" class="nolink">ManPower</a>
                                                <div class="row">
                                                    @foreach($navbar_menu['manpower'] as $manpower)
                                                        <div class="col-lg-4">
                                                            <a href="#" class="nolink">{{ $manpower->title }}</a>
                                                            <ul class="submenu">
                                                                @foreach($manpower->subsubCat as $manpowerSubSubCat)
                                                                    <li><a href="{{ route('customer.service',$subCatHashids->encode($manpowerSubSubCat->id)) }}">{{ $manpowerSubSubCat->title }}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                            {{--                                    <div class="col-lg-4">--}}
                                            {{--                                        <a href="#" class="nolink">Training</a>--}}
                                            {{--                                        <ul class="submenu">--}}
                                            {{--                                            <li><a href="training-service.html">Carpentry field</a></li>--}}
                                            {{--                                            <li><a href="training-service.html">Electrician field</a></li>--}}
                                            {{--                                            <li><a href="training-service.html">Carpentry field</a></li>--}}
                                            {{--                                            <li><a href="training-service.html">Electrician field</a></li>--}}
                                            {{--                                        </ul>--}}
                                            {{--                                    </div>--}}
                                            <!-- End .col-lg-4 -->
                                        </div>
                                        <!-- End .row -->
                                    </div>
                                    <!-- End .megamenu -->
                                </li>
                                <li><a href="{{ route('customer.industrial') }}">Industrial</a></li>
                            @endif
                        @endauth
                        @guest('customer')
                                <li class="active">
                                    <a href="{{ route('customer.home') }}">Home</a>
                                </li>
                            <li>
                                <a href="{{ route('customer.categories',$catHashids->encode(1)) }}">Chemical</a>
                                <div class="megamenu megamenu-fixed-width megamenu-3cols">
                                    <div class="row">
                                        @foreach($navbar_menu['chemical'] as $chemical)
                                            <div class="col-lg-4">
                                                <a href="{{ route('customer.products',$subCatHashids->encode($chemical->id)) }}">{{ $chemical->title }}</a>
{{--                                                <ul class="submenu">--}}
{{--                                                    @foreach($chemical->subsubCat as $chemicalSubSubCat)--}}
{{--                                                        <li><a href="{{ route('customer.products',$subCatHashids->encode($chemicalSubSubCat->id)) }}">{{ $chemicalSubSubCat->title }}</a></li>--}}
{{--                                                    @endforeach--}}
{{--                                                </ul>--}}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- End .megamenu -->
                            </li>
                            <li>
                                <a href="#">Service Provider</a>
                                <div class="megamenu megamenu-fixed-width">
                                    <div class="row">
                                        @foreach($navbar_menu['service'] as $service)
                                            <div class="col-lg-4">
                                                <a href="#" class="nolink">{{ $service->title }}</a>
                                                <ul class="submenu">
                                                    @foreach($service->subsubCat as $serviceSubSubCat)
                                                        <li><a href="{{ route('customer.service',$subCatHashids->encode($serviceSubSubCat->id)) }}">{{ $serviceSubSubCat->title }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                        <div class="col-lg-8">
                                            <a href="#" class="nolink">ManPower</a>
                                            <div class="row">
                                                @foreach($navbar_menu['manpower'] as $manpower)
                                                    <div class="col-lg-4">
                                                        <a href="#" class="nolink">{{ $manpower->title }}</a>
                                                        <ul class="submenu">
                                                            @foreach($manpower->subsubCat as $manpowerSubSubCat)
                                                                <li><a href="{{ route('customer.service',$subCatHashids->encode($manpowerSubSubCat->id)) }}">{{ $manpowerSubSubCat->title }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                        {{--                                    <div class="col-lg-4">--}}
                                        {{--                                        <a href="#" class="nolink">Training</a>--}}
                                        {{--                                        <ul class="submenu">--}}
                                        {{--                                            <li><a href="training-service.html">Carpentry field</a></li>--}}
                                        {{--                                            <li><a href="training-service.html">Electrician field</a></li>--}}
                                        {{--                                            <li><a href="training-service.html">Carpentry field</a></li>--}}
                                        {{--                                            <li><a href="training-service.html">Electrician field</a></li>--}}
                                        {{--                                        </ul>--}}
                                        {{--                                    </div>--}}
                                        <!-- End .col-lg-4 -->
                                    </div>
                                    <!-- End .row -->
                                </div>
                                <!-- End .megamenu -->
                            </li>
                            <li><a href="{{ route('customer.industrial') }}">Industrial</a></li>
                            <li><a href="">Training</a></li>
                        @endguest


                        @guest('customer')
                        <li class="nav-item dropdown">
                            <a class="nav-link  dropdown-toggle" href="{{ route('seller.chemical') }}" data-bs-toggle="dropdown">  Become Supplier  </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('seller.show.login') }}"> Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('seller.show.register') }}"> Register</a></li>
                            </ul>
                        </li>
                        @endguest

                        <li><a href="{{ route('customer.contact') }}">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
            <!-- End .container -->
        </div>
        <!-- End .header-bottom -->
    </header>

@yield('content')

    <footer class="footer bg-dark">
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <img style="width: 220px !important;" src="{{ asset('assets/customer') }}/images/logo.png">
                        </div>
                        <div class="social-icons">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                            <a href="#" class="social-icon social-instagram icon-instagram" target="_blank" title="Instagram"></a>
                        </div>
                        <!-- End .widget -->
                    </div>
                    <!-- End .col-lg-3 -->

                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4 class="widget-title">Contact Info</h4>
                            <ul class="contact-info">
                                <li>
                                    <span class="contact-info-label">Address:</span>123 Street Name, City, England
                                </li>
                                <li>
                                    <span class="contact-info-label">Phone:</span><a href="tel:">(123)
                                        456-7890</a>
                                </li>
                                <li>
                                    <span class="contact-info-label">Email:</span> <a href="mailto:mail@example.com">mail@example.com</a>
                                </li>
                                <li>
                                    <span class="contact-info-label">Working Days/Hours:</span> Mon - Sun / 9:00 AM - 8:00 PM
                                </li>
                            </ul>
                            <!-- End .social-icons -->
                        </div>
                        <!-- End .widget -->
                    </div>
                    <!-- End .col-lg-3 -->

                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4 class="widget-title">Customer Service</h4>

                            <ul class="links">
                                <li><a href="{{ route('customer.home') }}">Home</a></li>
                                <li><a href="{{ route('customer.about') }}">About Us</a></li>
                                <li><a href="{{ route('customer.contact') }}">Contact Us</a></li>
                            </ul>
                        </div>
                        <!-- End .widget -->
                    </div>
                    <!-- End .col-lg-3 -->

                    <div class="col-lg-3 col-sm-6">
                        <div class="widget widget-newsletter">
                            <h4 class="widget-title">Subscribe newsletter</h4>
                            <p>Get all the latest information on events, sales and offers. Sign up for newsletter:
                            </p>
                            <form action="#" class="mb-0">
                                <input type="email" class="form-control m-b-3" placeholder="Email address" required>

                                <input type="submit" class="btn btn-primary shadow-none" value="Subscribe">
                            </form>
                        </div>
                        <!-- End .widget -->
                    </div>
                    <!-- End .col-lg-3 -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .footer-middle -->

        <div class="container">
            <div class="footer-bottom">
                <div class="container d-sm-flex align-items-center">
                    <div class="footer-left">
                        <span class="footer-copyright">© Vendor 2022. All Rights Reserved</span>
                    </div>

                    <div class="footer-right ml-auto mt-1 mt-sm-0">
                        <div class="payment-icons">
                            <span class="payment-icon visa" style="background-image: url({{ asset('assets/customer') }}/images/payments/payment-visa.svg)"></span>
                            <span class="payment-icon paypal" style="background-image: url({{ asset('assets/customer') }}/images/payments/payment-paypal.svg)"></span>
                            <span class="payment-icon stripe" style="background-image: url({{ asset('assets/customer') }}/images/payments/payment-stripe.png)"></span>
                            <span class="payment-icon verisign" style="background-image:  url({{ asset('assets/customer') }}/images/payments/payment-verisign.svg)"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .footer-bottom -->
        </div>
        <!-- End .container -->
    </footer>
    <!-- End .footer -->
</div>
<!-- End .page-wrapper -->

<div class="loading-overlay">
    <div class="bounce-loader">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>

<div class="mobile-menu-overlay"></div>
<!-- End .mobil-menu-overlay -->


<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li>
                    <a href="{{ route('customer.home') }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('customer.categories',$catHashids->encode(1)) }}">Chemical</a>
                    <ul>
                        @foreach($navbar_menu['chemical'] as $chemical)
                            <a href="{{ route('customer.products',$subCatHashids->encode($chemical->id)) }}">{{ $chemical->title }}</a>
{{--                                <ul class="submenu">--}}
{{--                                    @foreach($chemical->subsubCat as $chemicalSubSubCat)--}}
{{--                                        <li><a href="{{ route('customer.products',$subCatHashids->encode($chemicalSubSubCat->id)) }}">{{ $chemicalSubSubCat->title }}</a></li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
                        @endforeach

                    </ul>
                </li>
                <li>
                    <a href="#">Man Power</a>
                    <ul>
                        @foreach($navbar_menu['manpower'] as $manpower)
                            @foreach($manpower->subsubCat as $manpowerSubSubCat)
                                <li><a href="{{ route('customer.service',$subCatHashids->encode($manpowerSubSubCat->id)) }}">{{ $manpowerSubSubCat->title }}</a></li>
                            @endforeach
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="#">Service Provider</a>
                    <ul>
                        @foreach($navbar_menu['service'] as $service)
                            @foreach($service->subsubCat as $serviceSubSubCat)
                                <li><a href="{{ route('customer.service',$subCatHashids->encode($serviceSubSubCat->id)) }}">{{ $serviceSubSubCat->title }}</a></li>
                            @endforeach
                        @endforeach

                    </ul>
                </li>

                <li><a href="{{ route('customer.industrial') }}">Industrial</a></li>
                <li><a href="{{ route('customer.contact') }}">Contact Us</a></li>
            </ul>

            <ul class="mobile-menu">
{{--                <li><a href="login.html">My Account</a></li>--}}
                @auth('customer')
                    <li><a href="{{ route('customer.wishlist') }}">My Wishlist</a></li>
                    <li><a href="{{ route('customer.chart') }}">Cart</a></li>
                    {{--                                    <li><a href="profile.html">My Account</a></li>--}}
                    <li><a href="javascript:" onclick="$('#logout').submit()" >Logout</a></li>
                    <form id="logout" method="post" action="{{ route('customer.logout') }}">
                        @csrf
                    </form>
                @endauth
                @guest()
                    <li><a href="{{ route('customer.show.login') }}" >Login</a></li>
                @endguest
            </ul>
        </nav>
        <!-- End .mobile-nav -->

        <form class="search-wrapper mb-2" action="#">
            <input type="text" class="form-control mb-0" placeholder="Search..." required />
            <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
        </form>

        <div class="social-icons">
            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank">
            </a>
            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank">
            </a>
            <a href="#" class="social-icon social-instagram icon-instagram" target="_blank">
            </a>
        </div>
    </div>
    <!-- End .mobile-menu-wrapper -->
</div>
<!-- End .mobile-menu-container -->

<div class="sticky-navbar">
    <div class="sticky-info">
        <a href="{{ route('customer.home') }}">
            <i class="icon-home"></i>Home
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ route('customer.wishlist') }}" class="">
            <i class="icon-wishlist-2"></i>Wishlist
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ route('customer.show.login') }}" class="">
            <i class="icon-user-2"></i>Account
        </a>
    </div>
    <div class="sticky-info">
        <a href="{{ route('customer.chart') }}" class="">
            <i class="icon-shopping-cart position-relative">
                <span class="cart-count badge-circle">3</span>
            </i>Cart
        </a>
    </div>
</div>

@yield('popup')

<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

<!-- Plugins JS File -->
<script src="{{ asset('assets/customer') }}/js/jquery.min.js"></script>
<script src="{{ asset('assets/customer') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/customer') }}/js/optional/isotope.pkgd.min.js"></script>
<script src="{{ asset('assets/customer') }}/js/plugins.min.js"></script>
<script src="{{ asset('assets/customer') }}/js/jquery.appear.min.js"></script>

<!-- Main JS File -->
<script src="{{ asset('assets/customer') }}/js/main.min.js"></script>
@yield('script')
</body>
</html>
