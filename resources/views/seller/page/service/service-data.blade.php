@extends('seller.layout.master')
@section('styles')
@endsection
@section('script')
@endsection
@section('content')
    <main class="main about">
        <div class="page-header page-header-bg text-left"
             style="background: 50%/cover #D4E1EA url('assets/images/page-header-bg.jpg');">
            <div class="container">
                <h1><span>Service Description</span>
                    {{ $service->code }}</h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Service Description</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="about-section">
            <div class="container">
                <h3 class="subtitle">Drawing</h3>
                <a class="btn btn-primary" href="{{ route('service.files',[encrypt('drawing'),encrypt($service->drawing)]) }}">Download Drawing</a>
                <h3 class="subtitle">BOQ</h3>
                <a class="btn btn-primary" href="{{ route('service.files',[encrypt('boq'),encrypt($service->boq)]) }}">Download BOQ</a>
                <h3 class="subtitle">Vendor List</h3>
                <a class="btn btn-primary" href="{{ route('service.files',[encrypt('vendorlist'),encrypt($service->vendorlist)]) }}">Download Vendor List</a>
                <h3 class="subtitle">Project Specification</h3>
                <a class="btn btn-primary" href="{{ route('service.files',[encrypt('project_specification'),encrypt($service->project_specification)]) }}">Download Project Specification</a>
                <h3 class="subtitle">Specs</h3>
                <a class="btn btn-primary" href="{{ route('service.files',[encrypt('specs'),encrypt($service->specs)]) }}">Download Specs</a>
                <h3 class="subtitle">Other File</h3>
                <a class="btn btn-primary" href="{{ route('service.files',[encrypt('other'),encrypt($service->other)]) }}">Download Other File</a>
            </div><!-- End .container -->
        </div><!-- End .about-section -->
    </main>
    <!-- End .main -->
@endSection


