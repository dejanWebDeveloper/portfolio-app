@extends('front._layouts._layout')
@section('seo-title', 'Projects | Dejan Jovanovic')
@section('content')
    @include('front.blog_pages.blog_page.partials.title')
    @include('front.blog_pages.blog_page.partials.projects')
    @include('front.blog_pages.blog_page.partials.project_pagination')
@endsection

