<div class="post-tags">
    @foreach($singleProjectTags as $tag)
        <a href="{{route('blog_tag_page', ['id'=>$tag->id, 'slug'=>$tag->slug])}}" class="tag">#{{$tag->name}}</a>
    @endforeach
</div>
