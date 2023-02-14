@extends('customer.layout.master')
@section('style')

@endsection
@section('script')

@endsection
@section('popup')

@endsection
@section('content')
    <main class="main">
        <section class="new-products-section">
            <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate" data-animation-delay="100" data-animation-name="fadeInUpShorter">
                <button type="button" class="btn btn-primary">
                    Your Orders
                </button>
            </h2>
        </section>

        <section class="container">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Progress</th>
                    <th scope="col">price</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row"></th>
                        <td>CM101</td>
                        <td>8/12/2022</td>
                        <td>IN Review</td>
                        <td>
                            <div class="action">
                                <button onclick="window.location.href='orders-details.html'" type="button" class="btn btn-secondary">Show</button>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </section>
    </main>
    <!-- End .main -->
@endsection
