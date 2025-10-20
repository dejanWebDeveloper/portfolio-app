@extends('admin._layouts._layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Users</a></li>
                        <li class="breadcrumb-item active">User Form</li>
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
                            <h3 class="card-title">Change your profile info</h3>
                            <div class="card-tools">
                                <a href="{{route('admin.users.edit.user.password.page')}}"
                                   class="btn btn-outline-warning">
                                    <i class="fas fa-lock-open"></i>
                                    Change Password
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="edit-user" enctype="multipart/form-data"
                              action="{{route('admin.users.update', ['user' => $user->id ])}}"
                              method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <div>
                                                <strong>{{$user->email}}</strong>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   placeholder="Name of User"
                                                   value="{{old('name', $user->name)}}">
                                            <div>
                                                @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <div class="input-group">
                                                <input name="phone" type="text"
                                                       class="form-control @error('phone') is-invalid @enderror"
                                                       placeholder="Phone of User"
                                                       value="{{old('phone', $user->phone)}}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                     <i class="fas fa-phone"></i>
                                                     </span>
                                                </div>
                                            </div>
                                            <div>
                                                @error('phone')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Choose New Photo</label>
                                            <input type="hidden" id="delete_photo1" name="delete_photo1" value="0">
                                            <input id="photo-input1"
                                                   name="profile_photo"
                                                   type="file"
                                                   class="form-control @error('profile_photo') is-invalid @enderror">
                                            @error('profile_photo')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="offset-md-1 col-md-5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Photo</label>
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
                                                                 src="{{ $user->userImageUrl() }}"
                                                                 alt="Preview"
                                                                 style="padding-top: 10px; width: 305px;">
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
                                <a href="{{route('admin.users.index')}}" class="btn btn-outline-secondary">Cancel</a>
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
@endsection
@push('footer_script')
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
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
            $('#edit-user').validate({
                "rules": {
                    "ignore": [],
                    "name": {
                        "required": true,
                        "minlength": 5,
                        "maxlength": 50
                    },
                    "phone": {
                        "required": true,
                        "minlength": 8,
                        "maxlength": 20
                    }
                },
                "messages": {
                    "name": {
                        "required": "Please enter user name",
                        "minlength": "Name must be over 5 characters",
                        "maxlength": "Enter no more than 50 characters"
                    },
                    "phone": {
                        "required": "Please enter user phone",
                        "minlength": "Value must be over 8 characters",
                        "maxlength": "Enter no more than 20 characters"
                    }
                },
                "errorClass": "is-invalid",
            });
            $.validator.addMethod("pwcheck", function (value) {
                return /[A-Z]/.test(value)
                    && /[0-9]/.test(value)
                    && /[!@#$%^&*]/.test(value);
            });
        });
    </script>
@endpush

