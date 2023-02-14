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
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card border-0 text-white text-center mb-3">
                    <img class="card-img" src="{{ asset('assets/admin') }}/images/slider/10.jpg" alt="Card image" />
                    <div style="padding-top: 65px" class="card-img-overlay bg-overlay">
                        <h4 class="card-title">Training Request</h4>
                        <a href="{{ route('admin.training.request') }}" class="btn btn-primary">Join</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card border-0 text-white text-center mb-3">
                    <img class="card-img" src="{{ asset('assets/admin') }}/images/slider/10.jpg" alt="Card image" />
                    <div style="padding-top: 65px" class="card-img-overlay bg-overlay">
                        <h4 class="card-title">Training Groups</h4>
                        <a href="{{ route('admin.training') }}" class="btn btn-primary">Join</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
