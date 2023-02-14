<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

    <meta name="description" content=" ">

    <meta name="keywords" content=" ">

    <meta name="author" content="joinus">

    <title>Vendor - Admin Login</title>

    <link rel="apple-touch-icon" href="{{ asset('assets/admin') }}/images/logo/logo.png">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin') }}/images/logo/logo.png">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/vendors/css/vendors.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/bootstrap-extended.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/colors.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/components.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/themes/dark-layout.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/themes/bordered-layout.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/themes/semi-dark-layout.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/core/menu/menu-types/vertical-menu.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/plugins/forms/form-validation.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/pages/authentication.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/style.css">

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-basic px-2">
                <div class="auth-inner my-2">
                    <!-- Login basic -->
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="index.html" class="brand-logo">
                                <img src="{{ asset('assets/admin') }}/images/logo/logo.png">
                                <h2 class="brand-text text-primary ms-1">Vendor</h2>
                            </a>

                            <h4 class="card-title mb-1">Welcome Admin! 👋</h4>
                            <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>

                            <form class="auth-login-form mt-2" action="{{ route('admin.login') }}" method="POST">
                                @csrf
                                <div class="mb-1">
                                    <label for="login-email" class="form-label">Email</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="login-email"
                                        name="email"
                                        placeholder="Enter Your E-Mail"
                                        aria-describedby="login-email"
                                        tabindex="1"
                                        autofocus
                                    />
                                </div>

                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="login-password">Password</label>

                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input
                                            type="password"
                                            class="form-control form-control-merge"
                                            id="login-password"
                                            name="password"
                                            tabindex="2"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="login-password"
                                        />
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input" name="remember" type="checkbox" id="remember-me" tabindex="3" />
                                        <label class="form-check-label" for="remember-me"> Remember Me </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100" tabindex="4">Sign in</button>
                            </form>
                        </div>
                    </div>
                    <!-- /Login basic -->
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="{{ asset('assets/admin') }}/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('assets/admin') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('assets/admin') }}/js/core/app-menu.min.js"></script>
<script src="{{ asset('assets/admin') }}/js/core/app.min.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('assets/admin') }}/js/scripts/pages/auth-login.js"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load',  function(){
        if (feather) {
            feather.replace({ width: 14, height: 14 });
        }
    })
</script>
</body>
<!-- END: Body-->
</html>
