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
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body"><section class="invoice-preview-wrapper">
                    <div class="row invoice-preview">
                        <!-- Invoice -->
                        <div class="col-xl-12 col-md-12 col-12">
                            <div class="card invoice-preview-card">
                                <div class="card-body invoice-padding pb-0">
                                    <!-- Header starts -->
                                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div>
                                            <div class="logo-wrapper">
                                                <h3 class="text-primary invoice-logo">Order #{{ $order->id }}</h3>
                                            </div>
                                            </div>
                                        <div class="mt-md-0 mt-2">
                                            <div class="invoice-date-wrapper">
                                                <p class="invoice-date-title">Date :</p>
                                                <p class="invoice-date"{{ $order->created_at }} </p>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Header ends -->
                                </div>

                                <hr class="invoice-spacing" />

                                <!-- Address and Contact starts -->
                                <div class="card-body invoice-padding pt-0">
                                    <div class="row invoice-spacing">
                                        <div class="col-xl-8 p-0">
                                            <h6 class="mb-2">Customer Data:</h6>
                                            <h6 class="mb-25">{{ $order->customer->name }}</h6>
                                            <p class="card-text mb-25">{{ $order->country }},{{ $order->city }}</p>
                                            <p class="card-text mb-25">{{ $order->address }}</p>
                                            <p class="card-text mb-25">{{ $order->customer->phone }}</p>
                                            <p class="card-text mb-0">{{ $order->customer->email }}</p>
                                        </div>
                                        <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                            <h6 class="mb-2">Order Details:</h6>
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td class="pe-1">Total Due:</td>
                                                    <td><span class="fw-bold">${{ $order->price }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-1">Payment Type:</td>
                                                    <td>{{ $order->payment_type != null?$order->payment_type:"Not Paid" }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-1">Country:</td>
                                                    <td>{{ $order->country }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Address and Contact ends -->
                                    <!-- Invoice Description starts -->
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="py-1">Product description</th>
                                                <th>count</th>
                                                <th class="py-1">Total</th>
                                                <th>mods</th>
                                                <th>tds</th>
                                                <th>coa</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="py-1">
                                                        <a href="{{ route('admin.product.show',$order->product->id) }}"><p class="card-text fw-bold mb-25">{{ $order->product->allProduct->name }}</p></a>
{{--                                                        <p class="card-text text-nowrap">--}}
{{--                                                            {{ $order->product->description }}--}}
{{--                                                        </p>--}}
                                                    </td>
                                                    <td class="py-1">
                                                        <span class="fw-bold">{{ $order->count }}</span>
                                                    </td>
                                                    <td class="py-1">
                                                        <span class="fw-bold">
                                                            @if($order->price == null)
                                                            <input style="width: 85px;" type="text" name ="price">
                                                            @else
                                                               {{ $order->price }}
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class="py-1">
                                                        <span class="fw-bold">
                                                            @if($order->mods == null)
                                                                <input style="width: 85px;" type="file" name ="mods">
                                                            @else
                                                                <a class="btn btn-primary" href="{{ route('order.file',[encrypt('mods'),encrypt($order->mods)]) }}">Download</a>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class="py-1">
                                                        <span class="fw-bold">
                                                            @if($order->tds == null)
                                                                <input style="width: 85px;" type="file" name ="tds">
                                                            @else

                                                                        <a class="btn btn-primary" href="{{ route('order.file',[encrypt('tds'),encrypt($order->tds)]) }}">Download</a>
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class="py-1">
                                                        <span class="fw-bold">
                                                            @if($order->coa == null)
                                                                <input style="width: 85px;" type="file" name ="coa">
                                                            @else

                                                            <a class="btn btn-primary" href="{{ route('order.file',[encrypt('coa'),encrypt($order->coa)]) }}">Download</a>
                                                            @endif
                                                        </span>
                                                    </td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="card-body invoice-padding pb-0">
                                        <div class="row invoice-sales-total-wrapper">
                                            <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                                <p class="card-text mb-0">
                                                    <span class="fw-bold">Salesperson:</span> <span class="ms-75">Admin</span>
                                                </p>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                                <div class="invoice-total-wrapper">

                                                    <hr class="my-50" />
                                                    <div class="invoice-total-item">

                                                        <p class="invoice-total-title">Total:</p>
                                                        <p class="invoice-total-amount">{{ $order->price }} L.E</p>
                                                        <a class="btn btn-primary" href="">E-invoice</a>
                                                        <a class="btn btn-danger">Black</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Invoice Description ends -->

                                    <hr class="invoice-spacing" />
                                </form>

                                <!-- Invoice Note starts -->
                                <div class="card-body invoice-padding pt-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="fw-bold">Note:this is a note</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Invoice Note ends -->
                            </div>
                        </div>
                        <!-- /Invoice -->

                        <!-- Invoice Actions -->

                        <!-- /Invoice Actions -->
                    </div>
                </section>

{{--                <div class="modal fade text-start" id="send-invoice-sidebar" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">--}}
{{--                    <div class="modal-dialog">--}}
{{--                        <div class="modal-content">--}}
{{--                            <div class="modal-header">--}}
{{--                                <h4 class="modal-title" id="myModalLabel1">Accept Confirm</h4>--}}
{{--                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                            </div>--}}
{{--                            <form method="post" action="{{ route('admin.buy.accept') }}">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="id" value="{{ $order->id }}">--}}
{{--                                <div class="modal-body">--}}
{{--                                    <h3>Confirm accept this Order</h3>--}}
{{--                                    <p>note:when you accept, this order is appear in supplier and notify by notification and email</p>--}}
{{--                                </div>--}}
{{--                                <div class="modal-footer">--}}
{{--                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">accept</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                --}}{{--                <!-- Send Invoice Sidebar -->--}}
{{--                <div class="modal modal-slide-in fade" id="send-invoice-sidebar" aria-hidden="true">--}}
{{--                    <div class="modal-dialog sidebar-lg">--}}
{{--                        <div class="modal-content p-0">--}}
{{--                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>--}}
{{--                            <div class="modal-header mb-1">--}}
{{--                                <h5 class="modal-title">--}}
{{--                                    <span class="align-middle">Send Invoice</span>--}}
{{--                                </h5>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body flex-grow-1">--}}
{{--                                <form>--}}
{{--                                    <div class="mb-1">--}}
{{--                                        <label for="invoice-from" class="form-label">From</label>--}}
{{--                                        <input--}}
{{--                                            type="text"--}}
{{--                                            class="form-control"--}}
{{--                                            id="invoice-from"--}}
{{--                                            value="shelbyComapny@email.com"--}}
{{--                                            placeholder="company@email.com"--}}
{{--                                        />--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-1">--}}
{{--                                        <label for="invoice-to" class="form-label">To</label>--}}
{{--                                        <input--}}
{{--                                            type="text"--}}
{{--                                            class="form-control"--}}
{{--                                            id="invoice-to"--}}
{{--                                            value="qConsolidated@email.com"--}}
{{--                                            placeholder="company@email.com"--}}
{{--                                        />--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-1">--}}
{{--                                        <label for="invoice-subject" class="form-label">Subject</label>--}}
{{--                                        <input--}}
{{--                                            type="text"--}}
{{--                                            class="form-control"--}}
{{--                                            id="invoice-subject"--}}
{{--                                            value="Invoice of purchased Admin Panal"--}}
{{--                                            placeholder="Invoice regarding goods"--}}
{{--                                        />--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-1">--}}
{{--                                        <label for="invoice-message" class="form-label">Message</label>--}}
{{--                                        <textarea--}}
{{--                                            class="form-control"--}}
{{--                                            name="invoice-message"--}}
{{--                                            id="invoice-message"--}}
{{--                                            cols="3"--}}
{{--                                            rows="11"--}}
{{--                                            placeholder="Message...">--}}
{{--                                                Dear Queen Consolidated,--}}

{{--                                                Thank you for your business, always a pleasure to work with you!--}}

{{--                                                We have generated a new invoice in the amount of $95.59--}}

{{--                                                We would appreciate payment of this invoice by 05/11/2019--}}
{{--                                        </textarea>--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-1">--}}
{{--                                    <span class="badge badge-light-primary">--}}
{{--                                      <i data-feather="link" class="me-25"></i>--}}
{{--                                      <span class="align-middle">Invoice Attached</span>--}}
{{--                                    </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-1 d-flex flex-wrap mt-2">--}}
{{--                                        <button type="button" class="btn btn-primary me-1" data-bs-dismiss="modal">Send</button>--}}
{{--                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /Send Invoice Sidebar -->--}}
                <!--Message Modal -->
                <div class="modal fade text-start" id="default" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel1">Decline Message</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{ route('admin.buy.decline') }}">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="{{ $order->id }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="exampleFormControlTextarea1">Enter Decline Message</label>
                                                <textarea
                                                    name="message"
                                                    class="form-control"
                                                    id="exampleFormControlTextarea1"
                                                    rows="3"
                                                    placeholder="Message"
                                                ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
