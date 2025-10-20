@push('head_link')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-container--default .select2-selection--single {
            height: 35px;
        }
        .select2-container--default .select2-selection--multiple {
            min-height: 35px;
            font-size: 16px;
        }
    </style>
@endpush
@extends('admin._layouts._layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Project Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.projects.index')}}">Projects</a></li>
                        <li class="breadcrumb-item active">Project Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Project Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="edit-project" enctype="multipart/form-data"
                              action="{{ route('admin.projects.update', ['project' => $projectForEdit->id]) }}"
                              method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Heading</label>
                                            <input name="heading" type="text"
                                                   class="form-control @error('heading') is-invalid @enderror"
                                                   placeholder="Enter Heading"
                                                   value="{{old('heading', $projectForEdit->heading)}}">
                                            <div>
                                                @error('heading')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Preheading</label>
                                            <input name="preheading" type="text"
                                                   class="form-control @error('preheading') is-invalid @enderror"
                                                   placeholder="Enter Preheading"
                                                   value="{{old('preheading', $projectForEdit->preheading)}}">
                                            <div>
                                                @error('preheading')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Project Category</label>
                                            <select id="select-category" class="form-control" name="category_id">
                                                <option value="">-- Select Category --</option>
                                                @foreach($contentForEdit['categories'] as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id', $projectForEdit->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <div>
                                                @error('category_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Author</label>
                                            <input name="author" type="text"
                                                   class="form-control @error('author') is-invalid @enderror"
                                                   placeholder="Enter Author" value="{{old('author', $projectForEdit->author)}}">
                                            <div>
                                                @error('author')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>GitHub Link</label>
                                            <input name="github_link" type="text"
                                                   class="form-control @error('github_link') is-invalid @enderror"
                                                   placeholder="Enter Github_link" value="{{old('github_link', $projectForEdit->github_link)}}">
                                            <div>
                                                @error('github_link')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Demo Link</label>
                                            <input name="demo_link" type="text"
                                                   class="form-control @error('demo_link') is-invalid @enderror"
                                                   placeholder="Enter Demo_link" value="{{old('demo_link', $projectForEdit->demo_link)}}">
                                            <div>
                                                @error('demo_link')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Priority</label>
                                            <input name="priority" type="number"
                                                   class="form-control @error('priority') is-invalid @enderror"
                                                   placeholder="Enter Priority" value="{{old('priority', $projectForEdit->priority)}}">
                                            <div>
                                                @error('priority')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tags</label>
                                            <select class="form-control @error('tags') is-invalid @enderror"
                                                    name="tags[]"
                                                    id="select-tags"
                                                    multiple>
                                                @foreach($contentForEdit['tags'] as $tag)
                                                    <option value="{{ $tag->id }}"
                                                        {{ in_array($tag->id, old('tags', $projectForEdit->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                        {{ $tag->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('tags')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Choose New Photo 1</label>
                                            <input type="hidden" id="delete_photo1" name="delete_photo1" value="0">
                                            <input id="photo-input1"
                                                   name="first-photo"
                                                   type="file"
                                                   class="form-control @error('first-photo') is-invalid @enderror">
                                            @error('first-photo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="project-text" class="form-label">Input Text</label>
                                            <textarea type="text"
                                                      class="form-control @error('text') is-invalid @enderror"
                                                      name="text"
                                                      id="project-text">{{old('text', $projectForEdit->text ?? '')}}</textarea>
                                            <div>
                                                @error('text')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-md-1 col-md-5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Photo 1</label>
                                                    <div class="text-right">
                                                        <button type="button" onclick="clearImage1()"
                                                                class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-remove"></i>
                                                            Delete Photo
                                                        </button>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="text-center">
                                                            <img id="photoPreview1"
                                                                 src="{{ $projectForEdit->imageUrl() }}" alt="Preview"
                                                                 style="padding-top: 10px; max-width: 305px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{route('admin.projects.index')}}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @push('footer_script')
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
        <script>
            document.getElementById('photo-input1').addEventListener('change', function (event) {
                const input = event.target;
                const preview1 = document.getElementById('photoPreview1');
                const deleteField = document.getElementById("delete_photo1");
                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        preview1.src = e.target.result;
                        preview1.style.display = 'block';
                        deleteField.value = 0;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
            function clearImage1() {
                const input = document.getElementById("photo-input1");
                const preview = document.getElementById("photoPreview1");
                const deleteField = document.getElementById("delete_photo1");

                // Clear file input
                input.value = "";

                // Hide preview
                preview.src = "#";
                preview.style.display = "none";

                // Tell server to delete the existing photo
                deleteField.value = 1;
            }
            $(document).ready(function () {
                $('#select-author').select2({
                    placeholder: "Select Author",
                    allowClear: true
                });
                $('#select-category').select2({
                    placeholder: "Select Category",
                    allowClear: true
                });
                $('#select-tags').select2({
                    placeholder: "Select Tags",
                    allowClear: true
                });

                CKEDITOR.replace('project-text', {
                    height: 600,
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}'
                });

                $('#edit-project').validate({
                    "rules": {
                        "ignore": [],
                        "heading": {
                            "required": true,
                            "minlength": 20,
                            "maxlength": 255
                        },
                        "preheading": {
                            "required": true,
                            "minlength": 50,
                            "maxlength": 500
                        },
                        "category": {
                            "required": true
                        },
                        "tags[]": {
                            "required": true
                        },
                        "text": {
                            "required": true,
                            "minlength": 50,
                            "maxlength": 1000
                        },
                        "github_link": {
                            "required": true,
                            "url": true,
                            "minlength": 10,
                            "maxlength": 255
                        },
                        "demo_link": {
                            "url": true,
                            "minlength": 10,
                            "maxlength": 255
                        }
                    },
                    "messages": {
                        "heading": {
                            "required": "Please enter project heading",
                            "minlength": "Your heading must be over 20 characters",
                            "maxlength": "Enter no more than 255 characters"
                        },
                        "preheading": {
                            "required": "Please enter project preheading",
                            "minlength": "Your description must be longer than 50 characters",
                            "maxlength": "Your description cannot be longer than 500 characters"
                        },
                        "category": {
                            "required": "Please enter some category"
                        },
                        "tags[]": {
                            "required": "Please enter some tags"
                        },
                        "text": {
                            "required": "What do you want to say to us",
                            "minlength": "Your text must be over 50 characters",
                            "maxlength": "Enter no more than 1000 characters"
                        },
                        "github_link": {
                            "required": "Please enter link to github repository",
                            "url": "Please enter valide url",
                            "minlength": "Your text must be over 50 characters",
                            "maxlength": "Enter no more than 255 characters"
                        },
                        "demo_link": {
                            "url": "Please enter valide url",
                            "minlength": "Your url must be over 50 characters",
                            "maxlength": "Enter no more than 255 characters"
                        }
                    },
                    "errorClass": "is-invalid"
                });
            });
        </script>
    @endpush
@endsection
