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
                            <h4 class="card-title">Order Complete</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Order Code</th>
                                    <th>Company</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Paid</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">#{{ $order->id }}</span>
                                        </td>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>${{ $order->price }}</td>
                                        <th>
                                            <span class="badge bg-light-success">Complete</span>

                                        </th>
                                        <td><span class="badge rounded-pill badge-light-primary me-1">{{ $order->payment_type == null?"Not PAY": $order->payment_type }}</span></td>
                                        <td><span class="badge rounded-pill badge-light-primary me-1"></span>{{ $order->payment_type == null?"NO":'YES' }}</td>
                                        <td>
                                            <a href="{{ route('admin.complete.chemical.details',$order->id) }}">
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
