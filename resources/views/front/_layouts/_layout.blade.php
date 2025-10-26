<!DOCTYPE html>
<html lang="en">
@include('front._layouts._head_link')
<body class="bg-gray-950 text-gray-100 font-sans">
@if (!isset($nullHeader))
    @include('front._layouts._header')
@endif
<main class="pt-32 px-6 max-w-6xl mx-auto">
@yield('content')
</main>
@if (!isset($minFooter))
    @include('front._layouts._footer')
@endif
@stack('min_footer')
@include('front._layouts._footer_script')
</body>
</html>



