@extends('admin.layout.master')
@section('style')

@endsection
@section('script')
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- this file was missing -->
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>

    <!-- this file was moved after the jQuery Datatables library was laoded -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>

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

                                                @if($type == 'seller')
                                                    @foreach($cats as $cat)
                                                        <span class="badge bg-light-secondary">{{ $cat->title }}</span>
                                                    <br>
                                                    @endforeach
                                                @endif
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
                                                <span class="fw-bolder me-25">Status:</span>
                                                @if($user->allFileStatus == 1)
                                                <span class="badge bg-light-success">
                                                    Activated
                                                </span>
                                                @else
                                                    <span class="badge bg-light-danger">
                                                    Desactive
                                                </span>
                                                @endif
                                            </li>
                                            @if($type == 'seller')
                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">Role:</span>
                                                    <span>@foreach($cats as $cat){{ $cat->title }} ,@endforeach</span>
                                                </li>
                                                @if($user->cat_id<4)
                                                    <li class="mb-75">
                                                        <span class="fw-bolder me-25">website:</span>
                                                        <span><a href="{{ $user->website }}">{{ $user->website }}</a></span>
                                                    </li>
                                                @endif
                                            @endif
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Contact:</span>
                                                <span>{{ $user->phone }}</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Linkedin Profile:</span>
                                                <span><a href="{{ $user->linkedin }}">{{ $user->linkedin }}</a></span>
                                            </li>
                                            @if($type == 'customer' && $user->customer_type == 2)
                                                <li class="mb-75">
                                                    <span class="fw-bolder me-25">website:</span>
                                                    <span><a href="{{ $user->website }}">{{ $user->website }}</a></span>
                                                </li>
                                            @endif
                                        </ul>

                                        <!--Message Modal -->
                                        <div class="modal fade text-start" id="accept" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel1">Accept Confirmation</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" action="{{ route('admin.seller.accept') }}">
                                                        @csrf
                                                        <input type="hidden" name="seller_id" value="{{ $user->id }}">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <h3>Confirm accept company</h3>
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
                                        <!--Message Modal -->
                                        <div class="modal fade text-start" id="default" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel1">Decline Message</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" action="{{ route('admin.seller.decline') }}">
                                                        @csrf
                                                        <input type="hidden" name="seller_id" value="{{ $user->id }}">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="exampleFormControlTextarea1">Enter Decline Message</label>
                                                                        <textarea name="message"
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
                                        <i data-feather="lock" class="font-medium-3 me-50"></i>
                                        <span class="fw-bold">Data</span>
                                    </a>
                                </li>
                            </ul>
                            <!--/ User Pills -->

                            <!-- Project table -->
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Company Data</h4>
                                </div>
                                @if($type == 'seller')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @foreach(json_decode($user->cat_id) as $cat)
                                                @if($cat == 5)
                                                    <div class="training">
                                                        <h3> trainer Info</h3>
                                                        <h5>bio</h5>
                                                        <p>{{ $user->bio }}</p>
                                                        <h5>info</h5>
                                                        <ul>
                                                            <li class="mb-75">
                                                                <span class="fw-bolder me-25">Specialization:</span>
                                                                <span>{{ $user->Specialization }}</span>
                                                            </li>
                                                            <li class="mb-75">
                                                                <span class="fw-bolder me-25">Price:</span>
                                                                <span>{{ $user->price }}/ {{ $user->price_type }}</span>
                                                            </li>
                                                            <li class="mb-75">
                                                                <span class="fw-bolder me-25">online or offline:</span>
                                                                <span>{{ $user->type_cource == 1?"online":"offline"}}</span>
                                                            </li>
                                                            @if($user->type_cource == 0)
                                                                <li class="mb-75">
                                                                    <span class="fw-bolder me-25">workspace:</span>
                                                                    <span>{{ $user->work_space == 0?"Turn Workspace":"other workspace" }}</span>
                                                                </li>
                                                                @if($user->work_space == 1)
                                                                    <li class="mb-75">
                                                                        <span class="fw-bolder me-25">location:</span>
                                                                        <span>{{ $user->location }}</span>
                                                                    </li>
                                                                @endif
                                                            @endif
                                                            <li class="mb-75">
                                                                <span class="fw-bolder me-25">min number trainees:</span>
                                                                <span>{{ $user->min_num_trainees }}</span>
                                                            </li>
                                                        </ul>
                                                            <h5>Date Available </h5>
                                                        <ul>
                                                            <li class="mb-75">
                                                                <span class="fw-bolder me-25">start Date:</span>
                                                                <span>{{ $user->start_date }}</span>
                                                            </li>
                                                            <li class="mb-75">
                                                                <span class="fw-bolder me-25">end Date:</span>
                                                                <span>{{ $user->end_date }}</span>
                                                            </li>
                                                        </ul>
                                                        @if($user->docs != null)
                                                            @foreach(json_decode($user->docs) as $docs)
                                                                <div class="mb-2 pb-50">
                                                                    <h5>Documents</h5>
                                                                    <a href="{{ route('seller.file',['registration',$docs,$user->name]) }}" class="btn btn-primary">Download File</a>
                                                                </div>
                                                            @endforeach
                                                            @if($user->docs_status == 0)<a href="{{ route('admin.seller.accept.file',[$user->id,'docs']) }}" class="btn btn-success">Accept All Documents</a>@endif
                                                            @if($user->docs_status != -1)
                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refusedocs1">
                                                                    Refuse All Documents
                                                                </button>
                                                                <div class="modal fade" id="refusedocs1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="myModalLabel17">Refuse All Documents</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form method="post" action="{{ route('admin.seller.refuse.file') }}">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                        <input type="hidden" name="files_type" value="docs">
                                                                                        <div class="form-group">
                                                                                            <label for="exampleFormControlTextarea1">Reason</label>
                                                                                            <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-danger">Send</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                @elseif($cat == 4)
                                                        <h3> manpower Info</h3>
                                                        <div class="mb-2 pb-50">
                                                        @if($user->cv != null)
                                                            <h5>CV</h5>
                                                            <a href="{{ route('seller.file',['cv',$user->cv,$user->name]) }}" class="btn btn-primary">Download File</a>
                                                            @if($user->cv_status == 0)
                                                            <a href="{{ route('admin.seller.accept.file',[$user->id,'cv']) }}" class="btn btn-success">Accept File</a>
                                                            @endif
                                                            @if($user->cv_status != -1)
                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refuseCv">
                                                                    Refuse File
                                                                </button>
                                                                <div class="modal fade" id="refuseCv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="myModalLabel17">Refuse File</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <form method="post" action="{{ route('admin.seller.refuse.file') }}">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                    <input type="hidden" name="files_type" value="cv">
                                                                                    <div class="form-group">
                                                                                    <label for="exampleFormControlTextarea1">Reason</label>
                                                                                    <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                                </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-danger">Send</button>
                                                                        </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                        @if($user->docs != null)

                                                        @foreach(json_decode($user->docs) as $docs)
                                                        <div class="mb-2 pb-50">
                                                            <h5>Documents</h5>
                                                            <a href="{{ route('seller.file',['registration',$docs,$user->name]) }}" class="btn btn-primary">Download File</a>
                                                        </div>
                                                    @endforeach
                                                            @if($user->docs_status == 0)
                                                            <a href="{{ route('admin.seller.accept.file',[$user->id,'docs']) }}" class="btn btn-success">Accept All Documents</a>
                                                            @endif
                                                            @if($user->docs_status != -1)
                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refusedocs1">
                                                                    Refuse All Documents
                                                                </button>
                                                                <div class="modal fade" id="refusedocs1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="myModalLabel17">Refuse All Documents</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <form method="post" action="{{ route('admin.seller.refuse.file') }}">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                    <input type="hidden" name="files_type" value="docs">
                                                                                    <div class="form-group">
                                                                                        <label for="exampleFormControlTextarea1">Reason</label>
                                                                                        <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-danger">Send</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                </div>
                                            @elseif($cat<4)
                                                    <div class="company">
                                                        <h3>company info</h3>
                                                        @if($user->registration_certificate != null)
                                                        <div class="mb-2 pb-50">
                                                            <h5>Registration Certificate</h5>
                                                            <a href="{{ route('seller.file',['registration',$user->registration_certificate,$user->name]) }}" class="btn btn-primary">Download File</a>
                                                            @if($user->reg_cert_status == 0)
                                                                <a href="{{ route('admin.seller.accept.file',[$user->id,'regCert']) }}" class="btn btn-success">Accept File</a>
                                                            @endif
                                                            @if($user->reg_cert_status != -1)
                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refuse_regCert">
                                                                    Refuse File
                                                                </button>
                                                                <div class="modal fade" id="refuse_regCert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="myModalLabel17">Refuse All Documents</h5>
                                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <form method="post" action="{{ route('admin.seller.refuse.file') }}">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                    <input type="hidden" name="files_type" value="regCert">
                                                                                    <div class="form-group">
                                                                                        <label for="exampleFormControlTextarea1">Reason</label>
                                                                                        <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn btn-danger">Send</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @endif
                                                        @if($user->tax_card !=null)
                                                        <div class="mb-2 pb-50">
                                                            <h5>Tax Card</h5>
                                                            <a href="{{ route('seller.file',['tax',$user->tax_card,$user->name]) }}" class="btn btn-primary">Download File</a>
                                                            @if($user->tax_card_status == 0)
                                                            <a href="{{ route('admin.seller.accept.file',[$user->id,'tax']) }}" class="btn btn-success">Accept File</a>
                                                            @endif
                                                            @if($user->tax_card_status != -1)
                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refuse_regCert">
                                                                    Refuse File
                                                                </button>
                                                                <div class="modal fade" id="refuse_tax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="myModalLabel17">Refuse All Documents</h5>
                                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <form method="post" action="{{ route('admin.seller.refuse.file') }}">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                    <input type="hidden" name="files_type" value="tax">
                                                                                    <div class="form-group">
                                                                                        <label for="exampleFormControlTextarea1">Reason</label>
                                                                                        <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary">Send</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @endif
                                                        @if($user->vat_cert !=null)
                                                        <div class="mb-2 pb-50">
                                                            <h5>vat Certificate</h5>
                                                            <a href="{{ route('seller.file',['vat',$user->vat_cert,$user->name]) }}" class="btn btn-primary">Download File</a>
                                                            @if($user->vat_cert_status == 0)
                                                            <a href="{{ route('admin.seller.accept.file',[$user->id,'vat']) }}" class="btn btn-success">Accept File</a>
                                                            @endif
                                                            @if($user->vat_cert_status != -1)
                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refuse_regCert">
                                                                    Refuse File
                                                                </button>
                                                                <div class="modal fade" id="refuse_tax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="myModalLabel17">Refuse All Documents</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <form method="post" action="{{ route('admin.seller.refuse.file') }}">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                    <input type="hidden" name="files_type" value="vat">
                                                                                    <div class="form-group">
                                                                                        <label for="exampleFormControlTextarea1">Reason</label>
                                                                                        <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-danger">Send</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                                @endif

                                                        </div>
                                                        @endif
                                                        @if($user->delgation !=null)
                                                        <div class="mb-2 pb-50">
                                                            <h5>Company delegated persone and delgation letter</h5>
                                                            <a href="{{ route('seller.file',['delegation',$user->delgation,$user->name]) }}" class="btn btn-primary">Download File</a>
                                                            @if($user->delgation_status == 0)
                                                            <a href="{{ route('admin.seller.accept.file',[$user->id,'delegation']) }}" class="btn btn-success">Accept File</a>
                                                            @endif
                                                            @if($user->delgation_status != -1)
                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refuse_regCert">
                                                                    Refuse File
                                                                </button>
                                                                <div class="modal fade" id="refuse_tax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="myModalLabel17">Refuse All Documents</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <form method="post" action="{{ route('admin.seller.refuse.file') }}">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                    <input type="hidden" name="files_type" value="delegation">
                                                                                    <div class="form-group">
                                                                                        <label for="exampleFormControlTextarea1">Reason</label>
                                                                                        <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-danger">Send</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @endif
                                                        @if($user->reference_list !=null)
                                                        <div class="mb-2 pb-50">
                                                            <h5>Reference List</h5>
                                                            <a href="{{ route('seller.file',['reference',$user->reference_list,$user->name]) }}" class="btn btn-primary">Download File</a>
                                                            @if($user->reference_status == 0)
                                                            <a href="{{ route('admin.seller.accept.file',[$user->id,'reference']) }}" class="btn btn-success">Accept File</a>
                                                            @endif
                                                            @if($user->reference_status != -1)
                                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refuse_regCert">
                                                                    Refuse File
                                                                </button>
                                                                <div class="modal fade" id="refuse_tax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="myModalLabel17">Refuse All Documents</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <form method="post" action="{{ route('admin.seller.refuse.file') }}">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                    <input type="hidden" name="files_type" value="reference">
                                                                                    <div class="form-group">
                                                                                        <label for="exampleFormControlTextarea1">Reason</label>
                                                                                        <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-danger">Send</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                                @endif

                                                        </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach

                                            </div>
                                        </div>
                                    </div>
                                @elseif($type == 'customer')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if($user->customer_type == 2)
                                                    <div class="company">
                                                        @if($user->registration_certificate !=null)
                                                            <div class="mb-2 pb-50">
                                                            <h5>Registration Certificate</h5>
                                                            <a href="{{ route('customer.file',['registration',$user->registration_certificate,$user->name]) }}" class="btn btn-primary">Download File</a>
                                                            @if($user->reg_cert_status == 0)
                                                                <a href="{{ route('admin.customer.accept.file',[$user->id,'regCert']) }}" class="btn btn-success">Accept File</a>
                                                            @endif
                                                            @if($user->reg_cert_status != -1)
                                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refuse_regCert">
                                                                        Refuse File
                                                                    </button>
                                                                    <div class="modal fade" id="refuse_regCert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="myModalLabel17">Refuse All Documents</h5>
                                                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form method="post" action="{{ route('admin.customer.refuse.file') }}">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                        <input type="hidden" name="files_type" value="regCert">
                                                                                        <div class="form-group">
                                                                                            <label for="exampleFormControlTextarea1">Reason</label>
                                                                                            <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn btn-danger">Send</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                        </div>
                                                        @endif
                                                        @if($user->tax_card !=null)
                                                            <div class="mb-2 pb-50">
                                                                <h5>Tax Card</h5>
                                                                <a href="{{ route('customer.file',['tax',$user->tax_card,$user->name]) }}" class="btn btn-primary">Download File</a>
                                                                @if($user->tax_card_status == 0)
                                                                    <a href="{{ route('admin.customer.accept.file',[$user->id,'tax']) }}" class="btn btn-success">Accept File</a>
                                                                @endif
                                                                @if($user->tax_card_status != -1)
                                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refuse_regCert">
                                                                        Refuse File
                                                                    </button>
                                                                    <div class="modal fade" id="refuse_tax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="myModalLabel17">Refuse All Documents</h5>
                                                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form method="post" action="{{ route('admin.customer.refuse.file') }}">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                        <input type="hidden" name="files_type" value="tax">
                                                                                        <div class="form-group">
                                                                                            <label for="exampleFormControlTextarea1">Reason</label>
                                                                                            <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif
                                                        @if($user->vat_cert !=null)
                                                            <div class="mb-2 pb-50">
                                                                <h5>vat Certificate</h5>
                                                                <a href="{{ route('customer.file',['vat',$user->vat_cert,$user->name]) }}" class="btn btn-primary">Download File</a>
                                                                @if($user->vat_cert_status == 0)
                                                                    <a href="{{ route('admin.customer.accept.file',[$user->id,'vat']) }}" class="btn btn-success">Accept File</a>
                                                                @endif
                                                                @if($user->vat_cert_status != -1)
                                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refuse_regCert">
                                                                        Refuse File
                                                                    </button>
                                                                    <div class="modal fade" id="refuse_tax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="myModalLabel17">Refuse All Documents</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form method="post" action="{{ route('admin.customer.refuse.file') }}">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                        <input type="hidden" name="files_type" value="vat">
                                                                                        <div class="form-group">
                                                                                            <label for="exampleFormControlTextarea1">Reason</label>
                                                                                            <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-danger">Send</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                @endif
                                                            </div>
                                                        @endif
                                                        @if($user->delgation !=null)
                                                            <div class="mb-2 pb-50">
                                                                <h5>Company delegated persone and delgation letter</h5>
                                                                <a href="{{ route('customer.file',['delegation',$user->delgation,$user->name]) }}" class="btn btn-primary">Download File</a>
                                                                @if($user->delgation_status == 0)
                                                                    <a href="{{ route('admin.customer.accept.file',[$user->id,'delegation']) }}" class="btn btn-success">Accept File</a>
                                                                @endif
                                                                @if($user->delgation_status != -1)
                                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refuse_regCert">
                                                                        Refuse File
                                                                    </button>
                                                                    <div class="modal fade" id="refuse_tax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="myModalLabel17">Refuse All Documents</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form method="post" action="{{ route('admin.customer.refuse.file') }}">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                        <input type="hidden" name="files_type" value="delegation">
                                                                                        <div class="form-group">
                                                                                            <label for="exampleFormControlTextarea1">Reason</label>
                                                                                            <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-danger">Send</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif
                                                        @if($user->reference_list !=null)
                                                            <div class="mb-2 pb-50">
                                                                <h5>Reference List</h5>
                                                                <a href="{{ route('customer.file',['reference',$user->reference_list,$user->name]) }}" class="btn btn-primary">Download File</a>
                                                                @if($user->reference_status == 0)
                                                                    <a href="{{ route('admin.customer.accept.file',[$user->id,'reference']) }}" class="btn btn-success">Accept File</a>
                                                                @endif
                                                                @if($user->reference_status != -1)
                                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#refuse_regCert">
                                                                        Refuse File
                                                                    </button>
                                                                    <div class="modal fade" id="refuse_tax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="myModalLabel17">Refuse All Documents</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form method="post" action="{{ route('admin.customer.refuse.file') }}">
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                                                        <input type="hidden" name="files_type" value="reference">
                                                                                        <div class="form-group">
                                                                                            <label for="exampleFormControlTextarea1">Reason</label>
                                                                                            <textarea class="form-control" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-danger">Send</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                @endif
                                                            </div>
                                                        @endif
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
