@extends('admin.layout.master')
@section('style')

@endsection
@section('script')
<script type="text/javascript">
    var $rows = $('#table tbody tr');
    $('#search').on('input',function() {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

        $rows.show().filter(function() {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });
</script>
@endsection
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="row">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Products</h4>
                            <div class="view-options d-flex">
                                <div style="width: 100%" class="btn-group dropdown-sort">
                                    <a style="width: 35%" href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#large">Add Product</a>
                                </div>
                            </div>
                            <div class="col-12">
                                <input class="form-control " id="search" type="text" placeholder="Search..." >
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="table" class="table">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>SubCategory</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($adminProducts as $adminProduct)

                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ $adminProduct->allProduct->name }}</span>
                                        </td>
                                        <td>{{ $adminProduct->allProduct->subcat->title }}</td>
                                        <td>{{ $adminProduct->allProduct->subcat->cat->title }}</td>
                                        <td>

                                            <button class="btn btn-primary" onclick="window.location.href='{{ route('admin.show.admin.product',$adminProduct->id) }}'">
                                                <i data-feather="eye" class="me-50"></i>
                                                <span>Show</span>
                                            </button>

                                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orderForm{{$adminProduct->id}}">
                                                <i data-feather="eye" class="me-50"></i>
                                                <span>Order</span>
                                            </button>

                                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#EditForm{{$adminProduct->id}}">
                                                <i data-feather="eye" class="me-50"></i>
                                                <span>Edit</span>
                                            </button>

                                            <button class="btn btn-danger">
                                                <i data-feather="eye" class="me-50"></i>
                                                <span>Delete</span>
                                            </button>
                                        </td>
                                    </tr>


                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel17">Add Product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.create.admin.product') }}" enctype="multipart/form-data">
                    @csrf
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
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-name">Product Packing Type <span class="required">*</span></label>
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

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-name">Product Packing wight<span class="required">*</span></label>
                                    <input type="number" class="form-control"  name="packing_wieght">
                                </div>
                                <div class="form-group">
                                    <label for="product-name">Product Packing wight unit<span class="required">*</span></label>
                                    <input type="number" class="form-control"  name="packing_wieght_unit">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-name">Product origin<span class="required">*</span></label>
                                    <input type="text" class="form-control"  name="origin">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product-name">Product Producer<span class="required">*</span></label>
                                    <input type="text" class="form-control"  name="producer">

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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach($adminProducts as $adminProduct)
        <div class="modal fade text-start" id="orderForm{{$adminProduct->id}}" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Order Product</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('admin.order.submit.admin.product') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $adminProduct->id }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product-name">Product Count <span class="required">*</span></label>
                                        <input type="number" class="form-control" placeholder="Product Count" name="count" id="product-name" required />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade text-start" id="EditForm{{$adminProduct->id}}" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Edit Product</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('admin.update.admin.product') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $adminProduct->id }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product-name">Product<span class="required">*</span></label>
                                        <select class="form-control" name="product_id">
                                            <option selected>Select Product</option>
                                            @foreach($allProductsForSelect as $selectProduct )
                                                <option {{ $selectProduct->id == $adminProduct->id?"selected":"" }}  value="{{ $selectProduct->id }}">{{ $selectProduct->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product-name">Product Packing Type <span class="required">*</span></label>
                                        <select class="form-control" name="packing">
                                            <option {{ $adminProduct->packing == "Drum"?"selected":"" }} value="Drum">Drum</option>
                                            <option {{ $adminProduct->packing == "Barrel"?"selected":"" }} value="Barrel">Barrel</option>
                                            <option {{ $adminProduct->packing == "IPC"?"selected":"" }} value="IPC">IPC</option>
                                            <option {{ $adminProduct->packing == "Plastic Bag"?"selected":"" }} value="Plastic Bag">Plastic Bag</option>
                                            <option {{ $adminProduct->packing == "Paper Bag"?"selected":"" }} value="Paper Bag">Paper Bag</option>
                                            <option {{ $adminProduct->packing == "Glass Container"?"selected":"" }} value="Glass Container">Glass Container</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product-name">Product Packing wight<span class="required">*</span></label>
                                        <input type="number" class="form-control" value="{{ $adminProduct->packing_wieght!=null?explode(" ",$adminProduct->packing_wieght)[0]:"" }}" name="packing_wieght">
                                    </div>
                                    <div class="form-group">
                                        <label for="product-name">Product Packing wight unit<span class="required">*</span></label>
                                        <input type="text" class="form-control" value="{{ $adminProduct->packing_wieght!=null?explode(" ",$adminProduct->packing_wieght)[1]:"" }}"  name="packing_wieght_unit">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product-name">Product origin<span class="required">*</span></label>
                                        <input type="text" class="form-control" value="{{ $adminProduct->origin }} " name="origin">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product-name">Product Producer<span class="required">*</span></label>
                                        <input type="text" class="form-control" value="{{ $adminProduct->producer }}" name="producer">

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
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
