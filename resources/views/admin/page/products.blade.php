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
            <div class="content-detached">
                <div class="content-body"><!-- E-commerce Content Section Starts -->

                    <!-- background Overlay when sidebar is shown  starts-->
                    <div class="body-content-overlay"></div>
                    <!-- background Overlay when sidebar is shown  ends-->

                    <!-- E-commerce Products Starts -->
                    <section id="ecommerce-products" class="grid-view">
                        @foreach($products as $product)
                            <div class="card ecommerce-card">
                            <div class="item-img text-center">
                                <a href="{{ route('admin.product.show',$product->id) }}">
                                    <img class="img-fluid card-img-top" src="{{ route('product.files',[encrypt('cover'),encrypt($product->cover)]) }}" alt="img-placeholder"/></a>
                            </div>
                            <div class="card-body">
                                <div class="item-wrapper">

                                    <div>
                                        <h6 class="item-price">${{ $product->price }}</h6>
                                    </div>
                                </div>
                                <h6 class="item-name">
                                    <a class="text-body" href="{{ route('admin.product.show',$product->id) }}"> {{ $product->allProduct->name  }}</a>
                                    <span class="card-text ">By <a href="{{ route('admin.users.seller.details',$product->seller->id) }}" class="company-name">{{ $product->seller->name }}</a></span>
                                </h6>
                                <p class="card-text item-description">
                                   {!! $product->description !!}
                                </p>
                            </div>
                            <div class="item-options text-center">
                                <div class="item-wrapper">
                                    <div class="item-cost">
                                        <h4 class="item-price">${{ $product->price }}</h4>
                                    </div>
                                </div>
                                <a style="width: 50%" href="{{ route('admin.product.show',$product->id) }}" class="btn btn-light">
                                    <i data-feather="eye"></i>
                                    <span>Show</span>
                                </a>
                                <a style="width: 50%" onclick="$('#productDelete{{$product->id}}').submit()" href="#" class="btn btn-primary ">
                                    <i data-feather="trash"></i>
                                    <span class="add-to-cart">Delete</span>
                                </a>
                                <form id="productDelete{{$product->id}}" method="post" action="{{ route('admin.product.delete') }}">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                </form>
                            </div>
                        </div>
                        @endforeach

                    </section>
                    <!-- E-commerce Products Ends -->

                    <!-- E-commerce Pagination Starts -->
                    <section id="ecommerce-pagination">
                        <div class="row">
                            <div class="col-sm-12 center-layout">
                                {!! $products->links() !!}
                            </div>
                        </div>
                    </section>
                    <!-- E-commerce Pagination Ends -->

                </div>
            </div>
        </div>
    </div>


@endsection
