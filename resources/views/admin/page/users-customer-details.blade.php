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
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="app-user-view-account">
                    <div class="row">
                        <!-- User Sidebar -->
                        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                            <!-- User Card -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class="d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mt-3 mb-2" src="{{ asset('assets/admin') }}/images/portrait/small/avatar-s-2.jpg" height="110" width="110" alt="User avatar"/>
                                            <div class="user-info text-center">
                                                <h4>{{ $user->name }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Name:</span>
                                                <span>{{ $user->name }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Email:</span>
                                                <span>{{ $user->email }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Contact:</span>
                                                <span>{{ $user->phone }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Status:</span>
                                                <span class="badge bg-light-{{ $user->status==1?'success' : "danger" }}">{{ $user->status==1?'Active' : "Block" }}</span>

                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-center pt-2">
                                            <form method="post" action="{{ route('admin.user.customer.block') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <div class="d-flex justify-content-center pt-2">
                                                    @if($user->status == 1)
                                                        <button type="submit"  class="btn btn-outline-danger suspend-user">Disabled</button>
                                                    @else
                                                        <button type="submit"  class="btn btn-outline-success suspend-user">Active</button>
                                                    @endif                                                </div>
                                            </form>                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ User Sidebar -->

                        <!-- User Content -->
                        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                            <!-- User Pills -->
                            <ul class="nav nav-pills mb-2">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">
                                        <i data-feather="user" class="font-medium-3 me-50"></i>
                                        <span class="fw-bold">Service</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#">
                                        <i data-feather="user" class="font-medium-3 me-50"></i>
                                        <span class="fw-bold">orders</span>
                                    </a>
                                </li>


                            </ul>
                            <!--/ User Pills -->


                            <!-- Project table -->
                            <div class="card">
                                <h4 class="card-header">User Service Requested</h4>
                                <div class="row" id="basic-table">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>service</th>
                                                        <th>Status</th>
                                                        <td>Request Data</td>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($user->service as $service)
                                                        <tr>
                                                        <td><span class="fw-bold">{{ $service->code }}</span></td>
                                                        <td>{{ $service->status == 0? "Padding":($service->status == 1? 'Processing':($service->status ==2 ?"Complete":"Blocked")) }}</td>
                                                        <td>{{ date('F j, Y, g:i a',strtotime($service->created_at)) }}</td>
                                                        <td><a href="{{ route('admin.permission.service.details',$service->id) }}" class="btn btn-primary">Review</a></td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Project table -->
                        </div>
                        <!--/ User Content -->
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection
