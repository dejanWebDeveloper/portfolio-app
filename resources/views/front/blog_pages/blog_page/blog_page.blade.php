@extends('front._layouts._layout')
@section('seo_title', 'Portfolio projects')
@section('content')
    <div class="container">
        <div class="row">
            <!-- Latest Posts -->
            <main class="posts-listing col-lg-8">
                <div class="container">
                    @include('front.blog_pages.blog_page.partials.projects')
                    <!-- Pagination -->
                    @include('front.blog_pages.blog_page.partials.project_pagination')
                </div>
            </main>
            <aside class="col-lg-4">
                <!-- Widget [Search Bar Widget]-->
                @include('front.blog_pages.partials.search_projects')
                <!-- Widget [Latest Posts Widget]        -->
                @include('front.blog_pages.partials.latest_projects')
                <!-- Widget [Categories Widget]-->
                @include('front.blog_pages.partials.categories')
            </aside>
        </div>
    </div>
@endsection
