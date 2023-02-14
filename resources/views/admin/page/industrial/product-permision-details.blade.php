@extends('admin.layout.master')
@section('style')

@endsection
@section('script')

@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <section class="app-ecommerce-details">
                    <div class="card">
                        <!-- Product Details starts -->
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="{{ route('product.files',[encrypt('cover'),encrypt($product->cover)]) }}" class="img-fluid product-img" alt="product image"/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-7">
                                    <h4>{{$product->allProduct->name}}</h4>
                                    <span class="card-text item-company">By <a href="#" class="company-name">{{ $product->seller->name }}</a></span>
                                    <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                                        <h4 class="item-price me-1">EGY {{ $product->price }}</h4>
                                    </div>
                                    <p class="card-text">Status -
                                        @if($product->status == 1)
                                        <span class="text text-success">Active</span>
                                        @elseif($product->status == 0)
                                            <span class="text text-warning">padding</span>
                                        @else
                                            <span class="text text-danger">Block</span>
                                    @endif
                                    <p class="card-text">
                                        {!! $product->description !!}
                                    </p>
                                </div>
                                    <div class="d-flex justify-content-center pt-2">
                                        <a style="margin-right: 10px" href="javascript:;" class="btn btn-outline-danger suspend-user" data-bs-toggle="modal" data-bs-target="#default">Decline</a>
                                        <a href="javascript:;" class="btn btn-outline-success suspend-user" data-bs-toggle="modal" data-bs-target="#accept">Accept</a>
                                    </div>
                                <!--Message Modal -->
                                <div class="modal fade text-start" id="accept" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel1">Accept Confirmation</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="{{ route('admin.industrial.product.accept') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h3>Confirm accept Product</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Accept</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--Message Modal -->
                                <div class="modal fade text-start" id="default" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel1">Decline Message</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="{{ route('admin.industrial.product.decline') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="exampleFormControlTextarea1">Enter Decline Message</label>
                                                                <textarea name="message"
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
                        <!-- Product Details ends -->
                    </div>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th> Name</th>
                                    <th>Value</th>
                                </tr>
                                </thead>
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
                                    <th>Dim</th>
                                    <td>{{ $product->dim }}</td>
                                </tr>
                                @if($product->mods != null)
                                <tr>
                                    <td>MODs</td>
                                    <td><a href="{{ route('admin.product.file',['mods',$product->mods]) }}" class="btn btn-outline-primary suspend-user">Download</a></td>
                                </tr>
                                @endif
                                @if($product->tds != null)
                                <tr>
                                    <td>TDS</td>
                                    <td><a href="{{ route('admin.product.file',['tds',$product->tds]) }}" class="btn btn-outline-primary suspend-user">Download</a></td>
                                </tr>
                                @endif
                                @if($product->coa != null)
                                    <tr>
                                    <td>COA</td>
                                    <td><a href="{{ route('admin.product.file',['coa',$product->coa]) }}" class="btn btn-outline-primary suspend-user">Download</a></td>
                                </tr>
                                @endif
                                @if($product->docs != null)

                                    @foreach(json_decode($product->docs) as $doc)
                                <tr>
                                    <td>Documents</td>
                                    <td><a href="{{ route('admin.product.file',['docs',$doc]) }}" class="btn btn-outline-primary suspend-user">Download</a></td>
                                </tr>
                               @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

@endsection
