<div class="post-meta d-flex justify-content-between">
    <div class="category">
        @if($singleProject->category)
            <a href="{{ route('blog_category_page', ['id' => $singleProject->category->id, 'slug' => $singleProject->category->slug]) }}">
                {{ $singleProject->category->name }}
            </a>
        @else
            <a>Uncategorized</a>
        @endif
    </div>
</div>
<h1>{{$singleProject->heading}}
    <a href="#"><i class="fa fa-bookmark-o"></i>
    </a>
</h1>
<div class="post-footer d-flex align-items-center flex-column flex-sm-row">
    <p>
        <div class="avatar"><img src="{{url('storage/photo/user/1_profile_photo_09f0c10d-f35a-482b-a9b7-cf6ae5c77396')}}" alt="..." class="img-fluid"></div>
        <div class="title">
            <span>{{$singleProject->author}}</span>
        </div>
    </p>
    <div class="d-flex align-items-center flex-wrap">
        <div class="date"><i class="icon-clock"></i>{{$singleProject->created_at->diffForHumans()}}</div>
        <div class="views"><i class="icon-eye"></i>{{$singleProject->views}}</div>
    </div>
</div>
<div class="post-body">
    <p class="lead"></p>
    <p>{{$singleProject->preheading}}</p>
    <p>{!! $singleProject->text !!}</p>
</div>
