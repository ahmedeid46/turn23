@extends('seller.layout.master')
@section('styles')
@endsection
@section('script')
@endsection
@section('content')
    <main class="main">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Product</a></li>
                </ol>
            </nav>

            <div class="product-single-container product-single-default">
                <div class="cart-message d-none">
                    <strong class="single-cart-notice">“This is product name”</strong>
                    <span>has been added to your cart.</span>
                </div>

                <div class="row">
                    <div class="col-lg-5 col-md-6 product-single-gallery">
                        <div class="product-slider-container">
                            <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                              @foreach(json_decode($product->photos) as $photo)
                                <div class="product-item">
                                    <img class="product-single-image" src="{{ route('seller.product.files',[encrypt('photo'),encrypt($photo)]) }}" data-zoom-image="{{ route('seller.product.files',[encrypt('photo'),encrypt($photo)]) }}" style="min-width: 468px;min-height: 468px;max-height: 468px;max-width: 468px" width="468" height="468" alt="product" />
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
                                <img src="{{ route('seller.product.files',[encrypt('photo'),encrypt($photo)]) }}" style="max-width: 110px;max-height: 110px;min-height: 110px;min-width: 110px" width="110" height="110" alt="product-thumbnail" />
                            </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- End .product-single-gallery -->

                    <div class="col-lg-7 col-md-6 product-single-details">
                        <h1 class="product-title">{{ $product->allProduct->name }}</h1>
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

@endSection
