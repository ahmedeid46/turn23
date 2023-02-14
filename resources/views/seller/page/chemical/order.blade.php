<div class="tab-pane fade" id="order" role="tabpanel">
    <div class="order-content">
        <h3 class="account-sub-title d-none d-md-block"><i class="sicon-social-dropbox align-middle mr-3"></i>Orders</h3>
        <div class="order-table-container text-center">
            <table class="table table-order text-left">
                <thead>
                <tr>
                    <th class="order-id">ORDER</th>
                    <th>Product Name</th>
                    <th>Count</th>
                    <th class="order-date">DATE</th>
                    <th class="order-price">TOTAL</th>
                    <th>Add price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->adminproduct->allproduct->name }}</td>
                            <td>{{ $order->count }}</td>
                            <td>{{ date('M j,Y',strtotime($order->created_at)) }}</td>
                            <td>EGY {{ $order->price }}</td>
                            <td>
                                <form method="post" action="{{ route('seller.order.price.add') }}">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input  type="number" min="0" step="0.01" name="price">
                                    <button class="btn btn-success" type="submit">Add price</button>
                                </form>
                            </td>
                            <td><a class="btn btn-success" href="{{ route('customer.product.show',$ProductHashids->encode($order->adminproduct->id)) }}">show details</a></td>
                        </tr>
                @endforeach
                </tbody>
            </table>
            <hr class="mt-0 mb-3 pb-2" />
        </div>
    </div>
</div><!-- End .tab-pane -->
