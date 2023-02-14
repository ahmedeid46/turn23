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
            @foreach($subCats as $subCat)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card card-developer-meetup">
                        <div class="meetup-img-wrapper rounded-top text-center">
                            <img src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/illustration/email.svg" alt="Meeting Pic" height="170" />
                        </div>
                        <div class="card-body">
                            <div class="meetup-header d-flex align-items-center">

                                <div class="my-auto">
                                    @if($page == 'ssc')
                                    <h4 class="card-title mb-25">{{ $subCat->name }} </h4>
                                    @elseif($page == 'sc')
                                        <h4 class="card-title mb-25">{{ $subCat->title }} </h4>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex flex-row meetings align-items-center">
                                @if($page == 'ssc')
                                    <a href="{{ route('admin.products',$subCat->id) }}" class="btn btn-outline-primary">Join</a>
                                @elseif($page == 'sc')
                                    <a href="{{ route('admin.sub.sub.cat',$subCat->id) }}" class="btn btn-outline-primary">Join</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection
