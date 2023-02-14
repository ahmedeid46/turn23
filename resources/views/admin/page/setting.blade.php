@extends('admin.layout.master')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/pages/page-profile.min.css">

@endsection
@section('script')

@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-body">
            <div id="user-profile">
                <div class="row">
                    <div class="col-12">
                        <div class="card profile-header mb-2">
                            <!-- profile cover photo -->
                            <img class="card-img-top" src="{{ asset('assets/admin') }}/images/profile/user-uploads/timeline.jpg" alt="User Profile Image"/>
                            <!--/ profile cover photo -->

                            <div class="position-relative">
                                <!-- profile picture -->
                                <div class="profile-img-container d-flex align-items-center">
                                    <div class="profile-img">
                                        <img src="{{ route('admin.file',encrypt($user->img)) }}" class="rounded img-fluid" alt="Card image"/>
                                    </div>
                                    <!-- profile title -->
                                    <div class="profile-title ms-3">
                                        <h2 class="text-white">{{ $user->name }}</h2>
                                        <p class="text-white">Admin</p>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-header-nav">
                                <!-- navbar -->
                                <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                                    <button class="btn btn-icon navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <i data-feather="align-justify" class="font-medium-5"></i>
                                    </button>

                                    <!-- collapse  -->
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
                                            <ul class="nav nav-pills mb-0">
                                                <li class="nav-item">
                                                    <a class="nav-link fw-bold" href="{{ route('admin.profile') }}">
                                                        <span class="d-none d-md-block">Information</span>
                                                        <i data-feather="rss" class="d-block d-md-none"></i>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link fw-bold active" href="#">
                                                        <span class="d-none d-md-block">Setting</span>
                                                        <i data-feather="info" class="d-block d-md-none"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--/ collapse  -->
                                </nav>
                                <!--/ navbar -->
                            </div>
                        </div>
                    </div>
                </div>
                <section id="profile-info">
                    <div class="row">
                        <!-- left profile info section -->
                        <div class="col-lg-12 col-12 order-2 order-lg-1">
                            <!-- profile -->
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">Profile Details</h4>
                                </div>
                                <div class="card-body py-2 my-25">
                                    <form method="post" enctype="multipart/form-data" action="{{ route('admin.setting') }}" class="validate-form mt-2 pt-50">
                                        @csrf
                                        <!-- header section -->
                                        <div class="d-flex">
                                            <a href="#" class="me-25">
                                                <img
                                                    src="{{ route('admin.file',encrypt($user->img)) }}"
                                                    id="account-upload-img"
                                                    class="uploadedAvatar rounded me-50"
                                                    alt="profile image"
                                                    height="100"
                                                    width="100"
                                                />
                                            </a>
                                            <!-- upload and reset button -->
                                            <div class="d-flex align-items-end mt-75 ms-1">
                                                <div>
                                                    <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                                    <input type="file" name="img" id="account-upload" hidden accept="image/*" />
                                                    <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                                    <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
                                                </div>
                                            </div>
                                            <!--/ upload and reset button -->
                                        </div>
                                        <!--/ header section -->

                                        <!-- form -->
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label" for="accountFirstName">Name</label>
                                                <input type="text" class="form-control" id="accountFirstName" name="name" placeholder="Ahmed" value="{{ $user->name }}" data-msg="Please enter first name"/>
                                            </div>
                                            <div class="col-12 ">
                                                <label class="form-label" for="accountEmail">Email</label>
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    id="accountEmail"
                                                    name="email"
                                                    placeholder="Email"
                                                    value="{{ $user->email }}"
                                                />
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label" for="accountPassword">Password</label>
                                                <input type="Password" class="form-control" id="accountPassword" name="Password" placeholder="Your Password" />
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label" for="ConfirmPassword">Confirm Password</label>
                                                <input type="password" class="form-control" id="ConfirmPassword" name="password_confirmation" placeholder="Confirm Password" />
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mt-1 me-1">Save changes</button>
                                                <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!--/ form -->
                                </div>
                            </div>


                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


@endsection
