<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="author" content="Hypeople">
    <meta name="description" content="Responsive, Highly Customizable Dashboard Template" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('app-assets/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('app-assets/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('app-assets/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('app-assets/favicon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('app-assets/favicon/safari-pinned-tab.svg')}}" color="#393885 ">
    <meta name="msapplication-TileColor" content="#393885 ">
    <meta name="theme-color" content="#ffffff">

    <!-- Plugin -->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugin/swiper-bundle.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/icons/iconly/index.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/icons/remix-icon/index.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">

    <!-- Base -->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/base/font-control.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/base/typography.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/base/base.css')}}">

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/theme/colors-dark.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/theme/theme-dark.css')}}">

    <!-- Layouts -->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/layouts/sider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/layouts/header.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">

    <!-- Customizer -->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/layouts/customizer.css')}}">

    <!-- Pages -->
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/pages/authentication.css')}}">

    <!-- Custom -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

    <title>@yield('title', 'Auth | Pola Poli')</title>
</head>

<body>
    <div class="row hp-authentication-page">
        <div class="col-12 col-lg-6 bg-primary-4 hp-bg-color-dark-90 position-relative auth-image">
            <div class="row hp-image-row h-100 px-8 px-sm-16 px-md-0 pb-32 pb-sm-0 pt-32 pt-md-0">
                <div class="col-12 hp-logo-item m-16 m-sm-32 m-md-64 w-auto px-0">
                    <img class="hp-dark-none" src="{{asset('app-assets/img/logo/logo-vector-primary.svg')}}" alt="Logo">
                    <img class="hp-dark-block" src="{{asset('app-assets/img/logo/logo-vector.svg')}}" alt="Logo">
                </div>

                <div class="col-12">
                    <div class="row align-items-center justify-content-center h-100">
                        <div class="col-12 col-md-10 hp-bg-item text-center mt-64 mb-32 mb-md-0">
                            <img class="hp-dark-none m-auto mt-64"
                                src="{{asset('app-assets/img/pages/authentication/authentication-bg.svg')}}"
                                alt="Background Image">
                            <img class="hp-dark-block m-auto mt-64"
                                src="{{asset('app-assets/img/pages/authentication/authentication-bg-dark.svg')}}"
                                alt="Background Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 py-sm-64 py-lg-0">
            <div class="row align-items-center justify-content-center h-100 mx-4 mx-sm-n32">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Plugin -->
    <script src="{{asset('app-assets/js/plugin/jquery.min.js')}}"></script>
    <script src="{{asset('app-assets/js/plugin/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('app-assets/js/plugin/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('app-assets/js/plugin/jquery.mask.min.js')}}"></script>
    <script src="{{asset('app-assets/js/plugin/autocomplete.min.js')}}"></script>
    <script src="{{asset('app-assets/js/plugin/moment.min.js')}}"></script>

    <!-- Layouts -->
    <script src="{{asset('app-assets/js/layouts/header-search.js')}}"></script>
    <script src="{{asset('app-assets/js/layouts/sider.js')}}"></script>
    <script src="{{asset('app-assets/js/components/input-number.js')}}"></script>

    <!-- Base -->
    <script src="{{asset('app-assets/js/base/index.js')}}"></script>
    <!-- Customizer -->
    <script src="{{asset('app-assets/js/customizer.js')}}"></script>

    <!-- Custom -->
    <script src="{{asset('assets/js/main.js')}}"></script>
</body>

</html>
