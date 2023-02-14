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
                <div class="col-md-6 col-xl-6">
                    <div class="card border-0 text-white text-center mb-3">
                        <img class="card-img" src="{{ asset('assets/admin') }}/images/slider/10.jpg" alt="Card image" />
                        <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
                            <h4 class="card-title">Company</h4>
                            <a href="{{ route('admin.permission.cat.service',3) }}" class="btn btn-outline-primary">Join</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-6">
                    <div class="card border-0 text-white text-center mb-3">
                        <img class="card-img" src="{{ asset('assets/admin') }}/images/slider/10.jpg" alt="Card image" />
                        <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
                            <h4 class="card-title">Manpower</h4>
                            <a href="{{ route('admin.permission.cat.service',4) }}" class="btn btn-outline-primary">Join Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
