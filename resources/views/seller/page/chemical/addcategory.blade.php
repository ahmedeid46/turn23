@extends('seller.layout.master')
@section('styles')
    <script src="https://cdn.tiny.cloud/1/k67muxw3mzvvatu92oknpiro2scq6utm5ftliqt6feq3ikjw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
@section('script')
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: ' advcode casechange export formatpainter  editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
            toolbar: '   casechange checklist code permanentpen table tableofcontents',
            toolbar_mode: 'floating',
            menubar: false,
            tinycomments_mode: 'embedded',
            tinycomments_author: '{{ env('app_name') }}',
        });
    </script>
@endsection
@section('content')

    <main class="main">
        <div class="category-banner-container bg-gray">
            <div class="category-banner banner text-uppercase" style="background: no-repeat 60%/cover url('assets/images/banners/banner-top.jpg');">
                <div class="container position-relative">
                    <div class="row">
                        <div class="pl-lg-5 pb-5 pb-md-0 col-sm-5 col-xl-4 col-lg-4 offset-1">
                            <h3>Chose<br>Your Products</h3>
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
                            <button style="width: 300px;height: 41px;" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Products</button>

                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form>
                                            <div style="height: 500px;" class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class='c-filter'>
                                                                <div style="width: 100% !important" class='c-filter__toggle'>Chose your Products</div>
                                                                <ul class='c-filter__ul'>
                                                                    <li class='c-filter__item'><input type='checkbox' id='1'><label tabindex='-1' for='1'>Option 1</label></li>
                                                                    <li class='c-filter__item'><input type='checkbox' id='2'><label tabindex='-1' for='2'>Option 2</label></li>
                                                                    <li class='c-filter__item'><input type='checkbox' id='3'><label tabindex='-1' for='3'>Option 3</label></li>
                                                                    <li class='c-filter__item'><input type='checkbox' id='4'><label tabindex='-1' for='4'>Option 4</label></li>
                                                                    <li class='c-filter__item'><input type='checkbox' id='5'><label tabindex='-1' for='5'>Option 5</label></li>
                                                                    <li class='c-filter__item'><input type='checkbox' id='6'><label tabindex='-1' for='6'>Option 6</label></li>
                                                                    <li class='c-filter__item' ><input type='checkbox' id='7'><label tabindex='-1' for='7'>Option 7</label></li>
                                                                    <li class='c-filter__item'><input type='checkbox' id='8'><label tabindex='-1' for='8'>Option 8</label></li>
                                                                    <li class='c-filter__item'><input type='checkbox' id='9'><label tabindex='-1' for='9'>Option 9</label></li>
                                                                    <li class='c-filter__item'><input type='checkbox' id='10'><label tabindex='-1'                for='10'>Option 10</label></li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- End .toolbox-right -->
                    </nav>

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog-section row">
                                    <div class="col-md-6 col-lg-4">
                                        <article class="post">
                                            <div class="post-media">
                                                <a href="products.html">
                                                    <img src="assets/images/1.png" alt="Post" width="225" height="280">
                                                </a>
                                                <div class="post-date">
                                                    <span>Chemical Category</span>
                                                </div>
                                            </div><!-- End .post-media -->

                                            <div STYLE="text-align: center" class="post-body">
                                                <h2 class="post-title">
                                                    <a href="products.html">Category Name</a>
                                                </h2>
                                                <button onclick="window.location.href='products.html'" class="btn btn-success btn-rounded btn-md"> <= Products =></button>
                                            </div><!-- End .post-body -->
                                        </article><!-- End .post -->
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <article class="post">
                                            <div class="post-media">
                                                <a href="products.html">
                                                    <img src="assets/images/1.png" alt="Post" width="225" height="280">
                                                </a>
                                                <div class="post-date">
                                                    <span>Chemical Category</span>
                                                </div>
                                            </div><!-- End .post-media -->

                                            <div STYLE="text-align: center" class="post-body">
                                                <h2 class="post-title">
                                                    <a href="products.html">Category Name</a>
                                                </h2>
                                                <button onclick="window.location.href='products.html'" class="btn btn-success btn-rounded btn-md"> <= Products =></button>
                                            </div><!-- End .post-body -->
                                        </article><!-- End .post -->
                                    </div>
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
@endSection
