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
                            <li class="breadcrumb-item"><a href="index-chemical.html">Home</a></li>
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
                            <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                               aria-controls="edit" aria-selected="false">Account
                                details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.html">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9 order-lg-last order-1 tab-content">
                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                        <div class="dashboard-content">

                            <p>
                                From your account dashboard you can view your
                                <a class="btn btn-link link-to-tab" href="#order">recent orders</a>,
                                manage your
                                <a class="btn btn-link link-to-tab" href="#address">shipping and billing
                                    addresses</a>, and
                                <a class="btn btn-link link-to-tab" href="#edit">edit your password and account
                                    details.</a>
                            </p>

                            <div class="mb-4"></div>

                            <div class="row row-lg">

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#edit" class="link-to-tab"><i class="icon-user-2"></i></a>
                                        <div class="feature-box-content p-0">
                                            <h3>ACCOUNT DETAILS</h3>
                                        </div>
                                    </div>
                                </div>
                                <form id="logout" action="{{ route('seller.logout') }}" method="post">
                                    @csrf
                                </form>
                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a onclick="$('#logout').submit()"><i class="fas fa-sign-out-alt"></i></a>
                                        <div class="feature-box-content">
                                            <h3>LOGOUT</h3>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End .row -->
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="edit" role="tabpanel">
                        <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
                                class="icon-user-2 align-middle mr-3 pr-1"></i>Account Details</h3>
                        <div class="account-content">
                            <form action="" enctype="multipart/form-data" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="acc-name"> name <span class="required">*</span></label>
                                            <input type="text" class="form-control" value="{{ auth('seller')->user()->name }}"
                                                   id="acc-name" name="username" required />
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group mb-4">
                                    <label for="acc-email">Email address <span class="required">*</span></label>
                                    <input type="email" class="form-control" id="acc-email" name="email"
                                           value="{{ auth('seller')->user()->email }}" required />
                                </div>

                                <div class="form-group mb-4">
                                    <label for="acc-image">Profile Image <span class="required">*</span></label>
                                    <input type="file" class="form-control" id="acc-image" name="image" required />
                                </div>

                                <div class="change-password">
                                    <h3 class="text-uppercase mb-2">Password Change</h3>

                                    <div class="form-group">
                                        <label for="acc-password">Current Password (leave blank to leave
                                            unchanged)</label>
                                        <input type="password" class="form-control" id="acc-password"
                                               name="current_password" />
                                    </div>

                                    <div class="form-group">
                                        <label for="acc-password">New Password (leave blank to leave
                                            unchanged)</label>
                                        <input type="password" class="form-control" id="acc-new-password"
                                               name="new_password" />
                                    </div>

                                    <div class="form-group">
                                        <label for="acc-password">Confirm New Password</label>
                                        <input type="password" class="form-control" id="acc-confirm-password"
                                               name="confirm_new_password" />
                                    </div>
                                </div>

                                <div class="form-footer mt-3 mb-0">
                                    <button type="submit" class="btn btn-dark mr-0">
                                        Save changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div><!-- End .tab-pane -->

                </div><!-- End .tab-content -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main>
    <!-- End .main -->
    @endSection
