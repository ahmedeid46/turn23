@extends('admin.layout.master')
@section('style')

@endsection
@section('script')

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
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>title</th>
                                    <th>sub Category</th>
                                    <th>Main Category</th>
                                    <th>status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($all_products as $allproduct)
                                    <tr>
                                        <td>{{ $allproduct->name }}</td>
                                        <th>{{$allproduct->subcat->title}}</th>
                                        <td>
                                            @if($allproduct->subcat->cat_id == null)
                                                {{ $allproduct->subcat->subCatReverse->cat->title }}
                                            @else
                                                {{ $allproduct->subcat->cat->title }}
                                            @endif
                                        </td>

                                        <td><span class="alert {{  $allproduct->status == 1?"alert-success":"alert-danger" }}">{{ $allproduct->status == 1?"Active":"Disable" }}</span></td>
                                        <td>
                                            <a href="{{ route('admin.permission.all.product.status.inverse',$allproduct->id) }}" class="btn {{  $allproduct->status == 1?"btn-danger":"btn-success" }}">{{  $allproduct->status == 1?"Disable":"Active" }}</a>
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

@endsection
