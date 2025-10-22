@extends('front._layouts._layout')
@section('seo_title', 'Cubes Blog-Contact Page')
@section('content')
    <!-- Hero Section -->
    @include('front.contact_page.partials.title')
    <div class="container">
        <div class="row">
            <!-- Latest Posts -->
            <main class="posts-listing col-lg-8">
                <div class="container">
                    @include('front.contact_page.partials.contact_form')
                </div>
            </main>
            <aside class="col-lg-4">
                <!-- Widget [Contact Widget]-->
                @include('front.contact_page.partials.contact_info')
            </aside>
        </div>
    </div>
@endsection
