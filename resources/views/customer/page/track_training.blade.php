@extends('customer.layout.master')
@section('style')

@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

@endsection
@section('popup')

@endsection
@section('content')
    <main class="main">

        <section class="container">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Trainer Name</th>
                    <th scope="col">Trainer Phone Number</th>
                    <th scope="col">Price</th>
                    <th scope="col">Training Type</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trainings as $training)
                    <tr>
                    <th>{{$training->trainer->name}}</th>
                    <th>{{ $training->status ==2?$training->trainer->phone:'wait approve' }}</th>
                    @if($training->type_course == 1)
                        <th>{{$training->trainer->price}}</th>
                        <th>{{$training->trainer->type_cource==0?'offline':'online'}}</th>
                    @elseif($training->type_course == 2)
                        <th>{{$training->price}}</th>
                        <th>{{$training->trainer->trining_type==0?'offline':'online'}}</th>
                    @endif
                    <th>
                        @switch($training->status)
                            @case(-2)
                                <span class="badge badge-danger">decline</span>
                            @break
                            @case(-1)
                                <span class="badge badge-danger">block</span>
                            @break
                            @case(0)
                                <span class="badge badge-warning">Padding</span>
                            @break
                            @case(1)
                                <span class="badge badge-warning">Padding</span>
                            @break
                            @case(2)
                                <span class="badge badge-success">Accepted</span>
                            @break
                        @endswitch
                    </th>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </section>
    </main>
    <!-- End .main -->
@endsection
