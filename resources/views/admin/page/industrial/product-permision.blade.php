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
                            <h4 class="card-title">Products Permission</h4>
                            <div class="col-4">
                                <input class="form-control search" id="search" type="text" placeholder="Search..." >
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>Product</th>
                                    <th>SubCategory</th>
                                    <th>Old Price</th>
                                    <th>Price</th>
                                    <th>changed Price</th>
                                    <th>changed date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ $product->seller->name }}</span>
                                        </td>
                                        <td>{{ $product->allProduct->name }}</td>
                                        <td>{{ $product->allProduct->subcat->title }}</td>
                                        <td>{{ $product->old_price == null?"null":$product->old_price }}</td>
                                        <td>{{ $product->price }} LE</td>
                                        <td>
                                            @if($product->price - $product->old_price > 0)
                                                <svg viewBox="0 0 24 24" width="30" height="30" color="green" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                                    <polyline points="17 6 23 6 23 12"></polyline>
                                                </svg>
                                                {{  $product->price - $product->old_price }}
                                            @else
                                                <svg viewBox="0 0 24 24" width="32" height="32" stroke="red" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline><polyline points="17 18 23 18 23 12"></polyline></svg>
                                                {{  $product->old_price - $product->price }}
                                           @endif
                                        </td>
                                        <td>
                                            {{ date('M d Y',strtotime($product->updated_at)) }}
                                        </td>
                                        <td>
                                            @if($product->status == 1)
                                            <span class="badge bg-light-success">Active</span>
                                            @elseif($product->status == 0)
                                                <span class="badge bg-light-warning">padding</span>
                                            @else
                                                <span class="badge bg-light-danger">Block</span>

                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.industrial.permission.product.details',$product->id) }}">
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
