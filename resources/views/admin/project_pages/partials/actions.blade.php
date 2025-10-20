<div class="btn-group">
    <a href="{{route('blog_project_page', ['id'=>$row->id, 'slug'=>$row->slug])}}" class="btn btn-info" target="_blank">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{route('admin.projects.edit', ['id'=>$row->id, 'slug'=>$row->slug])}}" class="btn btn-info">
        <i class="fas fa-edit"></i>
    </a>
    @if($row->enable == 0)
        <button data-id="{{$row->id}}" data-name="{{$row->heading}}" type="button" data-action="enable"
                class="btn btn-info" data-toggle="modal" data-target="#enable-modal">
            <i class="fas fa-check"></i>
        </button>
    @else
        <button data-id="{{$row->id}}" data-name="{{$row->heading}}" type="button" data-action="disable"
                class="btn btn-info" data-toggle="modal" data-target="#disable-modal">
            <i class="fas fa-ban"></i>
        </button>
    @endif
    <button data-id="{{$row->id}}" data-name="{{$row->heading}}" data-action="delete"
            type="button" class="btn btn-info" data-toggle="modal" data-target="#delete-modal">
        <i class="fas fa-trash"></i>
    </button>
</div>
