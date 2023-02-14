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
                                                <h3 class="text-primary invoice-logo">Order #{{ $tender->id }}</h3>
                                            </div>
                                            </div>
                                        <div class="mt-md-0 mt-2">
                                            <div class="invoice-date-wrapper">
                                                <form method="post" action="">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{ $tender->id }}">
                                                    <div class="form-inline">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <select class="form-select" name="invoice">
                                                                    <option @if($tender->status == 0) selected @endif value="0">Pending</option>
                                                                    <option @if($tender->status == 1) selected @endif value="1">Proceed order</option>
                                                                    <option @if($tender->status == 2) selected @endif value="2">Under Quotation</option>
                                                                    <option @if($tender->status == 3) selected @endif value="3">PO</option>
                                                                    <option @if($tender->status == 4) selected @endif value="4">Under Delivery</option>
                                                                    <option @if($tender->status == 5) selected @endif value="5">Invoicing</option>
                                                                    <option @if($tender->status == 6) selected @endif value="6">Complete</option>
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
                                            <h6 class="mb-25">{{ $tender->customer->name }}</h6>
                                            <p class="card-text mb-25">{{ $tender->customer->phone }}</p>
                                            <p class="card-text mb-0">{{ $tender->customer->email }}</p>
                                            <br>
                                            <h3>Tender File</h3>
                                            <a href="{{ route('order.file',[encrypt('tender'),encrypt($tender->tender_file)]) }}" class="btn btn-primary">Download Customer File</a>
                                            @if ($tender->admin_tender_file == null)
                                                <form method="post" enctype="multipart/form-data" action="{{ route('admin.tender.chemical.accept') }}">
                                                    @csrf
                                                    <input type="hidden" name="tender_id" value="{{ $tender->id }}">
                                                    <input type="file" name="file">
                                                    <button type="submit" class="btn btn-primary">Accept</button>
                                                </form>
                                            @else
                                                <a href="{{ route('order.file',[encrypt('tender'),encrypt($tender->admin_tender_file)]) }}" class="btn btn-primary">Download Admin File</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Address and Contact ends -->

                            </div>
                        </div>
                        <!-- /Invoice -->

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
                                            <th>price from Supplier</th>
                                            <th>price from admin</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($prices as $price)
                                            <tr>
                                                <td>
                                                    <span class="fw-bold"><a>{{ $price->seller->name }}</a></span>
                                                </td>
                                                <td>
                                                    <span class="fw-bold"><a>{{ $price->seller->phone }}</a></span>
                                                </td>
                                                <td class="py-1">
                                                        <span class="fw-bold">
                                                            @if($price->file != null)
                                                                <a class="btn btn-primary" href="{{ route('order.file',[encrypt('tenderPrice'),encrypt($price->file)]) }}">Download</a>
                                                            @endif
                                                        </span>
                                                </td>
                                                <td class="py-1">
                                                    @if ($price->admin_file == null)
                                                        <form method="post" enctype="multipart/form-data" action="{{ route('admin.tender.chemical.price.accept') }}">
                                                            @csrf
                                                            <input type="hidden" name="tender_id" value="{{ $price->id }}">
                                                            <input type="file" name="file">
                                                            <button type="submit" class="btn btn-primary">Accept</button>
                                                        </form>
                                                    @else
                                                        <a href="{{ route('order.file',[encrypt('tenderPrice'),encrypt($price->admin_file)]) }}" class="btn btn-primary">Download</a>
                                                    @endif
                                                </td>
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
