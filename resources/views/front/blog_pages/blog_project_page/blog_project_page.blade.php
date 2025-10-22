@extends('front._layouts._layout')
@section('seo_title', $singleProject->heading)
@section('seo_description', Str::limit(strip_tags($singleProject->text), 160))
@if($singleProject->photo)
    @section('seo_image', $singleProject->imageUrl())
@endif
@section('content')
    <div class="container">
        <div class="row">
            <main class="post blog-post col-lg-8">
                <div class="container">
                    <div class="post-single">
                        <div class="post-thumbnail"><img src="{{$singleProject->imageUrl()}}" alt="..."
                                                         class="img-fluid">
                        </div>
                        <div class="post-details">
                            @include('front.blog_pages.blog_project_page.partials.content_of_project')
                            @include('front.blog_pages.blog_project_page.partials.tags_of_project')
                            @include('front.blog_pages.blog_project_page.partials.pre_next_project')
                        </div>
                    </div>
                </div>
            </main>
            <aside class="col-lg-4">
                <!-- Widget [Search Bar Widget]-->
                @include('front.blog_pages.partials.search_projects')
                <!-- Widget [Categories Widget]-->
                @include('front.blog_pages.partials.categories')
                <!-- Widget [Tags Cloud Widget]-->
            </aside>
        </div>
    </div>
@endsection




