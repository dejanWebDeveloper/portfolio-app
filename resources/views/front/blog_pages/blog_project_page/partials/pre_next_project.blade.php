<div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row">
        @if($prevProject)
            <a href="{{route('blog_project_page', ['id'=>$prevProject->id, 'slug'=>$prevProject->slug])}}"
               class="prev-post text-left d-flex align-items-center">
                <div class="icon prev">
                    <i class="fa fa-angle-left"></i>
                </div>
                <div class="text">
                    <strong class="text-primary">Previous Project</strong>
                    <h6>{{ $prevProject->heading }}</h6>
                </div>
            </a>
        @else
            <strong class="text-primary">There is no previous projects</strong>
        @endif
        @if($nextProject)
                <a href="{{route('blog_project_page', ['id'=>$nextProject->id, 'slug'=>$nextProject->slug])}}"
                   class="next-post text-right d-flex align-items-center justify-content-end">
                    <div class="text">
                        <strong class="text-primary">Next Project</strong>
                        <h6>{{ $nextProject->heading }}</h6>
                    </div>
                    <div class="icon next">
                        <i class="fa fa-angle-right"> </i>
                    </div>
                </a>
        @else
            <strong class="text-primary">There is no next projects</strong>
        @endif
    </div>
