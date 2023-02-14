<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

    <meta name="description" content=" ">

    <meta name="keywords" content=" ">

    <meta name="author" content="joinus">

    <title>B2B - Customer Panal</title>

    <link rel="apple-touch-icon" href="{{ asset('assets/admin') }}/images/logo/logo.png">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin') }}/images/logo/logo.png">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/vendors/css/vendors.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/vendors/css/charts/apexcharts.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/vendors/css/extensions/toastr.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/bootstrap-extended.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/colors.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/components.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/themes/dark-layout.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/themes/bordered-layout.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/themes/semi-dark-layout.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/core/menu/menu-types/vertical-menu.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/pages/dashboard-ecommerce.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/plugins/charts/chart-apex.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/plugins/extensions/ext-component-toastr.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/core/menu/menu-types/vertical-menu.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/pages/app-ecommerce.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/plugins/extensions/ext-component-toastr.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/style.css">
    @yield('style')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-dark navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="chat.html" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat"><i class="ficon" data-feather="message-square"></i></a></li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">

            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="sun"></i></a></li>
            </li>
            <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge rounded-pill bg-danger badge-up">5</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                            <div class="badge rounded-pill badge-light-primary">6 New</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list"><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar"><img src="{{ asset('assets/admin') }}/images/portrait/small/avatar-s-15.jpg" alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Congratulation Sam 🎉</span>winner!</p><small class="notification-text"> Won the monthly best seller badge.</small>
                                </div>
                            </div></a><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar"><img src="{{ asset('assets/admin') }}/images/portrait/small/avatar-s-3.jpg" alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">New message</span>&nbsp;received</p><small class="notification-text"> You have 10 unread messages</small>
                                </div>
                            </div></a><a class="d-flex" href="#">
                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content">MD</div>
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading"><span class="fw-bolder">Revised Order 👋</span>&nbsp;checkout</p><small class="notification-text"> MD Inc. order updated</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="{{ route('admin.notify') }}">Read all notifications</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">{{ auth('admin')->user()->name }}</span>
                        <span class="user-status">Admin</span>
                    </div>
                    <span class="avatar bg-light-danger">
                        @if(auth('admin')->user()->img != null)
                            <img class="round" src="{{ route('admin.file',encrypt(auth('admin')->user()->img)) }}" alt="avatar" height="40" width="40">
                        @else
                            <span class="avatar-content ">AD</span>
                        @endif
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="me-50" data-feather="user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" onclick="$('#logout').submit()" ><i class="me-50" data-feather="power"></i> Logout</a>
                    <form id="logout" method="post" action="{{ route('admin.logout') }}">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ route('admin.dashboard') }}">
              <span class="brand-logo">
                  <img src="{{ asset('assets/admin') }}/images/logo/logo.png ">
              </span>
                    <h2 class="brand-text">TURN</h2></a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.buy.all') }}">
                    <i data-feather='shopping-cart'></i>
                    <span class="menu-title text-truncate" data-i18n="Review">Orders</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.permission.register') }}">
                    <i data-feather='user-plus'></i>
                    <span class="menu-title text-truncate" data-i18n="Review">Register Permission</span>
                </a>
            </li>
{{--            <li class=" nav-item">--}}
{{--            <a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}">--}}
{{--                <i data-feather="home"></i>--}}
{{--                <span class="menu-title text-truncate" data-i18n="Review">Products Permission</span>--}}
{{--            </a>--}}
{{--            </li>--}}
{{--            <li class=" nav-item">--}}
{{--                <a class="d-flex align-items-center" href="{{ route('admin.permission.all.product') }}">--}}
{{--                    <i data-feather="home"></i>--}}
{{--                    <span class="menu-title text-truncate" data-i18n="Review">Other Products</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class=" nav-item">--}}
{{--                <a class="d-flex align-items-center" href="{{ route('admin.permission.all.service') }}">--}}
{{--                    <i data-feather="home"></i>--}}
{{--                    <span class="menu-title text-truncate" data-i18n="Review">Service Request</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='box'></i><span class="menu-title text-truncate" data-i18n="Invoice">Products</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">Products Permission</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{ route('admin.permission.all.product') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">Other Products</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('admin.admin.product')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">Customer Products</span></a>
                    </li>
                </ul>
            </li>
{{--            <li class=" nav-item">--}}
{{--                <a class="d-flex align-items-center" href="chat.html">--}}
{{--                    <i data-feather='message-circle'></i>--}}
{{--                    <span class="menu-title text-truncate" data-i18n="Review">Chat</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class=" nav-item">--}}
{{--                <a class="d-flex align-items-center" href="{{ route('admin.training') }}">--}}
{{--                    <i data-feather='users'></i>--}}
{{--                    <span class="menu-title text-truncate" data-i18n="Review">Training Groups</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="d-flex align-items-center" href="{{route('admin.admin.product')}}">--}}
{{--                    <i data-feather="shopping-bag"></i>--}}
{{--                    <span class="menu-title text-truncate" data-i18n="Review">Customer Products</span>--}}
{{--                </a>--}}

{{--            </li>--}}
            <li class="nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.complete') }}">
                    <i data-feather="shopping-bag"></i>
                    <span class="menu-title text-truncate" data-i18n="Review">completed orders</span>
                </a>

            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.notify') }}">
                    <i data-feather='bell'></i>
                    <span class="menu-title text-truncate" data-i18n="Review">Notifications</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.users') }}">
                    <i data-feather='users'></i>
                    <span class="menu-title text-truncate" data-i18n="Review">Users</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.profile') }}">
                    <i data-feather='user'></i>
                    <span class="menu-title text-truncate" data-i18n="Review">Profile</span>
                </a>
            </li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->

@yield('content')

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT  &copy; 2021<a class="ms-25" href="#" target="_blank">Zatech</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<script src="{{ asset('assets/admin') }}/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('assets/admin') }}/vendors/js/charts/apexcharts.min.js"></script>
<script src="{{ asset('assets/admin') }}/vendors/js/extensions/toastr.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('assets/admin') }}/js/core/app-menu.min.js"></script>
<script src="{{ asset('assets/admin') }}/js/core/app.min.js"></script>
<script src="{{ asset('assets/admin') }}/js/scripts/customizer.min.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('assets/admin') }}/js/scripts/pages/dashboard-ecommerce.min.js"></script>
<script src="{{ asset('assets/admin') }}/js/scripts/pages/app-ecommerce-wishlist.min.js"></script>
<!-- END: Page JS-->

<script src="{{ asset('assets/admin') }}/js/scripts/components/components-modals.min.js"></script>

<script>
    $(window).on('load',  function(){
        if (feather) {
            feather.replace({ width: 14, height: 14 });
        }
    })
</script>
@yield('script')
</body>
</html>
