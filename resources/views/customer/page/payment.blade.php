@extends('customer.layout.master')
@section('style')

@endsection
@section('script')

@endsection
@section('popup')

@endsection
@section('content')
    <main class="main main-test">
        <div class="container checkout-container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li>
                    <a href="cart.html">Shopping Cart</a>
                </li>
                <li class="active">
                    <a href="checkout.html">Checkout</a>
                </li>
                <li class="disabled">
                    <a href="#">Order Complete</a>
                </li>
            </ul>


            <div class="row">
                <div class="col-lg-7">
                    <ul class="checkout-steps">
                        <li>
                            <h2 class="step-title">Billing details</h2>

                            <form action="#" id="checkout-form">
                                <label>Payment methods</label>
                                <select class="form-control form-select" name="payment-type">
                                    <option value="Cash">Cash</option>
                                    <option value="paymob">online</option>
                                </select>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Pay By Credit Card
                                </button>
                                <div class="modal align-items-center" id="exampleModal" tabindex="-1" role="dialog">

                                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <iframe class="align-self-center" width="80%" height="600px" src="https://accept.paymob.com/api/acceptance/iframes/330970?payment_token={{$token}}"></iframe>
                                </div>

                                <div class="form-group">
                                    <label class="order-comments">Order notes (optional)</label>
                                    <textarea class="form-control" placeholder="Notes about your order, e.g. special notes for delivery." required></textarea>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- End .col-lg-8 -->

                <div class="col-lg-5">
                    <div class="order-summary">
                        <h3>YOUR ORDER</h3>

                        <table class="table table-mini-cart">
                            <thead>
                            <tr>
                                <th colspan="2">Product</th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach($products as $product)
                                <tr>

                                    <td class="product-col">
                                        <h3 class="product-title">
                                            {{ $product->title }} ×
                                            <span class="product-qty">
                                                @foreach($nums as $num)
                                                    @if($product->id == $num[1])
                                                        {{ $num[0] }}
                                                    @endif
                                                @endforeach
                                            </span>
                                        </h3>
                                    </td>

                                    <td class="price-col">
                                        <span>@foreach($nums as $num)
                                                @if($product->id == $num[1])
                                                    ${{ $num[0]*$product->price }}
                                                @endif
                                            @endforeach</span>
                                    </td>
                                </tr>
                           @endforeach


                            </tbody>
                            <tfoot>
                            <tr class="cart-subtotal">
                                <td>
                                    <h4>Subtotal</h4>
                                </td>

                                <td class="price-col">
                                    <span>${{ $order->price }}</span>
                                </td>
                            </tr>


                            <tr class="order-total">
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span>${{ $order->price }}</span></b>
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                        <button type="submit" class="btn btn-dark btn-place-order" form="checkout-form">
                            Place order
                        </button>
                    </div>
                    <!-- End .cart-summary -->
                </div>
                <!-- End .col-lg-4 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>
    <!-- End .main -->
@endsection
