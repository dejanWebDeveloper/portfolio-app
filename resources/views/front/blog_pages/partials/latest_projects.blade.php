<div class="widget latest-posts">
    <header>
        <h3 class="h6">Latest Projects</h3>
    </header>
    <div class="blog-posts">
        @foreach($latestProjectsForBlogPartial as $project)
        <a href="{{route('blog_project_page', ['id'=>$project->id, 'slug'=>$project->slug])}}">
            <div class="item d-flex align-items-center">
                <div class="image">
                    <img src="{{$project->additionalImageUrl()}}" alt="..." class="img-fluid">
                </div>
                <div class="title"><strong>{{$project->heading}}</strong>
                    <div class="d-flex align-items-center">
                        <div class="views"><i class="icon-eye"></i>{{$project->views}}</div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
