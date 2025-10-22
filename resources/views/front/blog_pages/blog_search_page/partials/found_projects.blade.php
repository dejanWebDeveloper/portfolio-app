<div class="row">
    @php
        // Pripremi regex za označavanje (case-insensitive)
        $highlight = function ($text, $query) {
            return preg_replace('/(' . preg_quote($query, '/') . ')/i', '<mark>$1</mark>', $text);
        };
    @endphp
    @if($results->count())
        @foreach($results as $project)
            <div class="post col-xl-6">
                <div class="post-thumbnail">
                    <a href="{{route('blog_project_page', ['id'=>$project->id, 'slug'=>$project->slug])}}"><img src="{{$project->imageUrl()}}" alt="..." class="img-fluid">
                    </a>
                </div>
                <div class="post-details">
                    <div class="post-meta d-flex justify-content-between">
                        <div class="date meta-last">{{$project->created_at->format('d M | Y')}}</div>
                        <div class="category">
                            @if($project->category)
                                <a href="{{ route('blog_category_page', ['id' => $project->category->id, 'slug' => $project->category->slug]) }}">
                                    {{ $project->category->name }}
                                </a>
                            @else
                                <a>Uncategorized</a>
                            @endif
                        </div>
                    </div>
                    <a href="{{route('blog_project_page', ['id'=>$project->id, 'slug'=>$project->slug])}}">
                        <h3 class="h4">{!! $highlight($project->heading, $query) !!}</h3></a>
                    <p class="text-muted">{!! $highlight($project->preheading, $query) !!}</p>
                    <p class="text-muted">{!! $highlight(Str::limit($project->text, 120), $query) !!}</p>
                    <footer class="post-footer d-flex align-items-center">
                        <p class="author d-flex align-items-center flex-wrap">
                            <div class="avatar">
                            </div>
                            <div class="title"><span>{{$project->author}}</span>
                            </div>
                        </p>
                        <div class="date"><i class="icon-clock"></i>{{$project->created_at->diffForHumans()}}</div>
                    </footer>
                </div>
            </div>
        @endforeach

    @else
        <p>No results</p>
@endif
