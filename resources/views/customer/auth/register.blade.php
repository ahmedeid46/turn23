@extends('customer.layout.master')
@section('style')
    {{-- section style  --}}

@endsection
@section('script')
    {{-- section script  --}}

    <script>
        $('#type_customer').on('change', function() {
            $('#individual').addClass('d-none');
            $('#company').addClass('d-none');

            if(this.value == 1){
                $('#individual').removeClass('d-none');

            }else if(this.value == 2){
                $('#company').removeClass('d-none');
            }
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
                    <form method="post" action="{{ route('customer.register') }}" enctype="multipart/form-data">
                        @csrf
                        <label for="register-username">
                            Username
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

                        <label for="register-file">
                            User Type
                            <span class="required">*</span>
                        </label>
                        <select class="form-control form-select" name="type_customer" id="type_customer">
                            <option>Please Select your Type</option>
                            <option value="1">Individual</option>
                            <option value="2">Company</option>
                            <option value="3">Training</option>
                        </select>
                        <div id="company" class="d-none">
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
                        <div class="form-footer mb-2">
                            <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main><!-- End .main -->

@endsection
