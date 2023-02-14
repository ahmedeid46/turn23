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
                        <h4 class="card-title">Groups</h4>
                        <div class="view-options d-flex">
                            <div style="width: 100%" class="btn-group dropdown-sort">
                                <a style="width: 35%" href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#large">Add Group</a>
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
                                <th>Group trainer name</th>
                                <th>Specification</th>
                                <th>Location</th>
                                <th>Number Of Trainee</th>
                                <th>Number Of Session</th>
                                <th>Complete Session</th>
                                <th>Starting Date</th>
                                <th>Ending Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                           @foreach($groups as $group)
                                <tr>
                                    <td>{{ $group->seller->name }}</td>
                                    <td>{{ $group->seller->Specialization }}</td>
                                    <td>{{ $group->seller->type_cource == 1?'online':($group->seller->work_space == 1?$group->seller->location:"") }}</td>
                                    <td>{{ count($group->training) }}</td>
                                    <td>{{ $group->num_session }}</td>
                                    <td>{{ $group->num_complete_session	 }}</td>
                                    <td>{{ $group->start_date }}</td>
                                    <td>{{ $group->end_date }}</td>
                                    <td>
                                    <form id="deleteForm-{{ $group->id }}" action="{{ route('admin.training.delete.group') }}" method="post">
                                        <input type="hidden" name="group_id" value="{{ $group->id }}" >
                                    </form>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Edit-{{ $group->id }}">
                                        <i data-feather="eye" class="me-50"></i>
                                        <span>Edit</span>
                                    </button>

                                    <button onclick="if(confirm('Sure , are you need Delete this Group'))$('#deleteForm-{{ $group->id }}').submit" class="btn btn-danger">
                                        <i data-feather="eye" class="me-50"></i>
                                        <span>Delete</span>
                                    </button>

                                    <div class="modal fade text-start" id="Edit-{{ $group->id }}" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel17">Add Group</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="post" action="{{ route('admin.training.update.group') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-1">
                                                            <label class="form-label">Group name</label>
                                                            <input type="text" name="name" class="form-control"/>
                                                        </div>
                                                        <div class="mb-1">
                                                            <label class="form-label">Group date</label>
                                                            <input type="datetime-local" name="date" class="form-control"/>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Edit</button>
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
                <h4 class="modal-title" id="myModalLabel17">Add Group</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('admin.training.create.group') }}">
                @csrf
                <div class="modal-body">


                    <div class="mb-1">
                        <label class="form-label" for="selectTrainer">Select Trainer</label>
                        <select class="form-select" name="seller" id="selectTrainer">
                            <option selected>Please Select Trainer</option>
                            @foreach($trainers as $trainer)
                                @foreach(json_decode($trainer->cat_id) as $cat)
                                    @if($cat == 5)
                                        <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Start Date</label>
                        <input type="datetime-local" name="start_date" class="form-control"/>
                    </div>
                    <div class="mb-1">
                        <label class="form-label">End Date</label>
                        <input type="datetime-local" name="end_date" class="form-control"/>
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Num Of Session</label>
                        <input type="number" name="num_session" class="form-control"/>
                    </div>
                    <div class="mb-1" id="location">

                    </div>
                    @foreach($trainers as $trainer)
                        <div class="mb-1 trainers d-none" id ="trainer-{{$trainer->id}}">
                            <h4>Users</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Trainees Number</th>
                                        <th>Online / Offline</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($trainees as $trainee)
                                        @if($trainer->id == $trainee->seller_id)
                                            <tr>
                                                <td><input class="form-check-input" type="checkbox" name="training_ids[]" value="{{ $trainee->id }}"></td>
                                                <td>{{ $trainee->customer->name }}</td>
                                                <th>{{ $trainee->type_course == 1?'Individual':"Company" }}</th>
                                                <td>{{ $trainee->type_course == 1?'Null':$trainee->trainees_num }}</td>
                                                <td>{{ $trainee->type_course == 1?'Null':($trainee->trining_type == 0?'Offline':"Online") }}</td>
                                                <td>{{ $trainee->type_course == 1?'Null':$trainee->start_date }}</td>
                                                <td>{{ $trainee->type_course == 1?'Null':$trainee->end_date }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    @endforeach

            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
