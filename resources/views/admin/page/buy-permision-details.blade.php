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
                                                <form method="post" action="">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                    <div class="form-inline">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <select class="form-select" name="invoice">
                                                                    <option @if($order->status == 0) selected @endif value="0">Pending</option>
                                                                    <option @if($order->status == 1) selected @endif value="1">Proceed order</option>
                                                                    <option @if($order->status == 2) selected @endif value="2">Under Quotation</option>
                                                                    <option @if($order->status == 3) selected @endif value="3">PO</option>
                                                                    <option @if($order->status == 4) selected @endif value="4">Under Delivery</option>
                                                                    <option @if($order->status == 5) selected @endif value="5">Invoicing</option>
                                                                    <option @if($order->status == 6) selected @endif value="6">Complete</option>
                                                                </select>
                                                                <button type="submit" class="btn btn-success"><i data-feather="check"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
                                            <h6 class="mb-25">name: {{ $order->customer->name }}</h6>
                                            <p class="card-text mb-25">phone: {{ $order->customer->phone }}</p>
                                            <p class="card-text mb-0">email: <a href="mailto:{{ $order->customer->email }}">{{ $order->customer->email }}</a></p>
                                        </div>
                                        <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                            <h6 class="mb-2">Order Details:</h6>
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td class="pe-1">Payment Method:</td>
                                                    <td>{{ $order->payment_method != null?$order->payment_method:"Not Paid" }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-1">Credit Plan:</td>
                                                    <td>{{ $order->payment_day }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Expected Delivery: </td>
                                                    <td>{{ date('D Y, d M',strtotime($order->ex_delevery)) }}</td>

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
                                                <th class="py-1">Product</th>
                                                <th>count</th>
                                                <th>approved suppliers</th>
                                                <th>sample</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="py-1">
                                                        <a href="{{ route('admin.product.show',$order->product->id) }}"><p class="card-text fw-bold mb-25">{{ $order->product->name }}</p></a>
                                                    </td>
                                                    <td class="py-1">
                                                        <span class="fw-bold">{{ $order->count }}</span>
                                                    </td>
                                                    <td>{{ $order->approved_supplier }}</td>
                                                    <td class="py-1">
                                                    <span class="fw-bold">
                                                        {{ $order->sample_required == 1  ? 'Required' :'Not Required' }}
                                                    </span>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>coa</th>
                                                <th>TDS</th>
                                                <th>Mods</th>
                                                <th>OC</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="py-1">
                                                   {{ $order->coa_required == 1  ? 'Required' :'Not Required' }}
                                                </td>
                                                <td class="py-1">
                                                    {{ $order->tds_required == 1  ? 'Required' :'Not Required' }}
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold">
                                                   {{ $order->msd_required == 1  ? 'Required' :'Not Required' }}
                                                    </span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold">
                                                   {{ $order->oc_required == 1  ? 'Required' :'Not Required' }}
                                                    </span>
                                                </td>

                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="card-body invoice-padding pb-0">
                                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                            <p class="card-text mb-0">
                                            </p>
                                        </div>
                                        <div style="float: right;" class="row invoice-sales-total-wrapper">
                                            <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                                <div class="invoice-total-wrapper">
                                                    <hr class="my-50" />
                                                    <div class="invoice-total-item">
                                                        @if($order->status == 0)
                                                            <form method="post" action="{{ route('admin.order.submit.admin.product') }}">
                                                                @csrf
                                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                                <input type="hidden" name="product_id" value="{{ $order->product_id }}">
                                                                <input type="hidden" name="count" value="{{ $order->count }}">
                                                                <input type="hidden" name="coa_required" value="{{ $order->coa_required}}">
                                                                <input type="hidden" name="tds_required" value="{{ $order->tds_required}}">
                                                                <input type="hidden" name="msd_required" value="{{ $order->msd_required}}">
                                                                <input type="hidden" name="oc_required" value="{{ $order->oc_required}}">
                                                                <input type="hidden" name="sample_required" value="{{ $order->sample_required}}">
                                                                <input type="hidden" name="approved_supplier" value="{{ $order->approved_supplier}}">
                                                                <button type="submit" class="btn btn-primary">EFQ</button>
                                                            </form>
                                                        @elseif($order->status == 1)
                                                        <form method="post" action="{{ route('admin.permission.buy.add.price') }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="order_id" value="{{$order->id}}">
                                                            <p class="invoice-total-title">Upload Quotation:</p>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="price" id="customFile">
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                            <button type="submit" class="btn btn-success">Send Quotation</button>
                                                        </form>
                                                        @elseif($order->status == 2)
                                                            <button type="submit" class="btn btn-success">Request PO</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Invoice Description ends -->

                                    <hr class="invoice-spacing" />

                            </div>
                        </div>
                        <!-- /Invoice -->

{{--                        <!-- Invoice Actions -->--}}
                        <div class="col-xl-12 col-md-6 col-12 invoice-actions mt-md-0 mt-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Details</h4>
                                    <div class="mt-md-0 mt-2">
                                        <div class="invoice-date-wrapper">
                                            <button type="button" class="btn btn-primary" onclick="window.location.reload();">Refresh Prices</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Company</th>
                                            <th>Phone</th>
                                            <th>price per unit</th>
                                            <th>Docs</th>
                                            <th>vat</th>
                                            <th>sample request</th>
                                            <th>store location</th>
                                            <th>Date</th>
                                            <th>Actions</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sellerproducts as $product)
                                            <tr>
                                                <td>
                                                    <span class="fw-bold"><a>{{ $product->seller->name }}</a></span>
                                                </td>
                                                <td>
                                                    <span class="fw-bold"><a>{{ $product->seller->phone }}</a></span>
                                                </td>
                                                <td>{{ $product->price }}</td>

                                                @if($orderadmin != null)
                                                    @foreach($prices as $price)
                                                        @if($price->seller->id == $product->seller->id)
                                                            <td>
                                                                @if($price->price != null || $price->msds != null || $price->oc != null || $price->coa != null ||$price->tds != null)
                                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Docs_supplier_{{ $price->id }}">
                                                                        Show
                                                                    </button>
                                                                    <div class="modal fade text-start" style="display: none;" id="Docs_supplier_{{ $price->id }}" tabindex="-1" aria-labelledby="myModalLabel1" style="display: block;" aria-modal="true" role="dialog">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title" id="myModalLabel1">Basic Modal</h4>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-12">
                                                                                            <div class="py-1">
                                                                            <span class="fw-bold">
                                                                                @if($price->price != null)
                                                                                    <a class="btn btn-primary" href="{{ route('order.file',[encrypt('price'),encrypt($price->price)]) }}">Download MSDS</a>
                                                                                @endif
                                                                            </span>
                                                                                            </div>
                                                                                            <div class="py-1">
                                                                            <span class="fw-bold">
                                                                                @if($price->msd != null)
                                                                                    <a class="btn btn-primary" href="{{ route('order.file',[encrypt('msds'),encrypt($price->msd)]) }}">Download MSDS</a>
                                                                                @endif
                                                                            </span>
                                                                                            </div>
                                                                                            <div class="py-1">
                                                                            <span class="fw-bold">
                                                                                @if($price->tds != null)
                                                                                    <a class="btn btn-primary" href="{{ route('order.file',[encrypt('tds'),encrypt($price->tds)]) }}">Download TDS</a>
                                                                                @endif
                                                                            </span>
                                                                                            </div>
                                                                                            <div class="py-1">
                                                                            <span class="fw-bold">
                                                                                @if($price->coa != null)
                                                                                    <a class="btn btn-primary" href="{{ route('order.file',[encrypt('coa'),encrypt($price->coa)]) }}">Download COA</a>
                                                                                @endif
                                                                            </span>
                                                                                            </div>
                                                                                            <div class="py-1">
                                                                            <span class="fw-bold">
                                                                                @if($price->oc != null)
                                                                                    <a class="btn btn-primary" href="{{ route('order.file',[encrypt('oc'),encrypt($price->coa)]) }}">Download COA</a>
                                                                                @endif
                                                                            </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-bs-dismiss="modal">Accept</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <button type="button" disabled class="btn btn-info">
                                                                        Not Available
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td><span class="badge rounded-pill badge-light-primary me-1s">{{ date('M d Y',strtotime($price->created_at)) }}</span></td>
                                                            @break
                                                        @else
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                        @endif


                                                    @endforeach

                                                @else
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    @break
                                                @endif
                                                <td>
                                                    <a href="" >PO</a>
                                                </td>

                                            </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </section>


            </div>
        </div>
    </div>
@endsection
