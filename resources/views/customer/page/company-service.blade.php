@extends('customer.layout.master')
@section('style')
<style>
    /*!
 * Datepicker for Bootstrap v1.5.0 (https://github.com/eternicode/bootstrap-datepicker)
 *
 * Copyright 2012 Stefan Petre
 * Improvements by Andrew Rowls
 * Licensed under the Apache License v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 */
    .datepicker {
        padding: 4px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        direction: ltr;
    }
    .datepicker-inline {
        width: 220px;
    }
    .datepicker.datepicker-rtl {
        direction: rtl;
    }
    .datepicker.datepicker-rtl table tr td span {
        float: right;
    }
    .datepicker-dropdown {
        top: 0;
        left: 0;
    }
    .datepicker-dropdown:before {
        content: '';
        display: inline-block;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-bottom: 7px solid #999999;
        border-top: 0;
        border-bottom-color: rgba(0, 0, 0, 0.2);
        position: absolute;
    }
    .datepicker-dropdown:after {
        content: '';
        display: inline-block;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-bottom: 6px solid #ffffff;
        border-top: 0;
        position: absolute;
    }
    .datepicker-dropdown.datepicker-orient-left:before {
        left: 6px;
    }
    .datepicker-dropdown.datepicker-orient-left:after {
        left: 7px;
    }
    .datepicker-dropdown.datepicker-orient-right:before {
        right: 6px;
    }
    .datepicker-dropdown.datepicker-orient-right:after {
        right: 7px;
    }
    .datepicker-dropdown.datepicker-orient-bottom:before {
        top: -7px;
    }
    .datepicker-dropdown.datepicker-orient-bottom:after {
        top: -6px;
    }
    .datepicker-dropdown.datepicker-orient-top:before {
        bottom: -7px;
        border-bottom: 0;
        border-top: 7px solid #999999;
    }
    .datepicker-dropdown.datepicker-orient-top:after {
        bottom: -6px;
        border-bottom: 0;
        border-top: 6px solid #ffffff;
    }
    .datepicker > div {
        display: none;
    }
    .datepicker table {
        margin: 0;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .datepicker td,
    .datepicker th {
        text-align: center;
        width: 20px;
        height: 20px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        border: none;
    }
    .table-striped .datepicker table tr td,
    .table-striped .datepicker table tr th {
        background-color: transparent;
    }
    .datepicker table tr td.day:hover,
    .datepicker table tr td.day.focused {
        background: #eeeeee;
        cursor: pointer;
    }
    .datepicker table tr td.old,
    .datepicker table tr td.new {
        color: #999999;
    }
    .datepicker table tr td.disabled,
    .datepicker table tr td.disabled:hover {
        background: none;
        color: #999999;
        cursor: default;
    }
    .datepicker table tr td.highlighted {
        background: #d9edf7;
        border-radius: 0;
    }
    .datepicker table tr td.today,
    .datepicker table tr td.today:hover,
    .datepicker table tr td.today.disabled,
    .datepicker table tr td.today.disabled:hover {
        background-color: #fde19a;
        background-image: -moz-linear-gradient(to bottom, #fdd49a, #fdf59a);
        background-image: -ms-linear-gradient(to bottom, #fdd49a, #fdf59a);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fdd49a), to(#fdf59a));
        background-image: -webkit-linear-gradient(to bottom, #fdd49a, #fdf59a);
        background-image: -o-linear-gradient(to bottom, #fdd49a, #fdf59a);
        background-image: linear-gradient(to bottom, #fdd49a, #fdf59a);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fdd49a', endColorstr='#fdf59a', GradientType=0);
        border-color: #fdf59a #fdf59a #fbed50;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        color: #000;
    }
    .datepicker table tr td.today:hover,
    .datepicker table tr td.today:hover:hover,
    .datepicker table tr td.today.disabled:hover,
    .datepicker table tr td.today.disabled:hover:hover,
    .datepicker table tr td.today:active,
    .datepicker table tr td.today:hover:active,
    .datepicker table tr td.today.disabled:active,
    .datepicker table tr td.today.disabled:hover:active,
    .datepicker table tr td.today.active,
    .datepicker table tr td.today:hover.active,
    .datepicker table tr td.today.disabled.active,
    .datepicker table tr td.today.disabled:hover.active,
    .datepicker table tr td.today.disabled,
    .datepicker table tr td.today:hover.disabled,
    .datepicker table tr td.today.disabled.disabled,
    .datepicker table tr td.today.disabled:hover.disabled,
    .datepicker table tr td.today[disabled],
    .datepicker table tr td.today:hover[disabled],
    .datepicker table tr td.today.disabled[disabled],
    .datepicker table tr td.today.disabled:hover[disabled] {
        background-color: #fdf59a;
    }
    .datepicker table tr td.today:active,
    .datepicker table tr td.today:hover:active,
    .datepicker table tr td.today.disabled:active,
    .datepicker table tr td.today.disabled:hover:active,
    .datepicker table tr td.today.active,
    .datepicker table tr td.today:hover.active,
    .datepicker table tr td.today.disabled.active,
    .datepicker table tr td.today.disabled:hover.active {
        background-color: #fbf069 \9;
    }
    .datepicker table tr td.today:hover:hover {
        color: #000;
    }
    .datepicker table tr td.today.active:hover {
        color: #fff;
    }
    .datepicker table tr td.range,
    .datepicker table tr td.range:hover,
    .datepicker table tr td.range.disabled,
    .datepicker table tr td.range.disabled:hover {
        background: #eeeeee;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
    }
    .datepicker table tr td.range.today,
    .datepicker table tr td.range.today:hover,
    .datepicker table tr td.range.today.disabled,
    .datepicker table tr td.range.today.disabled:hover {
        background-color: #f3d17a;
        background-image: -moz-linear-gradient(to bottom, #f3c17a, #f3e97a);
        background-image: -ms-linear-gradient(to bottom, #f3c17a, #f3e97a);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f3c17a), to(#f3e97a));
        background-image: -webkit-linear-gradient(to bottom, #f3c17a, #f3e97a);
        background-image: -o-linear-gradient(to bottom, #f3c17a, #f3e97a);
        background-image: linear-gradient(to bottom, #f3c17a, #f3e97a);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f3c17a', endColorstr='#f3e97a', GradientType=0);
        border-color: #f3e97a #f3e97a #edde34;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
    }
    .datepicker table tr td.range.today:hover,
    .datepicker table tr td.range.today:hover:hover,
    .datepicker table tr td.range.today.disabled:hover,
    .datepicker table tr td.range.today.disabled:hover:hover,
    .datepicker table tr td.range.today:active,
    .datepicker table tr td.range.today:hover:active,
    .datepicker table tr td.range.today.disabled:active,
    .datepicker table tr td.range.today.disabled:hover:active,
    .datepicker table tr td.range.today.active,
    .datepicker table tr td.range.today:hover.active,
    .datepicker table tr td.range.today.disabled.active,
    .datepicker table tr td.range.today.disabled:hover.active,
    .datepicker table tr td.range.today.disabled,
    .datepicker table tr td.range.today:hover.disabled,
    .datepicker table tr td.range.today.disabled.disabled,
    .datepicker table tr td.range.today.disabled:hover.disabled,
    .datepicker table tr td.range.today[disabled],
    .datepicker table tr td.range.today:hover[disabled],
    .datepicker table tr td.range.today.disabled[disabled],
    .datepicker table tr td.range.today.disabled:hover[disabled] {
        background-color: #f3e97a;
    }
    .datepicker table tr td.range.today:active,
    .datepicker table tr td.range.today:hover:active,
    .datepicker table tr td.range.today.disabled:active,
    .datepicker table tr td.range.today.disabled:hover:active,
    .datepicker table tr td.range.today.active,
    .datepicker table tr td.range.today:hover.active,
    .datepicker table tr td.range.today.disabled.active,
    .datepicker table tr td.range.today.disabled:hover.active {
        background-color: #efe24b \9;
    }
    .datepicker table tr td.selected,
    .datepicker table tr td.selected:hover,
    .datepicker table tr td.selected.disabled,
    .datepicker table tr td.selected.disabled:hover {
        background-color: #9e9e9e;
        background-image: -moz-linear-gradient(to bottom, #b3b3b3, #808080);
        background-image: -ms-linear-gradient(to bottom, #b3b3b3, #808080);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#b3b3b3), to(#808080));
        background-image: -webkit-linear-gradient(to bottom, #b3b3b3, #808080);
        background-image: -o-linear-gradient(to bottom, #b3b3b3, #808080);
        background-image: linear-gradient(to bottom, #b3b3b3, #808080);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b3b3b3', endColorstr='#808080', GradientType=0);
        border-color: #808080 #808080 #595959;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        color: #fff;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    }
    .datepicker table tr td.selected:hover,
    .datepicker table tr td.selected:hover:hover,
    .datepicker table tr td.selected.disabled:hover,
    .datepicker table tr td.selected.disabled:hover:hover,
    .datepicker table tr td.selected:active,
    .datepicker table tr td.selected:hover:active,
    .datepicker table tr td.selected.disabled:active,
    .datepicker table tr td.selected.disabled:hover:active,
    .datepicker table tr td.selected.active,
    .datepicker table tr td.selected:hover.active,
    .datepicker table tr td.selected.disabled.active,
    .datepicker table tr td.selected.disabled:hover.active,
    .datepicker table tr td.selected.disabled,
    .datepicker table tr td.selected:hover.disabled,
    .datepicker table tr td.selected.disabled.disabled,
    .datepicker table tr td.selected.disabled:hover.disabled,
    .datepicker table tr td.selected[disabled],
    .datepicker table tr td.selected:hover[disabled],
    .datepicker table tr td.selected.disabled[disabled],
    .datepicker table tr td.selected.disabled:hover[disabled] {
        background-color: #808080;
    }
    .datepicker table tr td.selected:active,
    .datepicker table tr td.selected:hover:active,
    .datepicker table tr td.selected.disabled:active,
    .datepicker table tr td.selected.disabled:hover:active,
    .datepicker table tr td.selected.active,
    .datepicker table tr td.selected:hover.active,
    .datepicker table tr td.selected.disabled.active,
    .datepicker table tr td.selected.disabled:hover.active {
        background-color: #666666 \9;
    }
    .datepicker table tr td.active,
    .datepicker table tr td.active:hover,
    .datepicker table tr td.active.disabled,
    .datepicker table tr td.active.disabled:hover {
        background-color: #006dcc;
        background-image: -moz-linear-gradient(to bottom, #0088cc, #0044cc);
        background-image: -ms-linear-gradient(to bottom, #0088cc, #0044cc);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0044cc));
        background-image: -webkit-linear-gradient(to bottom, #0088cc, #0044cc);
        background-image: -o-linear-gradient(to bottom, #0088cc, #0044cc);
        background-image: linear-gradient(to bottom, #0088cc, #0044cc);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0088cc', endColorstr='#0044cc', GradientType=0);
        border-color: #0044cc #0044cc #002a80;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        color: #fff;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    }
    .datepicker table tr td.active:hover,
    .datepicker table tr td.active:hover:hover,
    .datepicker table tr td.active.disabled:hover,
    .datepicker table tr td.active.disabled:hover:hover,
    .datepicker table tr td.active:active,
    .datepicker table tr td.active:hover:active,
    .datepicker table tr td.active.disabled:active,
    .datepicker table tr td.active.disabled:hover:active,
    .datepicker table tr td.active.active,
    .datepicker table tr td.active:hover.active,
    .datepicker table tr td.active.disabled.active,
    .datepicker table tr td.active.disabled:hover.active,
    .datepicker table tr td.active.disabled,
    .datepicker table tr td.active:hover.disabled,
    .datepicker table tr td.active.disabled.disabled,
    .datepicker table tr td.active.disabled:hover.disabled,
    .datepicker table tr td.active[disabled],
    .datepicker table tr td.active:hover[disabled],
    .datepicker table tr td.active.disabled[disabled],
    .datepicker table tr td.active.disabled:hover[disabled] {
        background-color: #0044cc;
    }
    .datepicker table tr td.active:active,
    .datepicker table tr td.active:hover:active,
    .datepicker table tr td.active.disabled:active,
    .datepicker table tr td.active.disabled:hover:active,
    .datepicker table tr td.active.active,
    .datepicker table tr td.active:hover.active,
    .datepicker table tr td.active.disabled.active,
    .datepicker table tr td.active.disabled:hover.active {
        background-color: #003399 \9;
    }
    .datepicker table tr td span {
        display: block;
        width: 23%;
        height: 54px;
        line-height: 54px;
        float: left;
        margin: 1%;
        cursor: pointer;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
    }
    .datepicker table tr td span:hover {
        background: #eeeeee;
    }
    .datepicker table tr td span.disabled,
    .datepicker table tr td span.disabled:hover {
        background: none;
        color: #999999;
        cursor: default;
    }
    .datepicker table tr td span.active,
    .datepicker table tr td span.active:hover,
    .datepicker table tr td span.active.disabled,
    .datepicker table tr td span.active.disabled:hover {
        background-color: #006dcc;
        background-image: -moz-linear-gradient(to bottom, #0088cc, #0044cc);
        background-image: -ms-linear-gradient(to bottom, #0088cc, #0044cc);
        background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0044cc));
        background-image: -webkit-linear-gradient(to bottom, #0088cc, #0044cc);
        background-image: -o-linear-gradient(to bottom, #0088cc, #0044cc);
        background-image: linear-gradient(to bottom, #0088cc, #0044cc);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0088cc', endColorstr='#0044cc', GradientType=0);
        border-color: #0044cc #0044cc #002a80;
        border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        color: #fff;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    }
    .datepicker table tr td span.active:hover,
    .datepicker table tr td span.active:hover:hover,
    .datepicker table tr td span.active.disabled:hover,
    .datepicker table tr td span.active.disabled:hover:hover,
    .datepicker table tr td span.active:active,
    .datepicker table tr td span.active:hover:active,
    .datepicker table tr td span.active.disabled:active,
    .datepicker table tr td span.active.disabled:hover:active,
    .datepicker table tr td span.active.active,
    .datepicker table tr td span.active:hover.active,
    .datepicker table tr td span.active.disabled.active,
    .datepicker table tr td span.active.disabled:hover.active,
    .datepicker table tr td span.active.disabled,
    .datepicker table tr td span.active:hover.disabled,
    .datepicker table tr td span.active.disabled.disabled,
    .datepicker table tr td span.active.disabled:hover.disabled,
    .datepicker table tr td span.active[disabled],
    .datepicker table tr td span.active:hover[disabled],
    .datepicker table tr td span.active.disabled[disabled],
    .datepicker table tr td span.active.disabled:hover[disabled] {
        background-color: #0044cc;
    }
    .datepicker table tr td span.active:active,
    .datepicker table tr td span.active:hover:active,
    .datepicker table tr td span.active.disabled:active,
    .datepicker table tr td span.active.disabled:hover:active,
    .datepicker table tr td span.active.active,
    .datepicker table tr td span.active:hover.active,
    .datepicker table tr td span.active.disabled.active,
    .datepicker table tr td span.active.disabled:hover.active {
        background-color: #003399 \9;
    }
    .datepicker table tr td span.old,
    .datepicker table tr td span.new {
        color: #999999;
    }
    .datepicker .datepicker-switch {
        width: 145px;
    }
    .datepicker .datepicker-switch,
    .datepicker .prev,
    .datepicker .next,
    .datepicker tfoot tr th {
        cursor: pointer;
    }
    .datepicker .datepicker-switch:hover,
    .datepicker .prev:hover,
    .datepicker .next:hover,
    .datepicker tfoot tr th:hover {
        background: #eeeeee;
    }
    .datepicker .cw {
        font-size: 10px;
        width: 12px;
        padding: 0 2px 0 5px;
        vertical-align: middle;
    }
    .input-append.date .add-on,
    .input-prepend.date .add-on {
        cursor: pointer;
    }
    .input-append.date .add-on i,
    .input-prepend.date .add-on i {
        margin-top: 3px;
    }
    .input-daterange input {
        text-align: center;
    }
    .input-daterange input:first-child {
        -webkit-border-radius: 3px 0 0 3px;
        -moz-border-radius: 3px 0 0 3px;
        border-radius: 3px 0 0 3px;
    }
    .input-daterange input:last-child {
        -webkit-border-radius: 0 3px 3px 0;
        -moz-border-radius: 0 3px 3px 0;
        border-radius: 0 3px 3px 0;
    }
    .input-daterange .add-on {
        display: inline-block;
        width: auto;
        min-width: 16px;
        height: 18px;
        padding: 4px 5px;
        font-weight: normal;
        line-height: 18px;
        text-align: center;
        text-shadow: 0 1px 0 #ffffff;
        vertical-align: middle;
        background-color: #eeeeee;
        border: 1px solid #ccc;
        margin-left: -5px;
        margin-right: -5px;
    }

</style>

@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script>
    $('.date').datepicker({
        multidate: true,
        format: 'dd-mm-yyyy'
    });
</script>
@endsection
@section('popup')

@endsection
@section('content')
    <main class="main">
        <section class="new-products-section">
            <h2 class="section-title categories-section-title heading-border border-0 ls-0 appear-animate" data-animation-delay="100" data-animation-name="fadeInUpShorter">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Request a Service
                </button>
            </h2>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('customer.service.add') }}" enctype="multipart/form-data" method="post">
                        <div class="modal-body">
                                @csrf
                                <input hidden name="sub_cat_id" value="{{ $sub_cat_id[0] }}">
                                <label for="register-file">
                                    Drawing
                                    <span class="required">*</span>
                                </label>
                                <input type="file" name="drawing" class="form-input form-wide" id="register-file" required />

                                <label for="register-file">
                                    B.O.Q
                                    <span class="required">*</span>
                                </label>
                                <input type="file" name="boq" class="form-input form-wide" id="register-file" required />

                                <label for="register-file">
                                    Vendor List
                                    <span class="required">*</span>
                                </label>
                                <input type="file" name="vendorlist" class="form-input form-wide" id="register-file" required />

                                <label for="register-file">
                                    Project Specification
                                    <span class="required">*</span>
                                </label>
                                <input type="file" name="project_specification" class="form-input form-wide" id="register-file" required />

                                <label for="register-file">
                                    Specs
                                    <span class="required">*</span>
                                </label>
                                <input type="file" name="specs" class="form-input form-wide" id="register-file" required />

                                <label for="register-file">
                                    Other
                                    <span class="required">*</span>
                                </label>
                                <input type="file" name="other" class="form-input form-wide" id="register-file" required />

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Request</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="container">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Service Code</th>
                    <th scope="col">Progress</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
               @foreach($services as $service)
                <tr>
                    <td>{{ $service->code }}</td>
                    @if($service->status == 0)
                        <td>IN Review</td>
                        <td>
                            <div class="action">
                                <form method="post" action="{{ route('customer.service.update') }}">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                    <input type="hidden" name="type" value="cancel">
                                    <button type="submit" class="btn btn-secondary">Cancel</button>
                                </form>
                            </div>
                        </td>
                    @elseif($service->status == 1)
                        <td>Accept Please select priceList</td>
                        <td>
                            <div class="action">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#show{{ $service->id }}">Download price  list</button>
                                <div class="modal fade" id="show{{ $service->id }}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel2">Add rate</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                                <div class="modal-body">
                                                    @if($catService != null)
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">Price List Code</th>
                                                                <th scope="col">File</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($service->price_lists as $price_list)
                                                                <tr>
                                                                    <td>{{ $price_list->code }}</td>
                                                                    <td><a href="{{ route('admin.service.file',['price',$price_list->files]) }}" class="btn btn-secondary">Download</a></td>
                                                                    <td>
                                                                        <form method="post" action="{{ route('customer.service.select.price.list') }}">
                                                                            @csrf
                                                                            <input type="hidden" name="priceList" value="{{ $price_list->id }}">
                                                                            <input type="hidden" name="service" value="{{ $service->id }}">
                                                                            <button type="submit" class="btn btn-primary">Accept</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>

                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    @endif
                                                    @if($catManpower != null)
                                                        <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Price List Code</th>
                                                            <th scope="col">Start Date</th>
                                                            <th scope="col">Duration</th>
                                                            <th scope="col">Residence</th>
                                                            <th scope="col">Transport</th>
                                                            <th scope="col">File</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($service->price_lists as $price_list)
                                                        <tr>
                                                            <td>{{ $price_list->code }}</td>
                                                            <td>{{ $price_list->start_date }}</td>
                                                            <td>{{ $price_list->duration }} Day</td>
                                                            <td>
                                                                @if($price_list->residence == 1)
                                                                    Full accommodation on the Customer
                                                                @elseif($price_list->residence == 2)
                                                                    Accommodation from the attached price list
                                                                @elseif($price_list->residence == 3)
                                                                    There is no accommodation
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($price_list->transportation == 1)
                                                                    Internal only
                                                                @elseif($price_list->transportation == 2)
                                                                    Internal And External
                                                                @endif
                                                            </td>
                                                            <td><a href="{{ route('admin.service.file',['price',$price_list->files]) }}" class="btn btn-secondary">Download</a></td>
                                                            <td>
                                                                <form method="post" action="{{ route('customer.service.select.price.list') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="priceList" value="{{ $price_list->id }}">
                                                                    <input type="hidden" name="service" value="{{ $service->id }}">
                                                                    <button type="submit" class="btn btn-primary">Accept</button>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Request</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    @elseif($service->status == 2)
                        <td>IN Process</td>
                        <td>
                            <div class="action">
                                <form method="post" id="cancelForm" action="{{ route('customer.service.update') }}">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                    <input type="hidden" name="type" value="cancel">
                                </form>
                                <form method="post" id="startForm" action="{{ route('customer.service.start') }}">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                </form>
                                <button onclick="$('#startForm').submit()" class="btn btn-primary">Start</button>
                                <button onclick="$('#cancelForm').submit()" class="btn btn-secondary">Cancel</button>
                            </div>
                        </td>
                        @elseif($service->status == 10)
                        <td>Under Implementation</td>
                        <td>
                            <div class="row action">
                                <form method="post" id="startForm" action="{{ route('customer.service.complete') }}">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                    <input type="text" name="attendance" class="form-control date" placeholder="Pick the multiple dates">
                                    <button type="submit" class="btn btn-success">Complete</button>
                                </form>
                            </div>
                        </td>
                    @elseif($service->status == 3)
                        <td>Complete</td>
                        <td>
                            @if($service->rate == null)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Rate{{ $service->id }}">
                                Add Rate
                            </button>
                            @endif
                            <div class="action">
                                <form method="post" action="{{ route('customer.service.update') }}">
                                    @csrf
                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                    <input type="hidden" name="type" value="cancel">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                            </div>
                        </td>
                        <div class="modal fade" id="Rate{{ $service->id }}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel2">Add rate</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('customer.service.rate') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                                        <div class="modal-body">
                                                <label for="exampleFormControlTextarea1" class="form-label">Add rate</label>
                                                <textarea class="form-control" name="rate" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Request</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @elseif($service->status == -1)
                        <td>Block</td>
                        <td>
                            <div class="action">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reason{{ $service->id }}">
                                    View Reason
                                </button>
                            </div>
                        </td>
                        <div class="modal fade" id="reason{{ $service->id }}" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel2">View Reason</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                            <p>{{ $service->decline_reason }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </tr>
               @endforeach
                </tbody>
            </table>
        </section>
    </main>
    <!-- End .main -->
@endsection
