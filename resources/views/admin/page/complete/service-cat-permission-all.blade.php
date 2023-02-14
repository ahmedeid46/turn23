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
                @foreach($subcats as $sub_cat)
                <div class="col-md-6 col-xl-6">
                    <div class="card border-0 text-white text-center mb-3">
                        <img class="card-img" src="{{ asset('assets/admin') }}/images/slider/10.jpg" alt="Card image" />
                        <div style="padding-top: 25%" class="card-img-overlay bg-overlay">
                            <h4 class="card-title">{{ $sub_cat->title }}</h4>
                            @if($title == 'sub')
                            <a href="{{ route('admin.complete.sub.cat.server',$sub_cat->id) }}" class="btn btn-outline-primary">Join</a>
                            @else
                                <a href="{{ route('admin.complete.service',$sub_cat->id) }}" class="btn btn-outline-primary">Join</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </section>
    </div>

@endsection
