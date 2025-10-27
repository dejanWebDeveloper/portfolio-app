@extends('front._layouts._layout')
@section('seo-title', 'Projects | Dejan Jovanovic')

@section('content')
    @include('front.project_pages.blog_page.partials.title')
    @include('front.project_pages.blog_page.partials.projects')
    @include('front.project_pages.blog_page.partials.project_pagination')
@endsection
