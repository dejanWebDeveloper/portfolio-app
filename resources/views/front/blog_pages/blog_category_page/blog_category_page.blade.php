@extends('front._layouts._layout')
@section('seo_title', $category->name)
@section('content')
    <div class="container">
        <div class="row">
            <!-- Latest Posts -->
            <main class="posts-listing col-lg-8">
                <div class="container">
                    <h2 class="mb-3">Category "{{$category->name}}"</h2>
                    @include('front.blog_pages.blog_category_page.partials.projects')
                    <!-- Pagination -->
                    @include('front.blog_pages.blog_category_page.partials.pagination')
                </div>
            </main>
            <aside class="col-lg-4">
                <!-- Widget [Search Bar Widget]-->
                @include('front.blog_pages.partials.search_projects')
                <!-- Widget [Categories Widget]-->
                @include('front.blog_pages.partials.categories')

            </aside>
        </div>
    </div>
@endsection

