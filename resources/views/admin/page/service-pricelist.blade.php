@extends('admin.layout.master')
@section('style')

@endsection
@section('script')
    <script type="text/javascript">
        var $rows = $('#table tbody tr');
        $('#search').on('input',function() {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

            $rows.show().filter(function() {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });
    </script>
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="row">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Price list</h4>
                            <div class="col-12">
                                <input class="form-control " id="search" type="text" placeholder="Search..." >
                            </div>
                        </div>
                        <div class="table-responsive">
                            @if($type == 'service')
                                <table id="table" class="table">
                                    <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Company Code</th>
                                        <th>Price List Code</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($price_lists as $price_list)
                                        <tr>
                                            <td>
                                                <span class="fw-bold">{{ $price_list->seller->name }}</span>
                                            </td>
                                            <td>SP{{ $price_list->seller->id }}</td>
                                            <td>{{ $price_list->code }}</td>
                                            <td>
                                                @if($price_list->status == 1)
                                                    <span class="badge bg-light-success">Active</span>
                                                @elseif($price_list->status == 0)
                                                    <span class="badge bg-light-warning">padding</span>
                                                @elseif($price_list->status == 2)
                                                    <span class="badge bg-light-primary">Selected</span>
                                                @else
                                                    <span class="badge bg-light-danger">Block</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('service.files',['price',$price_list->files]) }}">
                                                    <i data-feather="arrow-down" class="me-50"></i>
                                                    <span>Download</span>
                                                </a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#upload{{ $price_list->id }}">
                                                    <i data-feather="arrow-up" class="me-50"></i>
                                                    <span>Upload</span>
                                                </a>
                                                <a href="#"  data-bs-toggle="modal" data-bs-target="#default{{ $price_list->id }}">
                                                    <i data-feather="{{ $price_list->status!=1?"thumbs-up":'thumbs-down' }}" class="me-50"></i>
                                                    <span>{{ $price_list->status!=1?"Accept":'Disable' }}</span>
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="modal fade text-start" id="upload{{ $price_list->id }}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel1">{{ $price_list->status!=1?"Accept":'Disable' }} Confirmation</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" enctype="multipart/form-data" action="{{ route('admin.price.upload') }}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $price_list->id }}">
                                                        <label> upload new Price List</label>
                                                        <input class="form-control" type="file" name="file">
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">upload</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade text-start" id="default{{ $price_list->id }}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel1">{{ $price_list->status!=1?"Accept":'Disable' }} Confirmation</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post" action="{{ route('admin.price.accept') }}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $price_list->id }}">
                                                        <div class="modal-body">
                                                            {{ $price_list->status!=1?"Are you Sure Accept this Price List":'Are you Sure Disable this Price List' }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ $price_list->status!=1?"Accept":'Disable' }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>

                            @endif
                            @if($type == 'manpower')
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Manpower Name</th>
                                        <th>Manpower Code</th>
                                        <th>Price List Code</th>
                                        <th>Price</th>
                                        <th>rate</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($price_lists as $price_list)
                                        <tr>
                                            <td>
                                                <span class="fw-bold">{{ $price_list->seller->name }}</span>
                                            </td>
                                            <td>CS{{ $price_list->seller->id }}</td>
                                            <td>{{ $price_list->code }}</td>
                                            <td>{{ $price_list->price }} L.E / {{ $price_list->price_rate }}</td>
                                           <td>{{ $price_list->rate }}</td>
                                            <td>
                                                @if($price_list->status == 1)
                                                    <span class="badge bg-light-success">Active</span>
                                                @elseif($price_list->status == 0)
                                                    <span class="badge bg-light-warning">padding</span>
                                                @elseif($price_list->status == 2)
                                                    <span class="badge bg-light-primary">Selected</span>
                                                @elseif($price_list->status == 10)
                                                    <span class="badge bg-light-primary">started</span>
                                                @elseif($price_list->status == 20)
                                                    <span class="badge bg-light-primary">compete</span>
                                                @else
                                                    <span class="badge bg-light-danger">Block</span>

                                                @endif
                                            </td>

                                            <td>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#accept{{ $price_list->id }}">
                                                    <i data-feather="arrow-up" class="me-50"></i>
                                                    <span>{{ $price_list->status!=1?"Accept":'Disable' }}</span>
                                                </a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#upload{{ $price_list->id }}">
                                                    <i data-feather="arrow-up" class="me-50"></i>
                                                    <span>Attendeense</span>
                                                </a>

                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($price_lists as $price_list)
        <div class="modal fade text-start" id="accept{{ $price_list->id }}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">{{ $price_list->status!=1?"Accept":'Disable' }} Confirmation</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('admin.price.accept') }}">
                        @csrf
                        <div class="modal-body">
                           <input type="hidden" name="id" value="{{ $price_list->id }}">
                            {{ $price_list->status!=1?"Sure! You Want To Accept ?":'Sure! You Want To Disable?' }}
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ $price_list->status!=1?"Accept":'Disable' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade text-start" id="upload{{ $price_list->id }}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">{{ $price_list->status!=1?"Accept":'Disable' }} Confirmation</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Day</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($price_list->attendeense as $attendeense)
                                <tr>
                                    <td>{{ $attendeense->date }}</td>
                                    <td>{{ $attendeense->status == 1?"Attend":"Absent" }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ $price_list->status!=1?"Accept":'Disable' }}</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
