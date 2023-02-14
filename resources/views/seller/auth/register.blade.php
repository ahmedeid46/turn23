@extends('customer.layout.master')
@section('style')
    {{-- section style  --}}

@endsection
@section('script')
    {{-- section script  --}}
        <script>

            $('#cat').on('change',function(){
                var selected = [...this.options]
                    .filter(option => option.selected)
                    .map(option => option.value);
                console.log(selected);
                $('#company').addClass('d-none');
                 $('#manpower').addClass('d-none');
                 $('#trainer').addClass('d-none');
                for (let i=0;i<selected.length;i++){
                    switch (selected[i]) {
                        case '1':
                            $('#company').removeClass('d-none');
                            console.log('you chose cat by id = '+selected[i]);
                            break;
                        case '2':
                            $('#company').removeClass('d-none');
                            console.log('you chose cat by id = '+selected[i]);
                            break;
                        case '3':
                            $('#company').removeClass('d-none');
                            console.log('you chose cat by id = '+selected[i]);
                            break;
                        case '4':
                            $('#manpower').removeClass('d-none');
                            console.log('you chose cat by id = '+selected[i]);
                            break;
                        case '5':
                            $('#trainer').removeClass('d-none');
                            console.log('you chose cat by id = '+selected[i]);
                            break;
                        default:
                            console.log('please chose the correct category');
                    }
                }
                // let cat_id = $(this).val()
                //

            });
        </script>

@endsection
@section('content')
    {{-- section start content  --}}
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('customer.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Register
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>User Register</h1>

            </div>
        </div>

        <div class="container login-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-1">
                        <h2 class="title">Register</h2>
                    </div>
                    @if($errors->any())
                        {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif
                    {{-- section Form  --}}
                    <form method="post" action="{{ route('seller.register') }}" enctype="multipart/form-data">
                        @csrf
                        <label for="register-username">
                            Name
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="name" class="form-input form-wide" id="register-username" required />

                        <label for="register-email">
                            Email address
                            <span class="required">*</span>
                        </label>
                        <input type="email" name="email" class="form-input form-wide" id="register-email" required />

                        <label for="register-phone">
                            Phone Number
                            <span class="required">*</span>
                        </label>
                        <input type="number" name="phone" class="form-input form-wide" id="register-phone" required />

                        <label for="register-password">
                            Password
                            <span class="required">*</span>
                        </label>
                        <input type="password" name="password" class="form-input form-wide" id="register-password"
                               required />
                        <label for="register-password">
                            Confirm Password
                            <span class="required">*</span>
                        </label>
                        <input type="password" name="password_confirmation" class="form-input form-wide" id="register-password"
                               required />
                        <label for="register-linkedin"> LinkedIn Profile</label>
                        <input class="form-input form-wide" type="text" id="register-linkedin" name="linkedin" placeholder="LinkedIn Profile Link">
                        <label>Select Category</label>
                        <span class="required">*</span>
                        <div class="select-custom">
                            <select id="cat" name="cat" class="form-control form-control-sm" multiple required>
                                <option selected>Select Category</option>
                                @foreach($cats as $cat)
                                    <option id="cat" value="{{ $cat->id }}">{{ $cat->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-none" id="company">
                            <label for="register-website">website</label>
                            <input class="form-input form-wide" id="register-website" type="text" name="website" placeholder="Website Link">
                            <label for="register-file">
                                Registration certificate
                                <span class="required">*</span>
                            </label>
                            <input type="file" name="registration_certificate" class="form-input form-wide" id="register-file"  />

                            <label for="register-file">
                                Tax card
                                <span class="required">*</span>
                            </label>
                            <input type="file" name="tax_card" class="form-input form-wide" id="register-file"  />

                            <label for="register-file">
                                Vat certificate
                                <span class="required">*</span>
                            </label>
                            <input type="file" name="vat_cert" class="form-input form-wide" id="register-file"  />

                            <label for="register-file">
                                Invoice certificate(not more than three months back)
                                <span class="required">*</span>
                            </label>
                            <input type="file" name="invoice" class="form-input form-wide" id="register-file"  />

                            <label for="register-file">
                                Company delegated persone and delgation letter
                                <span class="required">*</span>
                            </label>
                            <input type="file" name="delegation" class="form-input form-wide" id="register-file"  />


                            <label for="register-file">
                                Reference list
                                <span class="required">*</span>
                            </label>
                            <input type="file" name="reference_list" class="form-input form-wide" id="register-file"  />
                        </div>
                        <div class="d-none" id="manpower">
                            <label for="register-file">
                                CV
                                <span class="required">*</span>
                            </label>
                            <input type="file" name="cv" class="form-input form-wide" id="register-file"  />
                            <label for="register-file">
                            Documentation
                            <span class="required">*</span>
                            </label>
                            <input type="file" multiple name="docs[]" class="form-input form-wide" id="register-file"  />

                        </div>
                        <div class="d-none" id="trainer">
                            <label for="register-file">
                                Documentation
                                <span class="required">*</span>
                            </label>
                            <input type="file" multiple name="docs[]" class="form-input form-wide" id="register-file"  />
                            <label for="register-username">
                                Price (EGP)
                                <span class="required">*</span>
                            </label>
                            <input type="number" min="0" step="0.01" name="price" class="form-input form-wide" id="price"  />

                            <label for="register-username">
                                Price Ber ( Session ,Hours ,Day or all Course,.....,etc )
                                <span class="required">*</span>
                            </label>
                            <input type="text" name="price_type" class="form-input form-wide" />

                            <label for="register-username">
                                online or offline
                                <span class="required">*</span>
                            </label>
                            <select class="form-control form-select" name="on_of">
                                <option value="1">Online</option>
                                <option value="0">Offline</option>
                            </select>
                            <label for="register-username">
                                Specialization
                                <span class="required">*</span>
                            </label>
                            <input type="text" name="Specialization" class="form-input form-wide" />
                            <label>Min Number of Trainees</label>
                            <input type="number" class="form-input form-wide" name="min_num_trainees" placeholder="Min Number of Trainees">

                            <label>Start Date</label>
                            <input type="datetime-local" class="form-input form-wide" name="start_date" placeholder="Start Date">

                            <label>End Date</label>
                            <input type="datetime-local" class="form-input form-wide" name="end_date" placeholder="End Date">

                        </div>

                        <div class="form-footer mb-2">
                            <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                                Register
                            </button>
                        </div>
                        <h5>I'm registered before I want to <a href="{{ route('seller.show.login') }}" >login</a></h5>
                    </form>
                </form>
            </div>
        </div>
    </main><!-- End .main -->

@endsection
