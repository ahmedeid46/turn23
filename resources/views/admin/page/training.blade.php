@extends('admin.layout.master')
@section('script')
    {{-- section script  --}}
    <script>
        $('#selectTrainer').on('change',function(){
            let seller_id = $(this).val()
            $('.trainers').addClass('d-none')
            $('#trainer-'+seller_id).removeClass('d-none')

            $.ajax({
                type : 'get',
                url : '{{ route('admin.group.location.check') }}',
                data:{'id':seller_id},
                success:function(data){
                    $('#location').html(data);
                }
            });
        });
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

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="row">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Requests</h4>
                            <div class="view-options d-flex">
                                <input class="form-control " id="search" type="text" placeholder="Search..." >
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="table" class="table">
                                <thead>
                                <tr>
                                    <th>Trainee name</th>
                                    <th>Trainer name</th>
                                    <th>Specification</th>
                                    <th>Type Course</th>
                                    <th>num Trainee</th>
                                    <th>ON/OF line</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trainings as $training)
                                    <tr>
                                        <td>{{ $training->customer->name }}</td>
                                        <td>{{ $training->trainer->name }}</td>
                                        <td>{{ $training->trainer->Specification }}</td>
                                        <td>{{ $training->type_course == 1?"individual":"Company" }}</td>
                                        <td>{{ $training->type_course == 1?"null":$training->trainees_num }}</td>
                                        <td>{{ $training->type_course == 1?"null":($training->trining_type==0?"Offline":"Online") }}</td>
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

@endsection
