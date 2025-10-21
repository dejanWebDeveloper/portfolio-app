<div class="row">
    <!-- project -->
    @foreach($categoryProjects as $categoryProject)
        <div class="post col-xl-6">
            <div class="post-thumbnail">
                <a href="{{route('blog_project_page', ['id'=>$categoryProject->id, 'slug'=>$categoryProject->slug])}}"><img src="{{$categoryProject->imageUrl()}}" alt="..." class="img-fluid">
                </a>
            </div>
            <div class="post-details">
                <div class="post-meta d-flex justify-content-between">
                    <div class="date meta-last">{{$categoryProject->created_at->format('d M | Y')}}</div>
                    <div class="category">
                        @if($categoryProject->category)
                            <a href="{{ route('blog_category_page', ['id' => $categoryProject->category->id, 'slug' => $categoryProject->category->slug]) }}">
                                {{ $categoryProject->category->name }}
                            </a>
                        @else
                            <a>Uncategorized</a>
                        @endif
                    </div>
                </div>
                <a href="{{route('blog_project_page', ['id'=>$categoryProject->id, 'slug'=>$categoryProject->slug])}}">
                    <h3 class="h4">{{$categoryProject->heading}}</h3></a>
                <p class="text-muted">{{$categoryProject->preheading}}</p>
                <footer class="post-footer d-flex align-items-center"><p class="author d-flex align-items-center flex-wrap">
                        <div class="avatar">
                        </div>
                        <div class="title"><span>{{$categoryProject->author}}</span></div>
                    </p>
                    <div class="date"><i class="icon-clock"></i>{{$categoryProject->created_at->diffForHumans()}}</div>
                </footer>
            </div>
        </div>
    @endforeach
</div>
