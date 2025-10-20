@push('head_link')
    <!-- owl carousel 2 stylesheet-->
    <link rel="stylesheet" href="{{url('/themes/front/plugins/owl-carousel2/assets/owl.carousel.min.css')}}" id="theme-stylesheet">
    <link rel="stylesheet" href="{{url('/themes/front/plugins/owl-carousel2/assets/owl.theme.default.min.css')}}" id="theme-stylesheet">
@endpush

@extends('front._layouts._layout')
@section('seo_title', 'Dejan Jovanovic portfolio')

@section('content')
    <!-- Intro Section-->
    @include('front.index_page.partials.title')
    @include('front.index_page.partials.category_news')
    <!-- Divider Section-->
    @include('front.index_page.partials.recommendation')
    <!-- Latest Posts -->
    @include('front.index_page.partials.latest_news')
    <!-- Gallery Section-->
    @include('front.index_page.partials.bottom_gallery')
@endsection

@push('footer_script')
    <script src="{{url('/themes/front/plugins/owl-carousel2/owl.carousel.min.js')}}"></script>
    <script>
        $("#latest-posts-slider").owlCarousel({
            "items": 3,
            "loop": true,
            "margin": 30,
            "autoplay": true,
            "autoplayHoverPause": true
        });
    </script>
@endpush

