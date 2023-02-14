<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Vendor - Home</title>

    <meta name="keywords" content="vendor" />

    <meta name="description" content="Vendor ecommerce website">

    <meta name="author" content="ZATECH">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/customer') }}/images/icons/favicon.png">

    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '{{ asset('assets/customer') }}/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="stylesheet" href="{{ asset('assets/customer') }}/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('assets/customer') }}/css/demo4.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/customer') }}/vendor/fontawesome-free/css/all.min.css">

    <link rel="preload" href="{{ asset('assets/customer') }}/fonts/porto6e1d.woff2?64334846" as="font" type="font/ttf" crossorigin>

    <link rel="preload" href="{{ asset('assets/customer') }}/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2"
          crossorigin>

    <link rel="preload" href="{{ asset('assets/customer') }}/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font" type="font/woff2"
          crossorigin>

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/customer') }}/css/style.min.css">
    @yield('styles')
</head>

<body>
<div class="page-wrapper">
    @include('seller.layout.header')
    @yield('content')
    @include('seller.layout.footer')
    @include('seller.layout.mobile-navbar')

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>


<!-- Plugins JS File -->
<script src="{{ asset('assets/customer') }}/js/jquery.min.js"></script>
<script src="{{ asset('assets/customer') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/customer') }}/js/optional/isotope.pkgd.min.js"></script>
<script src="{{ asset('assets/customer') }}/js/plugins.min.js"></script>
<script src="{{ asset('assets/customer') }}/js/jquery.appear.min.js"></script>

<!-- Main JS File -->
<script src="{{ asset('assets/customer') }}/js/main.min.js"></script>
    @yield('script')
    <!-- The core Firebase JS SDK is always required and must be listed first -->
{{--    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>--}}
{{--    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>--}}
{{--    <script src="{{ asset('firebase-messaging-sw.js') }}"></script>--}}

    <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->

{{--    <script>--}}
{{--             const firebaseConfig = {--}}
{{--            apiKey: "AIzaSyDPmqk16AKUsHqtg-VfKSy1DHE8GQJrCHM",--}}
{{--            authDomain: "b2b2022-4434e.firebaseapp.com",--}}
{{--            projectId: "b2b2022-4434e",--}}
{{--            storageBucket: "b2b2022-4434e.appspot.com",--}}
{{--            messagingSenderId: "727048487254",--}}
{{--            appId: "1:727048487254:web:423400932057d2b58516f7",--}}
{{--            measurementId: "G-BTLDWQHFP0"--}}
{{--        };--}}

{{--        // Initialize Firebase--}}
{{--        const app = initializeApp(firebaseConfig);--}}
{{--        const analytics = getAnalytics(app);--}}
{{--             const messaging = firebase.messaging();--}}

{{--             function initFirebaseMessagingRegistration() {--}}
{{--                 messaging.requestPermission().then(function () {--}}
{{--                     return messaging.getToken()--}}
{{--                 }).then(function(token) {--}}

{{--                     axios.post("{{ route('fcmToken') }}",{--}}
{{--                         _method:"PATCH",--}}
{{--                         token--}}
{{--                     }).then(({data})=>{--}}
{{--                         console.log(data)--}}
{{--                     }).catch(({response:{data}})=>{--}}
{{--                         console.error(data)--}}
{{--                     })--}}

{{--                 }).catch(function (err) {--}}
{{--                     console.log(`Token Error :: ${err}`);--}}
{{--                 });--}}
{{--             }--}}

{{--             initFirebaseMessagingRegistration();--}}

{{--             messaging.onMessage(function({data:{body,title}}){--}}
{{--                 new Notification(title, {body});--}}
{{--             });--}}
{{--    </script>--}}
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.1/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.9.1/firebase-analytics.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyDPmqk16AKUsHqtg-VfKSy1DHE8GQJrCHM",
            authDomain: "b2b2022-4434e.firebaseapp.com",
            projectId: "b2b2022-4434e",
            storageBucket: "b2b2022-4434e.appspot.com",
            messagingSenderId: "727048487254",
            appId: "1:727048487254:web:423400932057d2b58516f7",
            measurementId: "G-BTLDWQHFP0"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);
    </script>
</body>
</html>
