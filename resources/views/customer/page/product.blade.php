@extends('customer.layout.master')
@section('style')

@endsection
@section('script')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script>
        $("#wishlist-add").click(function (){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            let encId = $("#wishlist-add").data('value');
            let url = '{{ route('customer.wishlist.add') }}';
            $.ajax({
                type:'POST',
                url: url,
                data:{encID : encId},
                success:function(data) {
                    alert(data.message);
                    if(data.status == 'delete'){
                        $("#wishlist-add").removeClass('added-wishlist');
                    }else if(data.status == 'successful'){
                        $("#wishlist-add").addClass('added-wishlist');
                    }
                }
            });
        })

        $("#cart-add").click(function (){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            let encId = $("#cart-add").data('value');
            let url = '{{ route('customer.chart.add.one') }}';
            $.ajax({
                type:'POST',
                url: url,
                data:{encID : encId},
                success:function(data) {
                    alert(data.message);
                }
            });
        })
    </script>
@endsection
@section('popup')

@endsection
@section('content')
    <main class="main">
        <div class="category-banner-container bg-gray">
            <div class="category-banner banner text-uppercase" style="background: no-repeat 60%/cover url('{{ asset('assets/customer') }}/images/banners/banner-top.jpg');">
                <div class="container position-relative">
                    <div class="row">
                        <div class="pl-lg-5 pb-5 pb-md-0 col-sm-5 col-xl-4 col-lg-4 offset-1">
                            <h3>{{ $subcat->title }}</h3>
{{--                            <a href="{{ route('customer.sub.categories',$subCatHashids->encode($subcat->subCatReverse->id)) }}" class="btn btn-dark">Get Yours!</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('customer.home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('customer.categories',$catHashids->encode(1)) }}">Chemical</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subcat->title }}</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-12 main-content">
                    <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                        <div class="toolbox-left">
                            <a href="#" class="sidebar-toggle">
                                <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                    <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                    <path
                                        d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                    <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                    <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                    <path
                                        d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                </svg>
                                <span>Filter</span>
                            </a>

                        </div>
                        <!-- End .toolbox-left -->

                    </nav>

                    <div class="row">
                        @foreach($allProducts as $allProduct)
                            @foreach($allProduct->adminproduct as $product)
                                <div class="col-6 col-sm-4">
                                    <div class="product-default">
                                        <figure>
                                            <a href="{{ route('customer.product.show',$ProductHashids->encode($product->id)) }}">
                                                <img src="{{ route('product.files',[encrypt('cover'),encrypt($product->cover)]) }}" width="280" height="280" alt="product" />
                                            </a>
                                        </figure>

                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="" class="product-category">{{ $subcat->title }}</a>
                                                </div>
                                            </div>

                                            <h3 class="product-title"> <a href="{{ route('customer.product.show',$ProductHashids->encode($product->id)) }}">{{ $product->allProduct->name }}</a> </h3>

                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:100%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->

                                            <div class="price-box">
                                                <span class="product-price">${{ $product->price }}</span>
                                            </div>
                                            <!-- End .price-box -->
    {{--                                        <form id="wishlist" method="post" action="{{ route('customer.wishlist.add') }}">--}}
    {{--                                            @csrf--}}
    {{--                                            <input hidden value="{{ $product->id }}" name="id">--}}
    {{--                                        </form>--}}
                                            <div class="product-action">
                                                @auth('customer')
                                                <a href="#" id="wishlist-add" data-value="{{ $ProductHashids->encode($product->id) }}"  class="@foreach($wishlists as $wishlist)
                                                @if($wishlist->product_id == $product->id){{ "added-wishlist" }}@endif @endforeach" title="wishlist"><i
                                                        class="icon-heart"></i></a>
                                                @endauth
                                                <a href="{{ route('customer.product.show',$ProductHashids->encode($product->id)) }}" class="btn-icon btn-add-cart"><i
                                                        class="fa fa-arrow-right"></i><span>SELECT
                                                            OPTIONS</span></a>
                                                <a href="#" title="Add To Cart" id="cart-add" data-value="{{ $ProductHashids->encode($product->id) }}" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                </div>
                                <!-- End .col-sm-4 -->
                            @endforeach
                        @endforeach

                    </div>
                    <!-- End .row -->

{{--                    <nav class="toolbox toolbox-pagination">--}}
{{--                        {!! $products->links() !!}--}}
{{--                    </nav>--}}
                </div>
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->

        <div class="mb-4"></div>
        <!-- margin -->
    </main>
    <!-- End .main -->
@endsection
