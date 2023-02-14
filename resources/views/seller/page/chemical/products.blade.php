@extends('seller.layout.master')
@section('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection
@section('script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
    </script>
@endsection
@section('content')

    <main class="main">
            <div class="category-banner-container bg-gray">
                <div class="category-banner banner text-uppercase" style="background: no-repeat 60%/cover url('{{ asset('assets/customer') }}/images/banners/banner-top.jpg');">
                    <div class="container position-relative">
                        <div class="row">
                            <div class="pl-lg-5 pb-5 pb-md-0 col-sm-5 col-xl-4 col-lg-4 offset-1">
                                <h3>{{ $sub_cat[0]->title }}</h3>
{{--                                <a href="" class="btn btn-dark">Get Yours!</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('seller.chemical') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $sub_cat[0]->title }}</li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-lg-12 main-content">
                        <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                            <div class="toolbox-left">
                                <a href="#" class="sidebar-toggle">
                                    <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                        <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                        <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                        <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                        <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                        <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                        <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                        <path
                                            d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                            class="cls-2"></path>
                                        <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                        <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                        <path
                                            d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                            class="cls-2"></path>
                                    </svg>
                                    <span>Filter</span>
                                </a>

{{--                                <div class="toolbox-item toolbox-sort">--}}
{{--                                    <label>Sort By:</label>--}}

{{--                                    <div class="select-custom">--}}
{{--                                        <select name="orderby" class="form-control">--}}
{{--                                            <option value="menu_order" selected="selected">Default sorting</option>--}}
{{--                                            <option value="popularity">Sort by popularity</option>--}}
{{--                                            <option value="rating">Sort by average rating</option>--}}
{{--                                            <option value="date">Sort by newness</option>--}}
{{--                                            <option value="price">Sort by price: low to high</option>--}}
{{--                                            <option value="price-desc">Sort by price: high to low</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <!-- End .select-custom -->--}}


{{--                                </div>--}}
{{--                                <!-- End .toolbox-item -->--}}
                            </div>
                            <!-- End .toolbox-left -->

                            <div class="toolbox-right">
                                <!-- Button trigger modal -->
                                <!-- Large modal -->
                                <button style="width: 300px;height: 41px;" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add New Product</button>

                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" enctype="multipart/form-data" action="{{ route('seller.add.product') }}">
                                                @csrf
                                                <input type="hidden" name="seller_id" value="{{ auth()->user()->getAuthIdentifier() }}">
                                                <input type="hidden" name="sub_cat_id" value="{{ $sub_cat[0]->id }}">
                                                <div class="modal-body">
                                                    <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="product-name">Product<span class="required">*</span></label>
                                                                    <select class="form-control" name="product_id">
                                                                        <option selected>Select Product</option>
                                                                        @foreach($allProductsForSelect as $selectProduct )
                                                                        <option value="{{ $selectProduct->id }}">{{ $selectProduct->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="product-name">Product Price By Dollar (usd) $ <span class="required">*</span></label>
                                                                    <input type="number" class="form-control" name="price" placeholder="Product price by $" min="0.00" step="0.01" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Product Quantity <span class="required">*</span></label>
                                                                <input type="number" class="form-control" placeholder="Product Quantity" name="qty" id="product-name" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 row-cols-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Product unit <span class="required">*</span></label>
                                                                <select class="form-control" name="unit">
                                                                    <option value="liter">Liter</option>
                                                                    <option value="kg">Kg</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Product Packing <span class="required">*</span></label>
                                                                <select class="form-control" name="packing">
                                                                    <option value="Drum">Drum</option>
                                                                    <option value="Barrel">Barrel</option>
                                                                    <option value="IPC">IPC</option>
                                                                    <option value="Plastic Bag">Plastic Bag</option>
                                                                    <option value="Paper Bag">Paper Bag</option>
                                                                    <option value="Glass Container">Glass Container</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Mods <span class="required">*</span></label>
                                                                <input type="file" class="form-control" name="mods"  required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Product TDS <span class="required">*</span></label>
                                                                <input type="file" class="form-control" placeholder="product tds" name="tds" id="product-name" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Product Coa <span class="required">*</span></label>
                                                                <input type="file" class="form-control" name="coa" placeholder="Product Coa"  required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="product-name">Product Sample<span class="required">*</span></label>
                                                                <select class="form-control form-select" name="sample">
                                                                    <option value="0">Not Available</option>
                                                                    <option value="1">Available</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Production date <span class="required">*</span></label>
                                                                <input type="datetime-local" class="form-control" placeholder="Production Date" name="ProductionData" id="product-name" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Expiration date<span class="required">*</span></label>
                                                                <input type="datetime-local" class="form-control" name="expirationDate" placeholder="Expiration date"  required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Length <span class="required">*</span></label>
                                                                <input class="form-control" name="length" placeholder="Product Length" type="number" min='0.00' step="0.01">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 row-cols-6">
                                                            <div class="form-group">
                                                                <label for="product-name">length unit <span class="required">*</span></label>
                                                                <select class="form-control" name="length_unit">
                                                                    <option value="mm">mm</option>
                                                                    <option value="m">m</option>
                                                                    <option value="inch">inch</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Dim <span class="required">*</span></label>
                                                                <input class="form-control" name="dim" placeholder="Product Length" type="number" min='0.00' step="0.01">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 row-cols-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Dim unit <span class="required">*</span></label>
                                                                <select class="form-control" name="dim_unit">
                                                                    <option value="mm">mm</option>
                                                                    <option value="m">m</option>
                                                                    <option value="inch">inch</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>IN / OUT</label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="in_out" id="exampleRadios1" value="in">
                                                                    <label style="padding-left: 5px;" class="form-check-label" for="exampleRadios1">
                                                                      IN
                                                                    </label>
                                                                  </div>
                                                                  <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="in_out" id="exampleRadios2" value="out">
                                                                    <label style="padding-left: 5px;" class="form-check-label" for="exampleRadios2">
                                                                     OUT
                                                                    </label>
                                                                  </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" >
                                                                <label>SCH</label>
                                                                <input type="number" class="form-control" name="sch" placeholder="Product SCH">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Rated Pressure <span class="required">*</span></label>
                                                                <input class="form-control" name="pressure" placeholder="Product Rated Pressure" type="number" min='0.00' step="0.01">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 row-cols-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Rated Pressure unit <span class="required">*</span></label>
                                                                <select class="form-control" name="Pressure_unit">
                                                                    <option value="Bar">Bar</option>
                                                                    <option value="Psi">Psi</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Product size (inch) <span class="required">*</span></label>
                                                                <input class="form-control" name="size" placeholder="Product size" type="number" min='0.00' step="0.01">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Brand <span class="required">*</span></label>
                                                                <input class="form-control" name="brand" placeholder="Product Brand">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Product Docs <span class="required">*</span></label>
                                                                <input class="form-control" name="docs[]" placeholder="Product Docs" type="file" multiple>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Product Class <span class="required">*</span></label>
                                                               <input name="class" type="number" class="form-control" PLACEHOLDER="Product Class" min="0.00" step="0.01">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Product Moc <span class="required">*</span></label>
                                                                <input class="form-control" name="moc" placeholder="Product MOC" type="text" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Product Material <span class="required">*</span></label>
                                                                <input class="form-control" name="material" placeholder="Product Material" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Product Grade <span class="required">*</span></label>
                                                                <input class="form-control" name="grade" placeholder="Product Grade" type="text" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Product Website <span class="required">*</span></label>
                                                                <input class="form-control" name="website" placeholder="Product Website" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Product Flow Rate <span class="required">*</span></label>
                                                                <input class="form-control" name="flowrate" placeholder="Product Flow Rate" type="number" min="0.00" step="0.01" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 row-cols-6">
                                                            <div class="form-group">
                                                                <label for="product-name">Flow Rate unit <span class="required">*</span></label>
                                                                <select class="form-control" name="flow_rate_unit">
                                                                    <option value="m3/hr">m3/hr</option>
                                                                    <option value="l/min">l/min</option>
                                                                    <option value="g/min">g/min</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Product Cover <span class="required">*</span></label>
                                                                <input class="form-control" name="cover" type="file">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Product Photos <span class="required">*</span></label>
                                                                <input class="form-control" name="photos[]" type="file" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Product Description<span class="required">*</span></label>
                                                                <input name="description" class="form-control"  type="text" placeholder="Product Description" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Product Content<span class="required">*</span></label>
                                                                <textarea id="editor" class="form-control" name="content"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End .toolbox-right -->
                        </nav>

                        <div class="row">
                            @foreach( $allProducts as $allProduct)
                                @foreach($allProduct->product as $product)
                                    <div class="col-6 col-sm-4">
                                        <div class="product-default">
                                            <figure>
                                                <a href="{{ route('seller.product.show',$hashids->encode($product->id)) }}">
                                                    <img src="{{ route('seller.product.files',[encrypt('cover'),encrypt($product->cover)]) }}" width="280" height="280" alt="product" />
                                                </a>
                                            </figure>

                                            <div class="product-details">
                                                <div class="category-wrap">
                                                    <div class="category-list">
                                                        <a href="#" class="product-category">{{ $sub_cat[0]->title }}</a>
                                                    </div>
                                                </div>

                                                <h3 class="product-title"> <a href="{{ route('seller.product.show',$hashids->encode($product->id)) }}">{{ $allProduct->name }}</a> </h3>

                                                <div class="ratings-container">
                                                    <div class="product-ratings">
                                                        <span class="ratings" style="width:100%"></span>
                                                        <!-- End .ratings -->
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                    <!-- End .product-ratings -->
                                                </div>
                                                <!-- End .product-container -->

                                                <div class="price-box">
                                                    <span class="product-price">${{ $product->price }}</span>
                                                </div>
                                                <!-- End .price-box -->

                                                <div class="product-action">
                                                    <a href="#" class="btn-icon btn-add-cart" data-toggle="modal" data-target="#editProduct{{ $product->id }}"><i class="fa fa-arrow-right"></i><span>Edit Product</span></a>
                                                </div>
                                                <div class="modal fade bd-example-modal-lg-two" id="editProduct{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myLargeModalLabeltwo">Edit Product</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post" enctype="multipart/form-data" action="{{ route('seller.edit.product',$product->id) }}">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Product Name </label>
                                                                                <input type="text" class="form-control" placeholder="product Title" value="{{ $product->title }}" name="title" id="product-name" required />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Product Price By Dollar (usd) $ </label>
                                                                                <input type="number" class="form-control" name="price" value="{{ $product->price }}" placeholder="Product price by $" min="0.00" step="0.01"  />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Product Quantity </label>
                                                                                <input type="number" class="form-control" value="{{ explode(" ",$product->qty)[0] }}" placeholder="Product Quantity" name="qty" id="product-name"  />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 row-cols-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Product unit </label>
                                                                                <select class="form-control" name="unit">
                                                                                    <option {{ explode(" ",$product->qty)[1]=="liter"?"select":'' }} value="liter">Liter</option>
                                                                                    <option {{ explode(" ",$product->qty)[1]=="kg"?"select":'' }} value="kg">Kg</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Product Packing </label>
                                                                                <select class="form-control" name="packing">
                                                                                    <option {{ $product->packing=="Drum"?"select":'' }} value="Drum">Drum</option>
                                                                                    <option {{ $product->packing=="Barrel"?"select":'' }} value="Barrel">Barrel</option>
                                                                                    <option {{ $product->packing=="IPC"?"select":'' }}  value="IPC">IPC</option>
                                                                                    <option {{ $product->packing=="Plastic Bag"?"select":'' }} value="Plastic Bag">Plastic Bag</option>
                                                                                    <option {{ $product->packing=="Paper Bag"?"select":'' }} value="Paper Bag">Paper Bag</option>
                                                                                    <option {{ $product->packing=="Glass Container"?"select":'' }} value="Glass Container">Glass Container</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Mods </label>
                                                                                <input type="file" class="form-control" name="mods"   />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Product TDS </label>
                                                                                <input type="file" class="form-control" placeholder="product tds" name="tds" id="product-name"  />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Product Coa </label>
                                                                                <input type="file" class="form-control" name="coa" placeholder="Product Coa"   />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Product Sample</label>
                                                                                <select class="form-control form-select" name="sample">
                                                                                    <option {{ $product->sample=="0"?"select":'' }} value="0">Not Available</option>
                                                                                    <option {{ $product->sample=="1"?"select":'' }} value="1">Available</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Production date </label>
                                                                                <input type="datetime-local"  class="form-control" placeholder="Production Date" name="ProductionData" value="{{ $product->ProductionData }}" id="product-name"  />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Expiration date</label>
                                                                                <input type="datetime-local" class="form-control" name="expirationDate" placeholder="Expiration date" value="{{ $product->expirationDate }}"   />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Length </label>
                                                                                <input class="form-control" value="{{ explode(" ",$product->length)[0] }}"  name="length" placeholder="Product Length" type="number" min='0.00' step="0.01">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 row-cols-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">length unit </label>
                                                                                <select class="form-control" name="length_unit">
                                                                                    <option {{ explode(" ",$product->length)[1]=="mm"?"select":'' }} value="mm">mm</option>
                                                                                    <option {{ explode(" ",$product->length)[1]=="m"?"select":'' }} value="m">m</option>
                                                                                    <option {{ explode(" ",$product->length)[1]=="inch"?"select":'' }} value="inch">inch</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Dim </label>
                                                                                <input class="form-control" value="{{ explode(" ",$product->dim)[0] }}" name="dim" placeholder="Product Length" type="number" min='0.00' step="0.01">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 row-cols-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Dim unit </label>
                                                                                <select class="form-control" name="dim_unit">
                                                                                    <option {{ explode(" ",$product->length)[1]=="mm"?"select":'' }} value="mm">mm</option>
                                                                                    <option {{ explode(" ",$product->length)[1]=="m"?"select":'' }} value="m">m</option>
                                                                                    <option {{ explode(" ",$product->length)[1]=="inch"?"select":'' }} value="inch">inch</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>IN / OUT</label>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="in_out" id="exampleRadios1" {{ $product->in_out=="in"?"check":'' }}  value="in">
                                                                                    <label style="padding-left: 5px;" class="form-check-label" for="exampleRadios1">
                                                                                        IN
                                                                                    </label>
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" name="in_out" id="exampleRadios2" {{ $product->in_out=="out"?"check":'' }} value="out">
                                                                                    <label style="padding-left: 5px;" class="form-check-label" for="exampleRadios2">
                                                                                        OUT
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group" >
                                                                                <label>SCH</label>
                                                                                <input type="number" class="form-control" value="{{ $product->sch }}" name="sch" placeholder="Product SCH">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Rated Pressure </label>
                                                                                <input class="form-control" name="pressure" value="{{ explode(" ",$product->pressure)[0] }}" placeholder="Product Rated Pressure" type="number" min='0.00' step="0.01">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 row-cols-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Rated Pressure unit </label>
                                                                                <select class="form-control" name="Pressure_unit">
                                                                                    <option {{ explode(" ",$product->pressure)[1]=="Bar"?"select":'' }} value="Bar">Bar</option>
                                                                                    <option {{ explode(" ",$product->pressure)[1]=="Psi"?"select":'' }} value="Psi">Psi</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Product size (inch) </label>
                                                                                <input class="form-control" value="{{ $product->size }}" name="size" placeholder="Product size" type="number" min='0.00' step="0.01">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Brand </label>
                                                                                <input class="form-control" value="{{ $product->brand }}" name="brand" placeholder="Product Brand">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Product Docs </label>
                                                                                <input class="form-control" name="docs[]" placeholder="Product Docs" type="file" multiple>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Product Class </label>
                                                                                <input name="class" value="{{ $product->class }}" type="number" class="form-control" PLACEHOLDER="Product Class" min="0.00" step="0.01">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Product Moc </label>
                                                                                <input class="form-control" value="{{ $product->moc }}" name="moc" placeholder="Product MOC" type="text" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Product Material </label>
                                                                                <input class="form-control" value="{{ $product->material }}" name="material" placeholder="Product Material" type="text" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Product Grade </label>
                                                                                <input class="form-control" value="{{ $product->grade }}" name="grade" placeholder="Product Grade" type="text" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Product Website </label>
                                                                                <input class="form-control" name="website" value="{{ $product->website }}" placeholder="Product Website" type="text" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Product Flow Rate </label>
                                                                                <input class="form-control" value="{{ explode(" ",$product->flowrate)[0] }}" name="flowrate" placeholder="Product Flow Rate" type="number" min="0.00" step="0.01" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 row-cols-6">
                                                                            <div class="form-group">
                                                                                <label for="product-name">Flow Rate unit </label>
                                                                                <select class="form-control" name="flow_rate_unit">
                                                                                    <option {{ explode(" ",$product->flowrate)[1]=="m3/hr"?"select":'' }} value="m3/hr">m3/hr</option>
                                                                                    <option {{ explode(" ",$product->flowrate)[1]=="l/min"?"select":'' }} value="l/min">l/min</option>
                                                                                    <option {{ explode(" ",$product->flowrate)[1]=="g/min"?"select":'' }} value="g/min">g/min</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Product Cover </label>
                                                                                <input class="form-control" name="cover" type="file">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Product Photos </label>
                                                                                <input class="form-control" name="photos[]" type="file" multiple>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Product Description</label>
                                                                                <input name="description" value="{{ $product->description}}" class="form-control"  type="text" placeholder="Product Description" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Product Conten</label>
                                                                                <textarea class="form-control" name="content">
                                                                                    {{ $product->content }}
                                                                                </textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- End .product-details -->
                                        </div>
                                    </div>
                                    <!-- End .col-sm-4 -->
                                @endforeach
                            @endforeach
                        </div>
                        <!-- End .row -->

                        <nav class="toolbox toolbox-pagination">
                            {!! $allProducts->links() !!}
                        </nav>
                    </div>
                </div>
                <!-- End .row -->
            </div>
            <!-- End .container -->

            <div class="mb-4"></div>
            <!-- margin -->
        </main>
    <!-- End .main -->
@endSection
