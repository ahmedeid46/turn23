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
                    <th class="order-id">trainee name</th>
                    <th class="order-trainee_type">Trainee Type</th>
                    <th class="order-trainees_num">Trainees Numbers</th>
                    <th class="order-type_course">online or offline</th>
                    <th class="order-duration">Start Date</th>
                    <th class="order-duration">End Date</th>
                    <th class="order-price">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trainings as $training)
                    <tr>
                        <td>{{ $training->customer->name }}</td>
                        <td>{{ $training->type_course == 1?'Individual':"Company" }}</td>
                        <td>{{ $training->type_course == 1?'Null':$training->trainees_num }}</td>
                        <td>{{ $training->type_course == 1?'Null':($training->trining_type == 0?'Offline':"Online") }}</td>
                        <td>{{ $training->type_course == 1?'Null':$training->start_date }}</td>
                        <td>{{ $training->type_course == 1?'Null':$training->end_date }}</td>
                        <td>
                            <div class="action">
                               @if($training->status == -2)
                                   <span class="text-danger">You Decline This Training</span>
                                @elseif($training->status == 2)
                                    <span class="text-success">You Accept This Training</span>
                                @elseif($training->status == 1)
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#accept{{ $training->id }}">
                                        Accept
                                    </button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#decline{{ $training->id }}">
                                        Decline
                                    </button>
                                @endif
                            </div>
                            <div class="modal fade" id="#accept{{ $training->id }}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel2">Accept</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('seller.trainer.accept') }}" enctype="multipart/form-data" method="post">
                                            @csrf
                                            <input type="hidden" name="training_id" value="{{ $training->id }}">
                                            <b> you are sure Accept</b>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="#decline{{ $training->id }}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel2">Accept</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('seller.trainer.decline') }}" enctype="multipart/form-data" method="post">
                                            @csrf
                                            <input type="hidden" name="training_id" value="{{ $training->id }}">
                                            <b> you are sure the complete this service</b>
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
                     @endforeach

                </tbody>
            </table>
            <hr class="mt-0 mb-3 pb-2" />
        </div>
    </main>
    <!-- End .main -->
@endSection
