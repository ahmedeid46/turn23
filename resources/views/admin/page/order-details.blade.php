@extends('admin.layout.master')
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
                            <h4 class="card-title">Order Details</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>price</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($prices as $price)
                                    <tr>
                                        <td>
                                            <span class="fw-bold"><a>{{ $price->seller->name }}</a></span>
                                        </td>
                                        <td>{{ $price->price }}</td>
                                        <td><span class="badge rounded-pill badge-light-primary me-1s">{{ date('M d Y',strtotime($price->created_at)) }}</span></td>
                                        <td>
                                            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#large">
                                                <i data-feather="eye" class="me-50"></i>
                                                <span>Accept price</span>
                                            </a>

                                            <a class="btn btn-danger">
                                                <i data-feather="eye" class="me-50"></i>
                                                <span>Decline Price</span>
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
