@extends('admin.layout.master')
@section('style')

@endsection
@section('script')
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    window.addEventListener('load',function() {
       $('input.search-seller').on('input',function() {
           var value=$(this).val();
               $.ajax({
                   type : 'get',
                   url : '{{ route('admin.sellers.search') }}',
                   data:{'search':value},
                   success:function(data){
                       $('tbody').html(data);
                   }
               });
       })
        $('select.filter-seller').on('change',function() {
            var value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{ route('admin.sellers.filter.cat') }}',
                data:{'search':value},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })

        $('input.search-customer').on('input',function() {
            var value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{ route('admin.customer.search') }}',
                data:{'search':value},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })

   })



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
                            <h4 class="card-title">Register Permission</h4>
                            @if($type == 'seller')
                                <div class="from-group col-4">
                                    <select class="form-control form-select filter-seller">
                                    <option>filter By Category</option>
                                    <option value="1">Chemical</option>
                                    <option value="2">industrial</option>
                                    <option value="3">Service provider</option>
                                    <option value="4">manpower</option>
                                    <option value="5">trainer</option>
                                </select>
                                </div>
                                <div class="col-12">
                                    <input class="form-control search-seller" type="text" placeholder="Search..." >
                                </div>
                            @elseif($type == "customer")
                                <div class="col-12">
                                    <input class="form-control search-customer" type="text" placeholder="Search..." >
                                </div>
                            @endif

                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    @if($type == 'seller')
                                        <th>Category</th>
                                    @else
                                        <th>type</th>
                                    @endif
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                               @foreach($users as $user)
                                   @if($user->allFileStatus != 1)
                                       <tr>
                                    <td>
                                        <span class="fw-bold">{{ $user->name }}</span>
                                    </td>
                                    @if($type == 'seller')
                                    <td>@foreach($user->cats as $cat) {{ $cat->title }}, @endforeach</td>
                                    @else
                                        <td>
                                            @if($user->customer_type == 1) individual @else Company @endif
                                        </td>
                                    @endif
                                    <td>
                                        @if($user->allFileStatus == 1)
                                        <span class="badge bg-light-success">Active</span>
                                        @elseif($user->allFileStatus == 0)
                                            <span class="badge bg-light-warning">pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($type == 'seller')
                                            <a href="{{ route('admin.permission.register.seller.details',$user->id)}}">
                                                <i data-feather="eye" class="me-50"></i>
                                                <span>Show</span>
                                            </a>
                                        @elseif($type == 'customer')
                                            <a href="{{ route('admin.permission.register.customer.details',$user->id)}}">
                                                <i data-feather="eye" class="me-50"></i>
                                                <span>Show</span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                   @endif
                               @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
