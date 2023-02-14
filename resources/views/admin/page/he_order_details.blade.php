@extends('admin.layout.master')
@section('style')

@endsection
@section('script')
    <script src=
                    "https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity=
                    "sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous">
    </script>
    <script src=
                    "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity=
                    "sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous">
    </script>
    <script src=
                    "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity=
                    "sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous">
    </script>
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="invoice-preview-wrapper">
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
                                                                    <option @if($order->status == 0) selected
                                                                            @endif value="0">Pending
                                                                    </option>
                                                                    <option @if($order->status == 1) selected
                                                                            @endif value="1">Proceed order
                                                                    </option>
                                                                    <option @if($order->status == 2) selected
                                                                            @endif value="2">Under Quotation
                                                                    </option>
                                                                    <option @if($order->status == 3) selected
                                                                            @endif value="3">PO
                                                                    </option>
                                                                    <option @if($order->status == 4) selected
                                                                            @endif value="4">exececution
                                                                    </option>
                                                                    <option @if($order->status == 5) selected
                                                                            @endif value="5">Invoicing
                                                                    </option>
                                                                    <option @if($order->status == 6) selected
                                                                            @endif value="6">Complete
                                                                    </option>
                                                                </select>
                                                                <button type="submit" class="btn btn-success"><i
                                                                            data-feather="check"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Header ends -->
                                </div>

                                <hr class="invoice-spacing"/>

                                <!-- Address and Contact starts -->
                                <div class="card-body invoice-padding pt-0">
                                    <div class="row invoice-spacing">
                                        <div class="col-xl-8 p-0">
                                            <h6 class="mb-2">Customer Data:</h6>
                                            <h6 class="mb-25">{{ $order->customer->name }}</h6>
                                            <h6 class="mb-25">{{ $order->customer->phone }}</h6>
                                            <h6 class="mb-25"><a
                                                        href="mailto:{{ $order->customer->email }}">{{ $order->customer->email }}</a>
                                            </h6>
                                            <p class="card-text mb-25">Location : {{ $order->location }}</p>
                                        </div>
                                        <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                            <h6 class="mb-2">Site Photos:</h6>
                                            @foreach(json_decode($order->site_photos) as $site_photos)
                                                <button type="button" class="btn btn-primary"
                                                        data-toggle="modal" data-target="#viewimg{{ $site_photos }}">
                                                    view photo
                                                </button><br>
                                                <div class="modal fade" id="viewimg{{ $site_photos }}" tabindex="-1"
                                                     role="dialog" aria-labelledby="exampleModalLabel"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <!-- Modal heading -->
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Site Photo
                                                                </h5>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">
                                                                    ×
                                                                </span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body with image -->
                                                            <div class="modal-body">
                                                                <img src="{{ route('product.imgs',[encrypt('Equipment'),encrypt($site_photos)]) }}"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- Address and Contact ends -->
                                @if($order->type == 143)
                                    <form method="post" action="{{ route('admin.equipment.order.add.price') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                        <!-- Invoice Description starts -->
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="py-1">Equipment</th>
                                                    <th>Quantity</th>
                                                    <th> Type Duration</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Sizing</th>
                                                    <th>load weight</th>
                                                    <th>lifting height</th>
                                                    <th>lifting radius</th>
                                                    <th>copy of lifting plan</th>
                                                    <th class="py-1">Price</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($order->order_equipments as $order_equipment)
                                                    <tr>
                                                        <td class="py-1">
                                                            <a href=""><p
                                                                        class="card-text fw-bold mb-25">{{ $order_equipment->equipments->title }}</p>
                                                            </a>
                                                            {{--                                                        <p class="card-text text-nowrap">--}}
                                                            {{--                                                            {{ $order->product->description }}--}}
                                                            {{--                                                        </p>--}}
                                                        </td>
                                                        <td class="py-1">
                                                            <span class="fw-bold">{{ $order_equipment->number }}</span>
                                                        </td>
                                                        <td class="py-1">
                                                            <span class="fw-bold">{{ $order_equipment->ex_duration === 'job'? "Job":$order_equipment->ex_duration }}</span>
                                                        </td>
                                                        <td class="py-1">
                                                            <span class="fw-bold">{{ $order_equipment->ex_duration === 'job'?$order_equipment->capasty_load:"-" }}</span>
                                                        </td>
                                                        <td class="py-1">
                                                            <span class="fw-bold">{{ $order_equipment->ex_duration === 'job'?$order_equipment->lifting_hight:"-" }}</span>
                                                        </td>
                                                        <td class="py-1">
                                                            <span class="fw-bold">{{ $order_equipment->ex_duration === 'job'?$order_equipment->lifting_radius:"-" }}</span>
                                                        </td>
                                                        <td>
                                                            <a href="" class="btn btn-success">Download</a>
                                                        </td>
                                                        <td class="py-1">
                                                        <span class="fw-bold">
                                                            @if($order->status < 2)
                                                                <input style="width: 85px;" type="text"
                                                                       name="price[{{ $order_equipment->id }}]">
                                                            @else
                                                                {{ $order_equipment->price }}
                                                            @endif
                                                        </span>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="card-body invoice-padding pb-0">
                                            <div class="row invoice-sales-total-wrapper">
                                                <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                                    <div class="form-group">
                                                        <label>Docs</label>
                                                        <input type="file" multiple name="docs[]">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Photos</label>
                                                        <input type="file" multiple name="photos[]">
                                                    </div>
                                                    <p class="card-text mb-0">
                                                        <span class="fw-bold">Salesperson:</span> <span class="ms-75">Admin</span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                                    <div class="invoice-total-wrapper">

                                                        <hr class="my-50"/>
                                                        <div class="invoice-total-item">

                                                            <p class="invoice-total-title">Total:</p>
                                                            <p class="invoice-total-amount">{{ $order->price }} L.E</p>
                                                            <button type="submit" class="btn btn-success">Save Price
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Invoice Description ends -->

                                        <hr class="invoice-spacing"/>
                                    </form>
                                @else
                                    <form method="post" action="{{ route('admin.equipment.order.add.price') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$order->id}}">
                                        <!-- Invoice Description starts -->
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="py-1">Equipment</th>
                                                    <th>quantity</th>
                                                    <th>start</th>
                                                    <th>end</th>
                                                    <th>size</th>
                                                    <th class="py-1">Price</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($order->order_equipments as $order_equipment)
                                                    <tr>
                                                        <td class="py-1">
                                                            <a href=""><p
                                                                        class="card-text fw-bold mb-25">{{ $order_equipment->equipments->title }}</p>
                                                            </a>
                                                        </td>
                                                        <td class="py-1">
                                                            <span class="fw-bold">{{ $order_equipment->number }}</span>
                                                        </td>
                                                        <td class="py-1">
                                                            <span class="fw-bold">{{ $order_equipment->start_date }}</span>
                                                        </td>
                                                        <td class="py-1">
                                                            <span class="fw-bold">{{ $order_equipment->end_date }}</span>
                                                        </td>
                                                        <td class="py-1">
                                                            <span class="fw-bold">{{ $order_equipment->sizing }}</span>
                                                        </td>
                                                        <td class="py-1">
                                                        <span class="fw-bold">
                                                            @if($order->status < 2)
                                                                <input style="width: 85px;" type="text"
                                                                       name="price[{{ $order_equipment->id }}]">
                                                            @else
                                                                {{ $order_equipment->price }}
                                                            @endif
                                                        </span>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="card-body invoice-padding pb-0">
                                            <div class="row invoice-sales-total-wrapper">
                                                <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                                    <div class="form-group">
                                                        <label>Docs</label>
                                                        <input type="file" multiple name="docs">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Photos</label>
                                                        <input type="file" multiple name="photos">
                                                    </div>
                                                    <p class="card-text mb-0">
                                                        <span class="fw-bold">Salesperson:</span> <span class="ms-75">Admin</span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                                    <div class="invoice-total-wrapper">

                                                        <hr class="my-50"/>
                                                        <div class="invoice-total-item">

                                                            <p class="invoice-total-title">Total:</p>
                                                            <p class="invoice-total-amount">{{ $order->price }} L.E</p>
                                                            <button type="submit" class="btn btn-success">Save Price
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Invoice Description ends -->

                                        <hr class="invoice-spacing"/>
                                    </form>
                                @endif
                                {{--                                @elseif($order->status == 1)--}}
                                {{--                                    <form method="post" action="{{ route('admin.buy.complete') }}" enctype="multipart/form-data">--}}
                                {{--                                        @csrf--}}
                                {{--                                        <input type="hidden" name="order_id" value="{{$order->id}}">--}}
                                {{--                                        <!-- Invoice Description starts -->--}}
                                {{--                                        <div class="table-responsive">--}}
                                {{--                                            <table class="table">--}}
                                {{--                                                <thead>--}}
                                {{--                                                <tr>--}}
                                {{--                                                    <th class="py-1">Product description</th>--}}
                                {{--                                                    <th>count</th>--}}
                                {{--                                                    <th class="py-1">Total</th>--}}
                                {{--                                                    <th>mods</th>--}}
                                {{--                                                    <th>tds</th>--}}
                                {{--                                                    <th>coa</th>--}}
                                {{--                                                </tr>--}}
                                {{--                                                </thead>--}}
                                {{--                                                <tbody>--}}
                                {{--                                                <tr>--}}
                                {{--                                                    <td class="py-1">--}}
                                {{--                                                        <a href="{{ route('admin.product.show',$order->product->id) }}"><p class="card-text fw-bold mb-25">{{ $order->product->allProduct->name }}</p></a>--}}
                                {{--                                                        --}}{{--                                                        <p class="card-text text-nowrap">--}}
                                {{--                                                        --}}{{--                                                            {{ $order->product->description }}--}}
                                {{--                                                        --}}{{--                                                        </p>--}}
                                {{--                                                    </td>--}}
                                {{--                                                    <td class="py-1">--}}
                                {{--                                                        <span class="fw-bold">{{ $order->count }}</span>--}}
                                {{--                                                    </td>--}}
                                {{--                                                    <td class="py-1">--}}
                                {{--                                                        <span class="fw-bold">--}}
                                {{--                                                            @if($order->price == null)--}}
                                {{--                                                                <input style="width: 85px;" type="text" name ="price">--}}
                                {{--                                                            @else--}}
                                {{--                                                                {{ $order->price }}--}}
                                {{--                                                            @endif--}}
                                {{--                                                        </span>--}}
                                {{--                                                    </td>--}}
                                {{--                                                    <td class="py-1">--}}
                                {{--                                                        <span class="fw-bold">--}}
                                {{--                                                            @if($order->mods == null)--}}
                                {{--                                                                <input style="width: 85px;" type="file" name ="mods">--}}
                                {{--                                                            @else--}}
                                {{--                                                                <a class="btn btn-primary" href="{{ route('order.file',[encrypt('mods'),encrypt($order->mods)]) }}">Download</a>--}}
                                {{--                                                            @endif--}}
                                {{--                                                        </span>--}}
                                {{--                                                    </td>--}}
                                {{--                                                    <td class="py-1">--}}
                                {{--                                                        <span class="fw-bold">--}}
                                {{--                                                            @if($order->tds == null)--}}
                                {{--                                                                <input style="width: 85px;" type="file" name ="tds">--}}
                                {{--                                                            @else--}}

                                {{--                                                                <a class="btn btn-primary" href="{{ route('order.file',[encrypt('tds'),encrypt($order->tds)]) }}">Download</a>--}}
                                {{--                                                            @endif--}}
                                {{--                                                        </span>--}}
                                {{--                                                    </td>--}}
                                {{--                                                    <td class="py-1">--}}
                                {{--                                                        <span class="fw-bold">--}}
                                {{--                                                            @if($order->coa == null)--}}
                                {{--                                                                <input style="width: 85px;" type="file" name ="coa">--}}
                                {{--                                                            @else--}}

                                {{--                                                                <a class="btn btn-primary" href="{{ route('order.file',[encrypt('coa'),encrypt($order->coa)]) }}">Download</a>--}}
                                {{--                                                            @endif--}}
                                {{--                                                        </span>--}}
                                {{--                                                    </td>--}}

                                {{--                                                </tr>--}}

                                {{--                                                </tbody>--}}
                                {{--                                            </table>--}}
                                {{--                                        </div>--}}

                                {{--                                        <div class="card-body invoice-padding pb-0">--}}
                                {{--                                            <div class="row invoice-sales-total-wrapper">--}}
                                {{--                                                <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">--}}
                                {{--                                                    <p class="card-text mb-0">--}}
                                {{--                                                        <span class="fw-bold">Salesperson:</span> <span class="ms-75">Admin</span>--}}
                                {{--                                                    </p>--}}
                                {{--                                                </div>--}}
                                {{--                                                <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">--}}
                                {{--                                                    <div class="invoice-total-wrapper">--}}

                                {{--                                                        <hr class="my-50" />--}}
                                {{--                                                        <div class="invoice-total-item">--}}

                                {{--                                                            <p class="invoice-total-title">Total:</p>--}}
                                {{--                                                            <p class="invoice-total-amount">{{ $order->price }} L.E</p>--}}
                                {{--                                                            <button type="submit" class="btn btn-info">Complete</button>--}}
                                {{--                                                        </div>--}}
                                {{--                                                    </div>--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                        <!-- Invoice Description ends -->--}}

                                {{--                                        <hr class="invoice-spacing" />--}}
                                {{--                                    </form>--}}

                                {{--                                @endif--}}
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

                        {{--                        <!-- Invoice Actions -->--}}
                        <div class="col-xl-12 col-md-6 col-12 invoice-actions mt-md-0 mt-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Details</h4>
                                    <form method="post" action="{{ route('admin.equipment.order.accept') }}">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <button type="submit" class="btn btn-primary">RFQ</button>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Company</th>
                                            <th>Phone</th>
                                            <th>Docs</th>
                                            <th>Photos</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->order_price as $order_price)
                                            <tr>
                                                <td>{{ $order_price->seller->name }}</td>
                                                <td>{{ $order_price->seller->phone }}</td>
                                                <td><a href="#" class="btn btn-success" data-bs-toggle="modal"
                                                       data-bs-target="#docs{{ $order_price->id }}">show docs</a></td>
                                                <td><a href="#" class="btn btn-success" data-bs-toggle="modal"
                                                       data-bs-target="#photo{{ $order_price->id }}">show photos</a>
                                                </td>
                                                <td><a href="#" class="btn btn-success" data-bs-toggle="modal"
                                                       data-bs-target="#price{{ $order_price->id }}">show prices</a>
                                                </td>
                                                <td><a href="#" class="btn btn-success">PQ</a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        {{--                        <!-- /Invoice Actions -->--}}
                    </div>
                </section>

                @foreach($order->order_price as $order_price)
                    <div class="modal fade text-start" id="docs{{ $order_price->id }}" tabindex="-1"
                         aria-labelledby="myModalLabel17" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel17">Docs</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @foreach(json_decode($order_price->docs) as $doc )
                                        <a class="btn btn-primary"
                                           href="{{ route('product.imgs',[encrypt('Equipment/docs'),encrypt($doc)]) }}">Download
                                            docs</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade text-start" id="photo{{ $order_price->id }}" tabindex="-1"
                         aria-labelledby="myModalLabel17" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel17">Photos</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @foreach(json_decode($order_price->photos) as $photo )
                                        <a class="btn btn-primary"
                                           href="{{ route('product.imgs',[encrypt('Equipment/photos'),encrypt($photo)]) }}">Download
                                            docs</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade text-start" id="price{{ $order_price->id }}" tabindex="-1"
                         aria-labelledby="myModalLabel17" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel17">Prices</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Equipments</th>
                                            <th>size</th>
                                            <th>price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order_price->equipment_price as $equipment_price)
                                            <tr>
                                                <td>
                                                    @foreach($order->order_equipments as $equipment)
                                                        @if($equipment->id == $equipment_price->equipment_id)
                                                            {{ $equipment->equipment->title }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <th>
                                                    @foreach($order->order_equipments as $equipment)
                                                        @if($equipment->id == $equipment_price->equipment_id)
                                                            {{ $equipment->sizing }}
                                                        @endif
                                                    @endforeach
                                                </th>
                                                <td>{{ $equipment_price->price }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
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

                {{--                <!-- Send Invoice Sidebar -->--}}
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
                <div class="modal fade text-start" id="default" tabindex="-1" aria-labelledby="myModalLabel1"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel1">Decline Message</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{ route('admin.buy.decline') }}">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="{{ $order->id }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="exampleFormControlTextarea1">Enter
                                                    Decline Message</label>
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
