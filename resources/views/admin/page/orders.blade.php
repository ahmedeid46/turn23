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
                                    <th>Order Id</th>
                                    <th>Product</th>
                                    <th>count</th>
                                    <th>Prices count</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>Order-{{ $order->id }} </td>
                                        <td>{{ $order->adminProduct->allProduct->name }}</td>
                                        <td>{{ $order->count }}</td>
                                        <td>{{ count($order->OrderPrices) }}</td>
                                        <td>{{ date('M d Y',strtotime($order->created_at)) }}</td>
                                        <td>
                                            <a href="{{ route('admin.show.orders.admin.product',$order->id) }}" class="btn btn-success">Show prices</a>
                                            <a class="btn btn-danger">Delete Order</a>
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

{{--    <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered modal-lg">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h4 class="modal-title" id="myModalLabel17">Add Product</h4>--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <form method="post" action="{{ route('admin.create.admin.product') }}" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="product-name">Product<span class="required">*</span></label>--}}
{{--                                    <select class="form-control" name="product_id">--}}
{{--                                        <option selected>Select Product</option>--}}
{{--                                        @foreach($allProductsForSelect as $selectProduct )--}}
{{--                                            <option value="{{ $selectProduct->id }}">{{ $selectProduct->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="product-name">Product Price By Dollar (usd) $ <span class="required">*</span></label>--}}
{{--                                    <input type="number" class="form-control" name="price" placeholder="Product price by $" min="0.00" step="0.01" required />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection
