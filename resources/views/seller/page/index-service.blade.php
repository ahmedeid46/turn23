@extends('seller.layout.master')
@section('styles')
@endsection
@section('script')

@endsection
@section('content')
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-chemical.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                My Dashboard
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>My Dashboard</h1>
            </div>
        </div>
        <div class="alert-danger"> {{ Session::get('notAllow')}}</div>

        <div class="container account-container custom-account-container">
            <div class="row">
                <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
                    <h2 class="text-uppercase">My Account</h2>
                    <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard"
                               role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                               aria-controls="edit" aria-selected="false">Account
                                details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.html">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9 order-lg-last order-1 tab-content">
                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                        <div class="dashboard-content">

                            <p>
                                From your account dashboard you can view your
                                <a class="btn btn-link link-to-tab" href="#order">recent orders</a>,
                                manage your
                                <a class="btn btn-link link-to-tab" href="#address">shipping and billing
                                    addresses</a>, and
                                <a class="btn btn-link link-to-tab" href="#edit">edit your password and account
                                    details.</a>
                            </p>

                            <div class="mb-4"></div>

                            <div class="row row-lg">
                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#addCat" class="link-to-tab"><i class="icon-user-2"></i></a>
                                        <div class="feature-box-content p-0">
                                            <h3>Add Category Service</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#edit" class="link-to-tab"><i class="icon-user-2"></i></a>
                                        <div class="feature-box-content p-0">
                                            <h3>ACCOUNT DETAILS</h3>
                                        </div>
                                    </div>
                                </div>
                                <form id="logout" action="{{ route('seller.logout') }}" method="post">
                                    @csrf
                                </form>
                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a onclick="$('#logout').submit()"><i class="fas fa-sign-out-alt"></i></a>
                                        <div class="feature-box-content">
                                            <h3>LOGOUT</h3>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End .row -->
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="addCat" role="tabpanel">
                        <h3 class="account-sub-title d-none d-md-block mb-1"><i
                                    class="sicon-location-pin align-middle mr-3"></i>Products</h3>
                        <div class="order-table-container text-center">
                            <button style="width: 300px;height: 41px;" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Category</button>

                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{ route('seller.service.update.cat') }}">
                                            @csrf
                                            <div style="height: 500px;" class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="float-left">
                                                                <div class="" style="width: 100% !important" >Chose your Categories</div>
                                                                @foreach($allCats as $allCat)
                                                                    <h5>{{ $allCat->title }}</h5>
                                                                    <ul class="row">
                                                                        @foreach($allCat->subsubCat as $subsubcat)
                                                                            <li class="" style="margin-left:10px "><input type='checkbox' name="subCat[]" value='{{ $subsubcat->id }}'><label tabindex='-1' for='1'>{{ $subsubcat->title }}</label></li>
                                                                        @endforeach
                                                                    </ul>

                                                                @endforeach
                                                                <div class="row">
                                                                    <input type='checkbox' name="subCat[]" value='other'>
                                                                    <label tabindex='-1' for='1'>other Sub Sub Cat</label>
                                                                    <select name="new_sub_cat_id">
                                                                        @foreach($allCats as $allCat)
                                                                            <option>{{ $allCat->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <input type="text" name="new_sub_cat" placeholder="Other"></li>

                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                            <table class="table table-order text-left">
                                <thead>
                                <tr>
                                    <th class="order-id">Subcategory</th>
                                    <th class="order-date">Products Number</th>
                                    <th class="order-action">ACTIONS</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subcats as $subcat)
                                    <tr>
                                        <td>{{ $subcat->subCat->title }}</td>
                                        <td>{{ count($subcat->subCat->allproduct) }}</td>
                                        <td>
                                            <div class="action">
                                                {{--                                                <a href="{{ route('seller.products',$hashids->encode($subcat->subCat->id)) }}" class="btn btn-primary">Enter</a>--}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <hr class="mt-0 mb-3 pb-2" />
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="edit" role="tabpanel">
                        <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
                                    class="icon-user-2 align-middle mr-3 pr-1"></i>Account Details</h3>
                        <div class="account-content">
                            <form action="{{ route('seller.account.edit') }}" enctype="multipart/form-data" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="acc-name"> name <span class="required">*</span></label>
                                            <input type="text" class="form-control" value="{{ auth()->user()->name }}"
                                                   id="acc-name" name="name" required />
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group mb-4">
                                    <label for="acc-email">Email address <span class="required">*</span></label>
                                    <input type="email" class="form-control" id="acc-email" name="email"
                                           value="{{ auth()->user()->email }}" required />
                                </div>
                                <div class="form-group mb-4">
                                    <label for="acc-email">Phone <span class="required">*</span></label>
                                    <input type="email" class="form-control" id="acc-email" name="phone"
                                           value="{{ auth()->user()->phone }}" required />
                                </div>


                                <div class="form-group mb-4">
                                    <label for="acc-image">Profile Image <span class="required">*</span></label>
                                    <input type="file" class="form-control" id="acc-image" name="image"  />
                                </div>
                                <div class="form-group mb-4">
                                    <label for="acc-image">CV <span class="required">*</span></label>
                                    <input type="file" class="form-control" id="acc-image" name="cv"  />
                                </div>


                                <div class="change-password">
                                    <h3 class="text-uppercase mb-2">Password Change</h3>
                                    <div class="form-group">
                                        <label for="acc-password">New Password (leave blank to leave
                                            unchanged)</label>
                                        <input type="password" class="form-control" id="acc-new-password"
                                               name="password" />
                                    </div>

                                    <div class="form-group">
                                        <label for="acc-password">Confirm New Password</label>
                                        <input type="password" class="form-control" id="acc-confirm-password"
                                               name="password_confirmation" />
                                    </div>
                                </div>

                                <div class="form-footer mt-3 mb-0">
                                    <button type="submit" class="btn btn-dark mr-0">
                                        Save changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div><!-- End .tab-pane -->

                </div><!-- End .tab-content -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main>
    <!-- End .main -->
@endSection
