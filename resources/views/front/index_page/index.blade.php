@extends('front._layouts._layout')
@php($nullHeader = true)
@section('seo-title', 'Dejan Jovanovic | Portfolio')
<!-- no section content because clases in <main> _layouts -->
@section('content')
    @include('front.index_page.partials.content')
@endsection

@php($minFooter = true)
@push('min_footer')
    @include('front._layouts._min_footer')
@endpush
