@extends('admin.layout.master')
@section('style')

@endsection
@section('script')

@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <section class="app-ecommerce-details">
                    <div class="card">
                        <!-- Product Details starts -->
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="{{ route('product.files',[encrypt('cover'),encrypt($product->cover)]) }}" class="img-fluid product-img" alt="product image"/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-7">
                                    <h4>{{$product->allProduct->name}}</h4>
                                    <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                                        <h4 class="item-price me-1">EGY {{ $product->price }}</h4>
                                    </div>
                                    <p class="card-text">
                                        {!! $product->description !!}
                                    </p>
                                </div>


                            </div>
                        </div>
                        <!-- Product Details ends -->
                    </div>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th> Name</th>
                                    <th>Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>Packing Type</th>
                                    <td>{{ $product->packing_type }}</td>
                                </tr>
                                <tr>
                                    <th>Packing Wight</th>
                                    <td>{{ $product->packing_wieght }}</td>
                                </tr>
                                <tr>
                                    <th>Origin</th>
                                    <td>{{ $product->origin }}</td>
                                </tr>
                                <tr>
                                    <th>Producer</th>
                                    <td>{{ $product->producer }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

@endsection
