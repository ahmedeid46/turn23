@extends('customer.layout.master')
@section('style')

@endsection
@section('script')
<script>
    $(document).ready(function(){
        $(".company").addClass('d-none');
        $("select").change(function(){
            $(this).find("option:selected").each(function(){
                let optionValue = $(this).attr("value");
                if(optionValue == 2){
                    $(".company").removeClass('d-none');
                } else{
                    $(".company").addClass('d-none');
                }
            });
        }).change();
    });
</script>
@endsection
@section('popup')

@endsection
@section('content')

    <main class="main">
        <div class="category-banner-container bg-gray">
            <div class="category-banner banner text-uppercase" style="background: no-repeat 60%/cover url('assets/images/banners/banner-top.jpg');">
                <div class="container position-relative">
                    <div class="row">
                        <div class="pl-lg-5 pb-5 pb-md-0 col-sm-5 col-xl-4 col-lg-4 offset-1">
                            <h3>Request Trainer</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-12 main-content">
                    <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                        <!-- End .toolbox-left -->

                        <div style="width:100%" class="toolbox-right">
                            <!-- Button trigger modal -->
                            <!-- Large modal -->

                        </div>
                        <!-- End .toolbox-right -->
                    </nav>

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{ route('customer.training.track') }}" class="btn btn-primary float-right">Track Your Training</a>
                                <div class="blog-section row">
                                    @foreach($trainers as $trainer)
                                        <div class="col-md-6 col-lg-4">
                                            <article class="post">
                                                <div class="post-media">
                                                    <a href="#">
                                                        <img style="width: 350px;height: 350px;border-radius: 50%" src="{{ asset('assets/customer') }}/images/1.png" alt="Post" width="225" height="280">
                                                    </a>
                                                    <div class="post-date">
                                                        <span>{{ $trainer->Specialization }}</span>
                                                    </div>
                                                </div><!-- End .post-media -->

                                                <div STYLE="text-align: left" class="post-body">
                                                    <h2 class="post-title">
                                                        {{ $trainer->name }}
                                                    </h2>
                                                    <ul>
                                                        <li>Price : <span>{{ $trainer->price }} EGP</span></li>
                                                        <li>online or offline : <span>{{ $trainer->type_cource == 0?"offline":"online" }}</span></li>
                                                        @if($trainer->docs != null)
                                                        @foreach(json_decode($trainer->docs) as $docs)
                                                            <li>docs : <span><a href="" class="btn btn-primary">Download</a></span></li>
                                                        @endforeach
                                                        @endif

                                                    </ul>

                                                    <button style="width: 100%;height: 41px;" type="button" class="btn btn-success btn-rounded btn-md" data-toggle="modal" data-target=".bd-example-modal-lg">Request Trainer</button>

                                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Request Trainer</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="post" action="{{ route('customer.training.request') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="seller_id" value="{{ $trainer->id }}">
                                                                    <input type="hidden" name="customer_id" value="{{ auth('customer')->user()->getAuthIdentifier() }}">
                                                                    <div style="height: 500px;" class="modal-body">
                                                                        <label for="select-cat">
                                                                            Type
                                                                            <span class="required">*</span>
                                                                        </label>
                                                                        <select class="form-input form-wide" name="type_customer"  id="select-cat">
                                                                            <option>Select an option</option>
                                                                            <option value="2">company</option>
                                                                            <option value="1">individual</option>
                                                                        </select>

                                                                        <div class="company d-none">
                                                                                <label for="register-file">
                                                                                    Number of Trainees
                                                                                    <span class="required">*</span>
                                                                                </label>
                                                                                <input type="number" class="form-input form-wide" name="num_trainees" id="register-file"  />

                                                                                <label for="register-file">
                                                                                    Start Date
                                                                                    <span class="required">*</span>
                                                                                </label>
                                                                                <input type="datetime-local" name="start_date" class="form-input form-wide" id="register-file"  />

                                                                                <label for="register-file">
                                                                                    End Date
                                                                                    <span class="required">*</span>
                                                                                </label>
                                                                                <input type="datetime-local" name="end_date" class="form-input form-wide" id="register-file" />
                                                                                <label for="register-file">
                                                                                    Type Training
                                                                                    <span class="required">*</span>
                                                                                </label>
                                                                                <br>
                                                                                <input type="radio" class="swal2-radio" name="type_training" value="0"> <label>Offline</label>
                                                                                <input type="radio" class="swal2-radio" name="type_training" value="1"> <label>Online</label>

                                                                            </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button style="width: 100%;height: 41px;" type="button" class="btn btn-success btn-rounded btn-md" data-dismiss="modal">Close</button>
                                                                        <button style="width: 100%;height: 41px;" type="submit" class="btn btn-success btn-rounded btn-md">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- End .post-body -->
                                            </article><!-- End .post -->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div>
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->

        <div class="mb-4"></div>
        <!-- margin -->
    </main>
    <!-- End .main -->
@endsection
