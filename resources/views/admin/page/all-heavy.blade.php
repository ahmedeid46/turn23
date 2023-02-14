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
                @foreach($cats as $cat)
                    <div class="col-md-4 col-xl-4">
                        <div class="card border-0 text-white text-center mb-3">
                            <img class="card-img" src="{{ asset('img/seller.jpg') }}" alt="Card image" />
                            <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
                                <button style="margin-top: -45%;border-radius: 50%"  class="btn btn-warning ">0</button>
                                <h4 class="card-title">{{ $cat->title }}</h4>
                                <a href="{{ route('admin.equipment.orders.cat',$cat->id) }}" class="btn btn-primary">Join</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
    </div>

@endsection
