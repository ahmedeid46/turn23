@extends('admin.layout.master')
@section('style')

@endsection
@section('script')

@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-detached">
                <div class="content-body">

                    <!-- background Overlay when sidebar is shown  starts-->
                    <div class="body-content-overlay"></div>
                    <!-- background Overlay when sidebar is shown  ends-->

                    <!-- E-commerce Search Bar Starts -->
                    <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control search-product" id="shop-search" placeholder="Search Service" aria-label="Search..." aria-describedby="shop-search"/>
                                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- E-commerce Search Bar Ends -->

                    <!-- E-commerce Products Starts -->
                    <section id="ecommerce-products" class="grid-view">
                        @foreach($users as $user)
                            <div class="card card-profile">
                                <img src="{{ asset('assets/admin') }}/images/banner/banner-12.jpg" class="img-fluid card-img-top" alt="Profile Cover Photo"/>
                                <div class="card-body">
                                    <h3><a href="{{ route('admin.users.customer.details',$user->id) }}">{{ $user->name }}</a> </h3>
                                    @if($user->status == 1)
                                        <span class="badge bg-light-success profile-badge">Active</span>
                                    @elseif($user->status == 0)
                                        <span class="badge bg-light-warning profile-badge">padding</span>
                                    @else
                                        <span class="badge bg-light-danger profile-badge">Block</span>
                                    @endif
                                    <hr class="mb-2" />
                                    <div class=" align-items-center">
                                        <a class="btn btn-primary" href="{{ route('admin.users.customer.details',$user->id) }}">Enter</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </section>
                    <!-- E-commerce Products Ends -->

                    <!-- E-commerce Pagination Starts -->
                    <section id="ecommerce-pagination">
                        <div class="align-items-center">
                                {!! $users->links() !!}
                        </div>
                    </section>
                    <!-- E-commerce Pagination Ends -->

                </div>
            </div>
        </div>
    </div>

@endsection
