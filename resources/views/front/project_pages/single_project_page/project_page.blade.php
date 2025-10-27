@extends('front._layouts._layout')
@section('seo-title', ''.$singleProject->heading.' | Dejan Jovanovic')
@section('content')
    @include('front.project_pages.single_project_page.partials.title')
    @include('front.project_pages.single_project_page.partials.content_of_project')
@endsection
