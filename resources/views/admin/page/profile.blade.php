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
                                    <div class="profile-img bg-danger">
                                        @if(auth('admin')->user()->img != null)
                                        <img src="{{ route('admin.file',encrypt($user->img)) }}" class="" alt="Card image"/>
                                        @else
                                            <div class="text-center">
                                                <h1 class="mt-4 text-white">AD</h1>

                                            </div>
                                        @endif
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
                                                    <a class="nav-link fw-bold active" href="#">
                                                        <span class="d-none d-md-block">Information</span>
                                                        <i data-feather="rss" class="d-block d-md-none"></i>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link fw-bold" href="{{ route('admin.setting.show') }}">
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
                            <!-- about -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-75">About</h5>
                                    <div class="mt-2">
                                        <h5 class="mb-75">username:</h5>
                                        <p class="card-text">{{ $user->name }}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h5 class="mb-75">Email:</h5>
                                        <p class="card-text">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <!--/ about -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


@endsection
