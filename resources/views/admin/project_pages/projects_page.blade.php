@push('head_link')
    <!--css link za dataTable plugin-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
          integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-container--default .select2-selection--single {
            height: 40px;
        }

        .select2-container--default .select2-selection--multiple {
            min-height: 40px;
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
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Projects</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search Products</h3>
                            <div class="card-tools">
                                <a href="{{route('admin.projects.create')}}" class="btn btn-success">
                                    <i class="fas fa-plus-square"></i>
                                    Add New Project
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(session()->has('system_message'))
                                <div id="system-message" class="alert alert-success" role="alert">
                                    {{session()->pull('system_message')}}
                                </div>
                            @endif
                            <form id="entities-filter-form">
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label>Heading</label>
                                        <input style="height: 40px;" type="text" name="heading" class="form-control"
                                               placeholder="Search by heading">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label>Category</label>
                                        <select id="select-category" name="category_id" class="form-control">
                                            <option></option>
                                            @foreach($projectContent['categories'] as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label>Tags</label>
                                        <select id="select-tags" name="tags_id[]" class="form-control" multiple>
                                            @foreach($projectContent['tags'] as $tag)
                                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <label>Enable</label>
                                        <select id="select-enable" name="enable" class="form-control">
                                            <option></option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Products</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="projects-table" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Photo</th>
                                    <th style="width: 20%;">Heading</th>
                                    <th class="text-center">Enable</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Views</th>
                                    <th class="text-center">GitHub_link</th>
                                    <th class="text-center">Demo_link</th>
                                    <th class="text-center">Priority</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- script code of dataTable -->
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <!-- enable/disable -->
    <div class="modal fade" id="disable-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="disable-project" method="post" action="{{route('admin.projects.disable.project')}}">
                    @csrf
                    <input type="hidden" name="project_for_disable_id" value="">
                    <div class="modal-header">
                        <h4 class="modal-title">Disable Project</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to disable project?</p>
                        <strong><p id="project_for_disable_name"></p></strong>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-minus-circle"></i>
                            Disable
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="enable-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="enable-project" method="post" action="{{route('admin.projects.enable.project')}}">
                    @csrf
                    <input type="hidden" name="project_for_enable_id" value="">
                    <div class="modal-header">
                        <h4 class="modal-title">Enable Project</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to enable project?</p>
                        <strong><p id="project_for_enable_name"></p></strong>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i>
                            Enable
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.content -->
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="delete-project" method="post" action="#">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="project_for_delete_id" value="">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Project</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete project?</p>
                        <strong><p id="project_for_delete_name"></p></strong>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /.modal -->
@endsection
@push('footer_script')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#select-category').select2({
                placeholder: "Select Category",
                allowClear: true
            });
            $('#select-tags').select2({
                placeholder: "Select Tags",
                allowClear: true
            });
            $('#select-enable').select2({
                placeholder: "Y/N",
                allowClear: true
            });
            //plugin za data tables
            $('#projects-table').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('admin.projects.datatable') }}",
                    type: "post",
                    data: function (d) {
                        d._token = "{{ csrf_token() }}";
                        d.heading = $('input[name=heading]').val();
                        d.category_id = $('select[name=category_id]').val();
                        d.enable = $('select[name=enable]').val();
                        d.tags_id = $('select[name="tags_id[]"]').val();
                    }
                },
                order: [[9, "desc"]],
                columns: [
                    {data: "id", name: "id", className: 'text-center'},
                    {data: "photo", name: "Photo", orderable: false, searchable: false, className: 'text-center'},
                    {data: "heading", name: "Heading"},
                    {data: "enable", name: "Enable", orderable: false, className: 'text-center'},
                    {data: "category", name: "Category", className: 'text-center'},
                    {data: "views", name: "Views", searchable: false, className: 'text-center'},
                    {data: "github_link", name: "GitHub_link", className: 'text-center'},
                    {data: "demo_link", name: "Demo_link", className: 'text-center'},
                    {data: "priority", name: "Priority", className: 'text-center'},
                    {data: "created_at", name: "Created_at", searchable: false, className: 'text-center'},
                    {data: "actions", name: "Actions", orderable: false, searchable: false, className: 'text-center'}
                ],
                pageLength: 10,
                lengthMenu: [5, 10, 15]
            });

            // reload table when filter was changed
            $('#entities-filter-form input, #entities-filter-form select').on('change keyup', function () {
                $('#projects-table').DataTable().ajax.reload();
            });

            //enable/disable
            //disable slider
            $('#projects-table').on('click', "[data-action='disable']", function () {
                let id = $(this).attr('data-id');
                let name = $(this).attr('data-name');

                $("#disable-modal [name='project_for_disable_id']").val(id);
                $('#disable-modal p#project_for_disable_name').html(name);
            });
            $('#disable-project').on('submit', function (e) {
                e.preventDefault();
                let projectId = $("#disable-modal [name='project_for_disable_id']").val(); // take ID from hidden modal input

                $.ajax({
                    url: "{{ route('admin.projects.disable.project') }}",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        project_for_disable_id: projectId
                    },
                    success: function () {
                        // hide modal
                        $('#disable-modal').modal('hide');
                        toastr.success('Project Successfully Disabled.');
                        // Reload all DataTables
                        $('#projects-table').DataTable().ajax.reload(null, false);
                    }
                });
            });
            //enable user
            $('#projects-table').on('click', "[data-action='enable']", function () {
                let id = $(this).attr('data-id');
                let name = $(this).attr('data-name');

                $("#enable-modal [name='project_for_enable_id']").val(id);
                $('#enable-modal p#project_for_enable_name').html(name);
            });
            $('#enable-project').on('submit', function (e) {
                e.preventDefault();
                let projectId = $("#enable-modal [name='project_for_enable_id']").val(); // take ID from hidden modal input

                $.ajax({
                    url: "{{ route('admin.projects.enable.project') }}",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        project_for_enable_id: projectId
                    },
                    success: function () {
                        // hide modal
                        $('#enable-modal').modal('hide');
                        toastr.success('Project Successfully Enabled.');
                        // Reload dataTables
                        $('#projects-table').DataTable().ajax.reload(null, false);
                    }
                });
            });

            //delete project
            // Open modal and enter data
            // Kada se klikne delete dugme u tabeli
            $(document).on('click', 'button[data-action="delete"]', function () {
                let projectId = $(this).data('id');
                let projectName = $(this).data('name');

                // Ubaci vrednosti u modal
                $("#delete-modal [name='project_for_delete_id']").val(projectId);
                $("#delete-modal #project_for_delete_name").text(projectName);
            });

// Kada se submituje forma za brisanje
            $('#delete-project').on('submit', function (e) {
                e.preventDefault();

                let projectId = $("#delete-modal [name='project_for_delete_id']").val();

                // Laravel route sa placeholderom :id
                let url = "{{ route('admin.projects.destroy', ':id') }}";
                url = url.replace(':id', projectId);

                $.ajax({
                    url: url,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function () {
                        $('#delete-modal').modal('hide');
                        toastr.success('Project successfully deleted.');
                        $('#projects-table').DataTable().ajax.reload(null, false);
                    },
                    error: function (xhr) {
                        toastr.error('Error deleting project.');
                        console.error(xhr.responseText);
                    }
                });
            });


        });
        //system-message disappear after 2s
        document.addEventListener('DOMContentLoaded', function () {
            const msg = document.getElementById('system-message');
            if(msg){
                setTimeout(() => {
                    msg.style.transition = "opacity 0.5s ease";
                    msg.style.opacity = 0;
                    setTimeout(() => msg.remove(), 500);
                }, 2000);
            }
        });
    </script>
@endpush
