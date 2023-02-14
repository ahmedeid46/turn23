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
                                    <th>Main Category</th>
                                    <th>Main Sub Category</th>
                                    <th>status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subCats as $subcat)
                                    <tr>
                                        <td>{{ $subcat->title }}</td>
                                        <td>
                                            @if($subcat->cat_id == null)
                                                {{ $subcat->subCatReverse->cat->title }}
                                            @else
                                                {{ $subcat->cat->title }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($subcat->sub_cat_id != null)
                                                {{ $subcat->subCatReverse->title }}
                                            @else
                                                NULL
                                            @endif
                                        </td>

                                        <td><span class="alert {{  $subcat->status == 1?"alert-success":"alert-danger" }}">{{ $subcat->status == 1?"Active":"Disable" }}</span></td>
                                        <td>
                                            <a href="{{ route('admin.permission.sub.cat.status.inverse',$subcat->id) }}" class="btn {{  $subcat->status == 1?"btn-danger":"btn-success" }}">{{  $subcat->status == 1?"Disable":"Active" }}</a>
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
