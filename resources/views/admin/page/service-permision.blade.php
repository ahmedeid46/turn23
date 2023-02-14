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
                            <h4 class="card-title">Service Permission</h4>
                        </div>
                        <div class="col-12">
                            <input class="form-control " id="search" type="text" placeholder="Search..." >
                        </div>
                        <div class="table-responsive">
                            <table id="table" class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Service Code</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($services as $service)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ $service->customer->name }}</span>
                                        </td>
                                        <td>{{ $service->code }}</td>
                                        <td>{{ $service->subCat->title }}</td>
                                        <td>
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
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.permission.service.details',[$type,$service->id]) }}">
                                                <i data-feather="eye" class="me-50"></i>
                                                <span>Show</span>
                                            </a>
                                            <a href="{{ route('admin.permission.service.price',[$type,$service->id]) }}">
                                                <i data-feather="dollar-sign" class="me-50"></i>
                                                <span>Price List</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
