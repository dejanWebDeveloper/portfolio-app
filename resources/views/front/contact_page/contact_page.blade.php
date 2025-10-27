@extends('front._layouts._layout')
@section('seo-title', 'Contact | Dejan Jovanovic')
@section('content')
    @include('front.contact_page.partials.title')
    @include('front.contact_page.partials.contact_form')
    @include('front.contact_page.partials.contact_info')
    @php($minFooter = true)
    @push('min_footer')
        @include('front._layouts._min_footer')
    @endpush
@endsection

