@extends('front._layouts._layout')
@section('seo-title', 'Dejan Jovanovic | Portfolio')
<!-- no section content because clases in <main> _layouts -->
@section('content')
    @include('front.links_page.partials.content')
@endsection
@php($minFooter = true)
@push('min_footer')
    <footer class="py-6 text-center text-gray-500 border-t border-gray-800">
        © 2025 Dejan Jovanovic — All rights reserved.
    </footer>
@endpush
