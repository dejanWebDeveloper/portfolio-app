<!DOCTYPE html>
<html lang="en">
@include('front._layouts._head_link')
<body class="bg-gray-950 text-gray-100 font-sans" style="visibility:hidden" onload="document.body.style.visibility='visible'">
@if (!isset($nullHeader))
    @include('front._layouts._header')
@endif
@yield('content')
@if (!isset($minFooter))
    @include('front._layouts._footer')
@endif
@stack('min_footer')
@include('front._layouts._footer_script')
</body>
</html>



