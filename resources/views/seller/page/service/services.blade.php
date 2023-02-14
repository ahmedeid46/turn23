@extends('seller.layout.master')
@section('styles')
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

@endsection
@section('content')
    <main class="main">
        <div class="container text-center">
            <table class="table table-order text-left">
                <thead>
                <tr>
                    <th class="order-id">Service Code</th>
                    <th>Status</th>
                    <th class="order-date">Rate</th>
                    <th class="order-price">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($services as $service)
                    @foreach($sub_cats as $sub_cat)
                        @if($service->sub_cat_id == $sub_cat->sub_cat_id)
                            <tr>
                                <td>{{ $service->code }}</td>
                                <td>
                                    @if(count($service->price_lists) == 0)
                                        <span class="text text-info">You haven't uploaded the price list file yet</span>
                                    @else
                                        @foreach($service->price_lists as $price_list)
                                            @if($service->status == 1 && $price_list->status == 1 )
                                                <span class="text text-danger">Padding Customer Accept Price List</span>
                                            @elseif($service->status == 1 && $price_list->status == 0)
                                                <span class="text text-primary">Padding Admin Accept Price List</span>
                                            @elseif($service->status == 2 && $price_list->status == 2)
                                                <span class="text text-primary">You have been selected for this service</span>
                                            @elseif($service->status == 2 && $price_list->status == 1)
                                                <span class="text text-danger">You haven't been selected for this service</span>
                                            @elseif($service->status == 3 && $price_list->status == 3)
                                                <span class="text text-success">Congratulations you have done the service</span>
                                            @elseif($service->status == 3 && $price_list->status == 1)
                                                <span class="text text-success">Inappropriate price list for the customer</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $service->rate !=null ? $service->rate: "no rate yet"}}</td>
                                <td>
                                    <div class="action">
                                        @if(count($service->price_lists) == 0)
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#accept{{ $service->id }}">
                                                accept
                                            </button>
                                        @else
                                            @foreach($service->price_lists as $price_list)
                                                @if($service->status == 2 && $price_list->status == 2 )
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#complete{{ $service->id }}">
                                                        Complete
                                                    </button>
                                                    <div class="modal fade" id="complete{{ $service->id }}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel2">Accept</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{ route('seller.service.complete') }}" enctype="multipart/form-data" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="service" value="{{ $service->id }}">
                                                                    <input type="hidden" name="priceList" value="{{ $price_list->id }}">
                                                                    <b> you are sure the complete this service</b>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endif
                                            @endforeach
                                        @endif
                                        <button onclick="window.location.href='{{ route('seller.service.description',$service->id) }}'" type="button" class="btn btn-primary">Request Description</button>
                                    </div>
                                    <div class="modal fade" id="accept{{ $service->id }}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel2">Accept</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('seller.service.accept') }}" enctype="multipart/form-data" method="post">
                                                    @csrf
                                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                                    <div class="modal-body">
                                                        <label for="exampleFormControlTextarea1" class="form-label">Upload Price List</label>
                                                        <input type="file" class="form-control" name="file" id="exampleFormControlTextarea1">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                @endif
                @endforeach
                @endforeach
            </table>
            <hr class="mt-0 mb-3 pb-2" />
        </div>
    </main>
    <!-- End .main -->

@endSection
