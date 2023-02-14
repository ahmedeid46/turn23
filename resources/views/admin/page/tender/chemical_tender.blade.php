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
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Chemical Tenders</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Order Code</th>
                                    <th>Company</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tenders as $tender)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">#{{ $tender->id }}</span>
                                        </td>
                                        <td>{{ $tender->customer->name }}</td>
                                        <th>
                                            @if($tender->status == 1)
                                            <span class="badge bg-light-success">Active</span>
                                            @elseif($tender->status == 0)
                                                <span class="badge bg-light-warning">padding</span>
                                            @else
                                                <span class="badge bg-light-danger">Block</span>

                                            @endif
                                        </th>
                                         <td>
                                            <a href="{{ route('admin.tender.chemical.details',$tender->id) }}">
                                                <i data-feather="eye" class="me-50"></i>
                                                <span>Show</span>
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
