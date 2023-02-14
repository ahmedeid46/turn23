<header class="header">

    <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                <button class="mobile-menu-toggler text-primary mr-2" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="{{ route('seller.home') }}" class="logo">
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

                <a href="login.html" class="header-icon" title="login"><i class="icon-user-2"></i></a>
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
                    <li class="active">
                        <a href="{{ route('seller.home') }}">Home</a>
                    </li>
                    @if(auth('seller')->user()->cat_id == 3)
                    <li>
                        <a href="{{ route('seller.service.requests') }}">Requests</a>
                    </li>
                    @endif
                    @if(auth('seller')->user()->cat_id == 4)
                        <li>
                            <a href="{{ route('seller.man.power.requests') }}">Requests</a>
                        </li>
                    @endif
                    @if(auth('seller')->user()->cat_id == 5)
                        <li>
                            <a href="{{ route('seller.trainer.requests') }}">Requests</a>
                        </li>
                    @endif

                    <li><a href="{{ route('customer.contact') }}">Contact Us</a></li>
                </ul>
            </nav>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-bottom -->
</header>
<!-- End .header -->
