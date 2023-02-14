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
            @foreach($cats as $cat)
                <div class="col-md-6 col-xl-4">
                    <div class="card border-0 text-white text-center mb-3">
                        <img class="card-img" src="{{ asset('assets/admin') }}/images/slider/10.jpg" alt="Card image" />
                        <div style="padding-top: 65px" class="card-img-overlay bg-overlay">
                            <h4 class="card-title">{{ $cat->title }}</h4>
                            @if($cat->id ==1)
                            <a href="{{ route('admin.permission.product') }}" class="btn btn-primary">Join</a>
                            @else
                                <a href="{{ route('admin.industrial.permission.product') }}" class="btn btn-primary">Join </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
