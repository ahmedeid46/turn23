@extends('admin.layout.master')
@section('style')

@endsection
@section('script')

@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <section class="app-user-list">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">{{ $total_user }}</h3>
                                <span>Total Users</span>
                            </div>
                            <div class="avatar bg-light-primary p-50">
                            <span class="avatar-content">
                              <i data-feather="user" class="font-medium-4"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">{{ $seller_count }}</h3>
                                <span>Seller Users</span>
                            </div>
                            <div class="avatar bg-light-danger p-50">
                            <span class="avatar-content">
                              <i data-feather="user-plus" class="font-medium-4"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">{{ $customer_count }}</h3>
                                <span>Custumer Users</span>
                            </div>
                            <div class="avatar bg-light-success p-50">
                            <span class="avatar-content">
                              <i data-feather="user-check" class="font-medium-4"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">{{ $pending_count }}</h3>
                                <span>Pending Users</span>
                            </div>
                            <div class="avatar bg-light-warning p-50">
                            <span class="avatar-content">
                              <i data-feather="user-x" class="font-medium-4"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-6">
                    <div class="card border-0 text-white text-center mb-3">
                        <img class="card-img" src="{{ asset('assets/admin') }}/images/slider/10.jpg" alt="Card image" />
                        <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
                            <h4 class="card-title">Seller Users</h4>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="{{ route('admin.users.sellers') }}" class="btn btn-outline-primary">Join</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-6">
                    <div class="card border-0 text-white text-center mb-3">
                        <img class="card-img" src="{{ asset('assets/admin') }}/images/slider/10.jpg" alt="Card image" />
                        <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
                            <h4 class="card-title">Custumer Users</h4>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="{{ route('admin.users.customer') }}" class="btn btn-outline-primary">Join Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
