@extends('customer.layout.master')
@section('style')

@endsection
@section('script')

@endsection
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('customer.home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $cat->title }}</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-section row">
                        @foreach($cat->subCat as $subcat)
                        <div class="col-md-6 col-lg-4">
                            <article class="post">
                                <div class="post-media">
                                    <a href="{{ route('customer.products',$subCatHashids->encode($subcat->id)) }}">
                                        <img src="{{ asset('assets/customer') }}/images/1.png" alt="Post" width="225" height="280">
                                    </a>
                                    <div class="post-date">
                                        <span>{{ $subcat->title }}</span>
                                    </div>
                                </div><!-- End .post-media -->

                                <div STYLE="text-align: center" class="post-body">
                                    <h2 class="post-title">
                                        <a href="{{ route('customer.products',$subCatHashids->encode($subcat->id)) }}">
                                            {{ $subcat->title }}</a>
                                    </h2>
                                    <button onclick="window.location.href='{{ route('customer.products',$subCatHashids->encode($subcat->id)) }}'" class="btn btn-success btn-rounded btn-md"> Enter </button>
                                </div><!-- End .post-body -->
                            </article><!-- End .post -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div><!-- End .row -->
        </div><!-- End .container -->
    </main>
    <!-- End .main -->
@endsection
