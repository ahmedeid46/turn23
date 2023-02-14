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
                        <img class="card-img" src="{{ asset('img/seller.jpg') }}" alt="Card image" />
                        <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
                            <button style="margin-top: -45%;border-radius: 50%"  class="btn btn-warning ">{{ $sellercount }}</button>
                            <h4 class="card-title">Seller</h4>
                            <a href="{{ route('admin.seller') }}" class="btn btn-primary">Join</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-6">
                    <div class="card border-0 text-white text-center mb-3">
                        <img class="card-img" src="{{ asset('img/customer.jpg') }}" alt="Card image" />
                        <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
                            <button style="margin-top: -45%;border-radius: 50%"  class="btn btn-warning ">{{ $customercount }}</button>
                            <h4 class="card-title">Custumer</h4>
                            <a href="{{ route('admin.customer') }}" class="btn btn-primary">Join</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
