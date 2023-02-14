@extends('customer.layout.master')
@section('style')

@endsection
@section('script')
@endsection
@section('popup')

@endsection
@section('content')

    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('customer.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Wishlist
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>Wishlist</h1>
            </div>
        </div>

        <div class="container">
            <div class="wishlist-title">
                <h2 class="p-2">My wishlist</h2>
            </div>
            <div class="wishlist-table-container">
                <table class="table table-wishlist mb-0">
                    <thead>
                    <tr>
                        <th class="thumbnail-col"></th>
                        <th class="product-col">Product</th>
                        <th class="price-col">Price</th>
                        <th class="status-col">Stock Status</th>
                        <th class="action-col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @auth('customer')
                        @foreach($wishlists as $wishlist)
                            <tr class="product-row">
    {{--                             <form action="{{ route('') }}">--}}
    {{--                                 @csrf--}}
    {{--                                 <input type="hidden" value="{{ $wishlist->product->id }}" name="product_id">--}}
    {{--                             </form>--}}
                                <td>
                                    <figure class="product-image-container">
                                        <a href="{{ route('customer.product.show',$ProductHashids->encode($wishlist->product->id)) }}" class="product-image">
                                            <img src="{{ route('product.files',[encrypt('cover'),encrypt($wishlist->product->cover)]) }}" alt="product">
                                        </a>

                                        <button  id="wishlist-cancel" data-value="{{ $ProductHashids->encode($wishlist->product->id) }}" style="border: none" class="btn-remove icon-cancel" title="Remove Product"></button>
                                    </figure>
                                </td>
                                <td>
                                    <h5 class="product-title">
                                        <a href="{{ route('customer.product.show',$ProductHashids->encode($wishlist->product->id)) }}">{{ $wishlist->product->title }}</a>
                                    </h5>
                                </td>
                                <td class="price-box">${{ $wishlist->product->price }}</td>
                                <td>
                                    <span class="stock-status">In stock</span>
                                </td>
                                <td class="action">
                                    <a href="{{ route('customer.product.show',$ProductHashids->encode($wishlist->product->id)) }}" class="btn btn-quickview mt-1 mt-md-0"
                                       title="Quick View">Quick
                                        View</a>
                                    <button class="btn btn-dark btn-add-cart product-type-simple btn-shop">
                                        ADD TO CART
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endauth
                    </tbody>
                </table>
            </div><!-- End .cart-table-container -->
        </div><!-- End .container -->
    </main>
    <!-- End .main -->
@endsection
