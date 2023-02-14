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
                <div class="col-md-4 col-xl-4">
                    <div class="card border-0 text-white text-center mb-3">
                        <img class="card-img" src="{{ asset('img/seller.jpg') }}" alt="Card image" />
                        <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
{{--                            <button style="margin-top: -45%;border-radius: 50%"  class="btn btn-warning ">{{ $orderscount }}</button>--}}
                            <h4 class="card-title">Chemical</h4>
                            <a href="{{ route('admin.complete.chemical') }}" class="btn btn-primary">Join</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4">
                    <div class="card border-0 text-white text-center mb-3">
                        <img class="card-img" src="{{ asset('img/customer.jpg') }}" alt="Card image" />
                        <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
                            <button style="margin-top: -45%;border-radius: 50%"  class="btn btn-warning ">0</button>
                            <h4 class="card-title">Industrial</h4>
                            <a href="#" class="btn btn-primary">Join</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4">
                    <div class="card border-0 text-white text-center mb-3">
                        <img class="card-img" src="{{ asset('img/customer.jpg') }}" alt="Card image" />
                        <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
                            <button style="margin-top: -45%;border-radius: 50%"  class="btn btn-warning ">0</button>
                            <h4 class="card-title">Service Provider</h4>
                            <a href="{{ route('admin.complete.cat.service',3) }}" class="btn btn-primary">Join</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4">
                    <div class="card border-0 text-white text-center mb-3">
                        <img class="card-img" src="{{ asset('img/customer.jpg') }}" alt="Card image" />
                        <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
                            <button style="margin-top: -45%;border-radius: 50%"  class="btn btn-warning ">0</button>
                            <h4 class="card-title">Manpower</h4>
                            <a href="{{ route('admin.complete.cat.service',4) }}" class="btn btn-primary">Join</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4">
                    <div class="card border-0 text-white text-center mb-3">
                        <img class="card-img" src="{{ asset('img/customer.jpg') }}" alt="Card image" />
                        <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
                            <button style="margin-top: -45%;border-radius: 50%"  class="btn btn-warning ">0</button>
                            <h4 class="card-title">Heavy equipment</h4>
                            <a href="{{ route('admin.complete.cat.service',6) }}" class="btn btn-primary">Join</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4">
                    <div class="card border-0 text-white text-center mb-3">
                        <img class="card-img" src="{{ asset('img/customer.jpg') }}" alt="Card image" />
                        <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
                            <button style="margin-top: -45%;border-radius: 50%"  class="btn btn-warning ">0</button>
                            <h4 class="card-title">Training</h4>
                            <a href="{{ route('admin.complete.trainings') }}" class="btn btn-primary">Join</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
