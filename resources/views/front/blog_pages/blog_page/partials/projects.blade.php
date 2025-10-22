<div class="row">
    <!-- Project -->
    @foreach($blogProjects as $blogProject)
        <div class="post col-xl-6">
            <div class="post-thumbnail">
                <a href="{{route('blog_project_page', ['id'=>$blogProject->id, 'slug'=>$blogProject->slug])}}"><img src="{{$blogProject->imageUrl()}}" alt="..." class="img-fluid">
                </a>
            </div>
            <div class="post-details">
                <div class="post-meta d-flex justify-content-between">
                    <div class="date meta-last">{{$blogProject->created_at->format('d M | Y')}}</div>
                    <div class="category">
                        @if($blogProject->category)
                            <a href="{{ route('blog_category_page', ['id' => $blogProject->category->id, 'slug' => $blogProject->category->slug]) }}">
                                {{ $blogProject->category->name }}
                            </a>
                        @else
                            <a>Uncategorized</a>
                        @endif
                    </div>
                </div>
                <a href="{{route('blog_project_page', ['id'=>$blogProject->id, 'slug'=>$blogProject->slug])}}">
                    <h3 class="h4">{{$blogProject->heading}}</h3></a>
                <p class="text-muted">{{$blogProject->preheading}}</p>
                <footer class="post-footer d-flex align-items-center"><p class="author d-flex align-items-center flex-wrap">
                        <div class="avatar"><img src="{{url('storage/photo/user/1_profile_photo_09f0c10d-f35a-482b-a9b7-cf6ae5c77396')}}" alt="..." class="img-fluid">
                        </div>
                        <div class="title"><span>{{$blogProject->author}}</span></div>
                    </p>
                    <div class="date"><i class="icon-clock"></i>{{$blogProject->created_at->diffForHumans()}}</div>
                    <div class="views"><i class="icon-eye"></i>{{$blogProject->views}}</div>
                </footer>
            </div>
        </div>
    @endforeach
</div>
