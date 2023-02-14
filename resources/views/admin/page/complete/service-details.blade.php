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
                        <div class="col-xl-6 col-lg-6 col-md-6 order-1 order-md-0">
                            <!-- User Card -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class="d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mt-3 mb-2" src="{{ asset('assets/admin') }}/images/portrait/small/avatar-s-2.jpg" height="110" width="110" alt="User avatar"/>
                                            <div class="user-info text-center">
                                                <h4>{{ $service->customer->name }}</h4>
                                                <span class="badge bg-light-secondary">{{ $service->code }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Name:</span>
                                                <span>{{ $service->customer->name }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Email:</span>
                                                <span>{{ $service->customer->email }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Status:</span>
                                                @if($service->status == 1)
                                                    <span class="badge bg-light-success">Active</span>
                                                @elseif($service->status == 0)
                                                    <span class="badge bg-light-warning">padding</span>
                                                @elseif($service->status == 2)
                                                    <span class="badge bg-light-primary">Customer Select Price List</span>
                                                @elseif($service->status == 3)
                                                    <span class="badge bg-light-info">Complete</span>
                                                @else
                                                    <span class="badge bg-light-danger">Block</span>

                                                @endif

                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Role:</span>
                                                <span>Customer</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Contact:</span>
                                                <span>{{ $service->customer->phone }}</span>
                                            </li>

                                        </ul>
                                        @if($service->status < 1)
                                        <div class="d-flex justify-content-center pt-2">
                                            <a style="margin-right: 10px" href="javascript:;" class="btn btn-outline-danger suspend-user" data-bs-toggle="modal" data-bs-target="#default">Decline</a>
                                            <a href="javascript:;" class="btn btn-outline-success suspend-user" data-bs-toggle="modal" data-bs-target="#accept">Accept</a>
                                        </div>
                                        @endif
                                        <!--Message Modal -->
                                        <div class="modal fade text-start" id="default" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel1">Decline Message</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" action="{{ route('admin.service.decline') }}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $service->id }}">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="exampleFormControlTextarea1">Enter Decline Message</label>
                                                                        <textarea
                                                                            name="message"
                                                                            class="form-control"
                                                                            id="exampleFormControlTextarea1"
                                                                            rows="3"
                                                                            placeholder="Message"
                                                                        ></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Send</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade text-start" id="accept" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel1">Decline Message</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" action="{{ route('admin.service.accept') }}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $service->id }}">
                                                        <div class="modal-body">
                                                            <h3>Confirm accept this service</h3>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Send</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($price_lists != null && $catService != null)
                        <div class="col-xl-6 col-lg-6 col-md-6 order-1 order-md-0">
                            <!-- User Card -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class="d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mt-3 mb-2" src="{{ asset('assets/admin') }}/images/portrait/small/avatar-s-2.jpg" height="110" width="110" alt="User avatar"/>
                                            <div class="user-info text-center">
                                                <h4>{{ $price_lists->seller->name }}</h4>
                                                <span class="badge bg-light-secondary">{{ $price_lists->code }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Name:</span>
                                                <span>{{ $price_lists->seller->name }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Email:</span>
                                                <span>{{ $price_lists->seller->email }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Status:</span>
                                                @if($service->status == 1)
                                                    <span class="badge bg-light-success">Active</span>
                                                @elseif($service->status == 0)
                                                    <span class="badge bg-light-warning">padding</span>
                                                @elseif($service->status == 2)
                                                    <span class="badge bg-light-primary">Customer Select Price List</span>
                                                @elseif($service->status == 3)
                                                    <span class="badge bg-light-info">Complete</span>
                                                @else
                                                    <span class="badge bg-light-danger">Block</span>

                                                @endif

                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Role:</span>
                                                <span>Service provider</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Contact:</span>
                                                <span>{{ $price_lists->seller->phone }}</span>
                                            </li>
{{--                                            <li class="mb-75">--}}
{{--                                                <span class="fw-bolder me-25">Start Date:</span>--}}
{{--                                                <span>{{ date('l jS \of F Y',strtotime($price_lists->start_date)) }}</span>--}}
{{--                                            </li>--}}
{{--                                            <li class="mb-75">--}}
{{--                                                <span class="fw-bolder me-25">Duration:</span>--}}
{{--                                                <span>{{ $price_lists->duration }}</span>--}}
{{--                                            </li>--}}
{{--                                            <li class="mb-75">--}}
{{--                                                <span class="fw-bolder me-25">Residence:</span>--}}
{{--                                                <span>--}}
{{--                                                    @if($price_lists->residence == 1)--}}
{{--                                                        Full accommodation on the Customer--}}
{{--                                                    @elseif($price_lists->residence == 2)--}}
{{--                                                        Accommodation from the attached price list--}}
{{--                                                    @elseif($price_lists->residence == 3)--}}
{{--                                                        There is no accommodation--}}
{{--                                                    @endif--}}
{{--                                                </span>--}}
{{--                                            </li>--}}
{{--                                            <li class="mb-75">--}}
{{--                                                <span class="fw-bolder me-25" >transport:</span>--}}
{{--                                                <span>--}}
{{--                                                    @if($price_lists->transportation == 1)--}}
{{--                                                        Internal only--}}
{{--                                                    @elseif($price_lists->transportation == 2)--}}
{{--                                                        Internal And External--}}
{{--                                                    @endif--}}
{{--                                                </span>--}}
{{--                                            </li>--}}
{{--                                            <li class="mb-75">--}}
{{--                                                <span class="fw-bolder me-25">Attendees:</span>--}}
{{--                                                <div>--}}
{{--                                                    <ul>--}}
{{--                                                        @foreach(json_decode($service->attendees) as $attendees)--}}
{{--                                                           <li class="mb-75"> {{ date('l jS \of F Y',strtotime($attendees)) }} </li>--}}
{{--                                                        @endforeach--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}

{{--                                            </li>--}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ User Sidebar -->
                        @endif

                        <!-- User Content -->
                        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                            <!-- User Pills -->
                            <ul class="nav nav-pills mb-2">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">
                                        <i data-feather="lock" class="font-medium-3 me-50"></i>
                                        <span class="fw-bold">Data</span>
                                    </a>
                                </li>
                            </ul>
                            <!--/ User Pills -->
                            @if($catService != null)
                                <!-- Project table -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Service Description</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-2 pb-50">
                                                    <h4>Drawing</h4>
                                                    <a href="{{ route('admin.service.file',['drawing',$service->drawing]) }}" class="btn btn-outline-primary suspend-user">Download</a>
                                                </div>
                                                <div class="mb-2 pb-50">
                                                    <h4>BOQ</h4>
                                                    <a href="{{ route('admin.service.file',['boq',$service->boq]) }}" class="btn btn-outline-primary suspend-user">Download</a>
                                                </div>
                                                <div class="mb-2 pb-50">
                                                    <h4>Vendor List</h4>
                                                    <a href="{{ route('admin.service.file',['vendorlist',$service->vendorlist]) }}" class="btn btn-outline-primary suspend-user">Download</a>
                                                </div>
                                                <div class="mb-2 pb-50">
                                                    <h4>project specification</h4>
                                                    <a href="{{ route('admin.service.file',['project_specification',$service->project_specification]) }}" class="btn btn-outline-primary suspend-user">Download</a>
                                                </div>
                                                <div class="mb-2 pb-50">
                                                    <h4>specs</h4>
                                                    <a href="{{ route('admin.service.file',['specs',$service->specs]) }}" class="btn btn-outline-primary suspend-user">Download</a>
                                                </div>
                                                <div class="mb-2 pb-50">
                                                    <h4>other</h4>
                                                    <a href="{{ route('admin.service.file',['other',$service->other]) }}" class="btn btn-outline-primary suspend-user">Download</a>
                                                </div>

                                                @foreach($service->price_lists as $price_list)
                                                    @if($price_list->status == 2)
                                                        <div class="mb-2 pb-50">
                                                            <h4>Accepted Price List</h4>
                                                            <a href="{{ route('admin.service.file',['price',$price_list->files]) }}" class="btn btn-outline-primary suspend-user">Download</a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                <div class="mb-2 pb-50">
                                                    <h4>Rate</h4>
                                                    <b>{{ $service->rate }}</b>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Project table -->
                            @endif
                            @if($catManpower != null)
                                <!-- Project table -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Service Description</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>data</th>
                                                            <th>value</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>title</td>
                                                                <td>{{ $service->code }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>interview</td>
                                                                <td>{{ $service->interview_option == 1?"Online":"Offline" }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>interview date</td>
                                                                <td>{{ $service->date_interview }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Accommodation</td>
                                                                <td>{{ $service->accommodation }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Transportation</td>
                                                                <td>{{ $service->transportation }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>food</td>
                                                                <td>{{ $service->food }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>taxes</td>
                                                                <td>{{ $service->food }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>insurance</td>
                                                                <td>{{ $service->food }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Project table -->
                            @endif
                        </div>
                        <!--/ User Content -->
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection
