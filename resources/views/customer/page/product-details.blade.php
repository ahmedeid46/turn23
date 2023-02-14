@extends('customer.layout.master')
@section('style')

@endsection
@section('script')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script>
    $("#cart-add-button").click(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        let Id = $("#cart-add-button").data('value');
        let counts = $("#count").val();
        let url = '{{ route('customer.chart.add') }}';
        $.ajax({
            type:'POST',
            url: url,
            data:{product_id : Id,count:counts},
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
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('customer.home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $product->allProduct->name }}</a></li>
                </ol>
            </nav>

            <div class="product-single-container product-single-default">
                <div class="cart-message d-none">
                    <strong class="single-cart-notice">“{{ $product->allProduct->name }}”</strong>
                    <span>has been added to your cart.</span>
                </div>

                <div class="row">
                    <div class="col-lg-5 col-md-6 product-single-gallery">
                        <div class="product-slider-container">
                            <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                @foreach(json_decode($product->photos) as $photo)
                                    <div class="product-item">
                                        <img class="product-single-image" src="{{ route('product.files',[encrypt('photo'),encrypt($photo)]) }}" data-zoom-image="{{ route('product.files',[encrypt('photo'),encrypt($photo)]) }}" style="min-width: 468px;min-height: 468px;max-height: 468px;max-width: 468px" width="468" height="468" alt="product" />
                                    </div>
                                @endforeach
                            </div>
                            <!-- End .product-single-carousel -->
                            <span class="prod-full-screen">
									<i class="icon-plus"></i>
								</span>
                        </div>

                        <div class="prod-thumbnail owl-dots">
                            @foreach(json_decode($product->photos) as $photo)
                                <div class="owl-dot">
                                    <img src="{{ route('product.files',[encrypt('photo'),encrypt($photo)]) }}" style="max-width: 110px;max-height: 110px;min-height: 110px;min-width: 110px" width="110" height="110" alt="product-thumbnail" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- End .product-single-gallery -->

                    <div class="col-lg-7 col-md-6 product-single-details">
                        <h1 class="product-title">{{ $product->allProduct->name }}</h1>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:60%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->

                            <a href="#" class="rating-link">( 6 Reviews )</a>
                        </div>
                        <!-- End .ratings-container -->

                        <hr class="short-divider">

                        <div class="price-box">
                            <span class="new-price">${{ $product->price }}</span>

                        </div>
                        <!-- End .price-box -->

                        <div class="product-desc">
                            <p>
                                {{ $product->description }}
                            </p>
                        </div>
                        <!-- End .product-desc -->

{{--                        <ul class="single-info-list">--}}

{{--                            <li>--}}
{{--                                CATEGORY: <strong>{{ $product->subcat->title }}</strong>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                        @auth('customer')
                            <div class="product-action">

                                    <div class="product-single-qty">
                                        <input id="count" class="horizontal-quantity form-control" type="text" name="count">
                                    </div>
                                    <!-- End .product-single-qty -->
                                    <button id="cart-add-button" data-value="{{ $product->id }}" class="btn btn-dark add-cart mr-2" title="Add to Cart">Add to
                                        Cart</button>

                                    <a href="{{ route('customer.chart') }}" class="btn btn-gray view-cart d-none">View cart</a>
                            </div>
                        @else
                            <a href="{{ route('customer.login') }}" class="btn btn-dark " >Login to Buy</a>
                            <a href="{{ route('customer.register') }}" class="btn btn-dark " >Register to Buy</a>

                        @endauth

                    </div>
                    <!-- End .product-single-details -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .product-single-container -->

            <div class="product-single-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content" role="tab" aria-controls="product-tags-content" aria-selected="false">Additional
                            Information</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                        <div class="product-desc-content">
                            <p>
                                {!! $product->content !!}
                            </p>
                        </div>
                        <!-- End .product-desc-content -->
                    </div>
                    <!-- End .tab-pane -->

                    <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                        <table class="table table-striped mt-2">
                            <tbody>
                            <tr>
                                <th>packing</th>
                                <td>{{ $product->packing }}</td>
                            </tr>

                            <tr>
                                <th>sample</th>
                                <td>{{ $product->sample == 1?"Available":"Not Available" }}</td>
                            </tr>

                            <tr>
                                <th>Production Data</th>
                                <td>{{ $product->ProductionData }}</td>
                            </tr>

                            <tr>
                                <th>Expiration Date</th>
                                <td>{{ $product->expirationDate }}</td>
                            </tr>

                            <tr>
                                <th>Length</th>
                                <td>{{ $product->length }}</td>
                            </tr>
                            <tr>
                                <th>IN or OUT</th>
                                <td>{{ $product->in_out}}</td>
                            </tr>
                            <tr>
                                <th>Sch</th>
                                <td>{{ $product->sch }}</td>
                            </tr>
                            <tr>
                                <th>Pressure</th>
                                <td>{{ $product->pressure }}</td>
                            </tr>
                            <tr>
                                <th>Size</th>
                                <td>{{ $product->size }}</td>
                            </tr>
                            <tr>
                                <th>Brand</th>
                                <td>{{ $product->brand }}</td>
                            </tr>
                            <tr>
                                <th>Class</th>
                                <td>{{ $product->class }}</td>
                            </tr>
                            <tr>
                                <th>Moc</th>
                                <td>{{ $product->moc }}</td>
                            </tr>
                            <tr>
                                <th>grade</th>
                                <td>{{ $product->grade }}</td>
                            </tr>

                            <tr>
                                <th>website</th>
                                <td>{{ $product->website }}</td>
                            </tr>

                            <tr>
                                <th>Material</th>
                                <td>{{ $product->material }}</td>
                            </tr>
                            <tr>
                                <th>Flow Rate</th>
                                <td>{{ $product->flowrate }}</td>
                            </tr>
                            <tr>
                                <th>Material</th>
                                <td>{{ $product->material }}</td>
                            </tr>
                            @if($product->mods != null)
                                <tr>
                                    <td>MODs</td>
                                    <td><a href="{{ route('product.imgs',[encrypt('mods'),encrypt($product->mods)]) }}" class="btn btn-outline-primary suspend-user">Download</a></td>
                                </tr>
                            @endif
                            @if($product->tds != null)
                                <tr>
                                    <td>TDS</td>
                                    <td><a href="{{ route('product.imgs',[encrypt('tds'),encrypt($product->tds)]) }}" class="btn btn-outline-primary suspend-user">Download</a></td>
                                </tr>
                            @endif
                            @if($product->coa != null)
                                <tr>
                                    <td>COA</td>
                                    <td><a href="{{ route('product.imgs',[encrypt('coa'),encrypt($product->coa)]) }}" class="btn btn-outline-primary suspend-user">Download</a></td>
                                </tr>
                            @endif
                            @if($product->docs != null)

                                @foreach(json_decode($product->docs) as $doc)
                                    <tr>
                                        <td>Documents</td>
                                        <td><a href="{{ route('product.imgs',[encrypt('docs'),encrypt($doc)]) }}" class="btn btn-outline-primary suspend-user">Download</a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- End .tab-pane -->
                </div>
                <!-- End .tab-content -->
            </div>
            <!-- End .product-single-tabs -->
        </div>
        <!-- End .container -->
    </main>
    <!-- End .main -->

@endsection
