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
                            <h4 class="card-title">Register Permission</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Order Code</th>
                                    <th>Company</th>
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
                                        <th>
                                            @if($order->status == 1)
                                                <span class="badge bg-light-success">Proceed order</span>
                                            @elseif($order->status == 0)
                                                <span class="badge bg-light-warning">Pending</span>
                                            @elseif($order->status == 2)
                                                <span class="badge bg-light-success">Under Quotation</span>
                                            @elseif($order->status == 3)
                                                <span class="badge bg-light-success">PO</span>
                                            @elseif($order->status == 4)
                                                <span class="badge bg-light-success">Under Delivery</span>
                                            @elseif($order->status == 5)
                                                <span class="badge bg-light-success">Invoicing</span>

                                            @endif
                                        </th>
                                        </th>
                                        <td><span class="badge rounded-pill badge-light-primary me-1">{{ $order->payment_method == null?"Not PAY": $order->payment_method }}</span></td>
                                        <td><span class="badge rounded-pill badge-light-primary me-1"></span>{{ $order->payment_type == null?"NO":'YES' }}</td>
                                        <td>
                                            <a href="{{ route('admin.industrial.permission.buy.details',$order->id) }}">
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
