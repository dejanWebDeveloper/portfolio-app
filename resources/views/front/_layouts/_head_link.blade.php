<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('seo_title')</title>
    @if(View::hasSection('seo_description'))
        <meta name="description" content="@yield('seo_description')">
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <!-- Open Graph (Facebook) -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('seo_title')">
    @if(View::hasSection('seo_description'))
        <meta property="og:description" content="@yield('seo_description')">
    @endif
    @if(View::hasSection('seo_image'))
        <meta property="og:image" content="@yield('seo_image')">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('seo_title')">
    @if(View::hasSection('seo_description'))
        <meta name="twitter:description" content="@yield('seo_description')">
    @endif
    @if(View::hasSection('seo_image'))
        <meta name="twitter:image" content="@yield('seo_image')">
    @endif

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{url('/themes/front/vendor/bootstrap/css/bootstrap.css')}}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{url('/themes/front/vendor/font-awesome/css/font-awesome.min.css')}}">
    <!-- Custom icon font-->
    <link rel="stylesheet" href="{{url('/themes/front/css/fontastic.css')}}">
    <link rel="stylesheet" href="{{url('/themes/front/css/style.red.css')}}">
    <!-- Google fonts - Open Sans-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <!-- Fancybox-->
    <link rel="stylesheet" href="{{url('/themes/front/vendor/@fancyapps/fancybox/jquery.fancybox.css')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{url('/themes/front/css/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{url('/themes/front/css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{'favicon.png'}}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    @stack('head_link')

    </head>
