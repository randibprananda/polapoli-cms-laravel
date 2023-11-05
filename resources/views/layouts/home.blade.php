<!DOCTYPE html>
<html lang="en" id="html">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="author" content="Pola Poli">
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('app-assets/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('app-assets/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('app-assets/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('app-assets/favicon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('app-assets/favicon/safari-pinned-tab.svg')}}" color="#393885 ">
    <meta name="msapplication-TileColor" content="#393885 ">
    <meta name="theme-color" content="#ffffff">

    <!-- Title -->
    <title>@yield('title', '| Pola Poli')</title>

    <!-- Plugin -->
    <link href="{{asset('app-assets/css/bootstrap-home.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('app-assets/css/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('app-assets/css/line-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('app-assets/css/themify-icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('app-assets/css/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('app-assets/css/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('app-assets/css/lightslider.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('app-assets/css/spacing.css')}}" rel="stylesheet" type="text/css" />

    <!-- Theme -->
    <link href="{{asset('app-assets/css/theme.min.css')}}" rel="stylesheet" />
    <link href="{{asset('app-assets/css/style.css')}}" rel="stylesheet" />

    <style>
        .translated-ltr {
            margin-top: -40px;
        }

        .translated-rtl {
            margin-top: -40px !important;
        }

        .goog-te-banner-frame {
            display: none;
            margin-top: -20px;
        }

        .goog-logo-link {
            display: none !important;
        }

        .goog-te-gadget {
            color: transparent !important;
        }

        #goog-gt-tt {
            display: none !important;
        }

    </style>

    @yield('css')
</head>

<body>
    <div class="page-wrapper">

        <div id="ht-preloader">
            <div class="loader clear-loader">
                <p><img src="{{asset('app-assets/img/logo/logo.svg')}}" width="250px" /></p>
            </div>
        </div>

        @include('partials.home.navbar')

        @yield('content')

        @include('partials.home.footer')

    </div>

    <div class="scroll-top"><a class="smoothscroll" href="#top"><i class="las la-angle-up"></i></a></div>

    <script src="{{asset('app-assets/js/theme-plugin.js')}}"></script>
    <script src="{{asset('app-assets/js/theme-script.js')}}"></script>

    <!-- GOOGLE TRANSLATE -->
    <script src="{{asset('app-assets/js/translate.js')}}"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    @yield('js')

</body>

</html>
