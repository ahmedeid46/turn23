@extends('seller.layout.master')
@section('styles')

@endsection
@section('script')

@endsection
@section('content')
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('seller.chemical') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                My Dashboard
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>My Dashboard</h1>
            </div>
        </div>

        <div class="container account-container custom-account-container">
            <div class="row">
                <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
                    <h2 class="text-uppercase">My Account</h2>
                    <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard"
                               role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
                               aria-controls="order" aria-selected="true">Orders</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                               aria-controls="address" aria-selected="false">Products</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                               aria-controls="edit" aria-selected="false">Account
                                details</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('seller.logout') }}" method="post">
                                @csrf
                                <button class="nav-link" type="submit">Logout</button>
                            </form>

                        </li>
                    </ul>
                </div>
                <div class="col-lg-9 order-lg-last order-1 tab-content">
                    @include('seller.page.chemical.dashbard',['subcats'=>$subcat])
                    @include('seller.page.chemical.order',['subcats'=>$subcat,'orders'=>$orders,'ProductHashids'=>$ProductHashids])
                    @include('seller.page.chemical.address',['allCats'=>$allCats,'subcats'=>$subcat,'hashids'=>$hashids])
                    @include('seller.page.chemical.edit',['subcats'=>$subcat])
                    @include('seller.page.chemical.billing',['subcats'=>$subcat])
                    @include('seller.page.chemical.shipping',['subcats'=>$subcat])
                </div><!-- End .tab-content -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main>
    <!-- End .main -->
@endSection
