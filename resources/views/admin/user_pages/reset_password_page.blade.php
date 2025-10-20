@extends('layouts.app')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a class="text-decoration-none" href="{{route('index_page')}}"><b>Cubes</b>School</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">You are only one step a way from your new password, recover your password
                    now.</p>

                <form id="reset-password" action="{{route('admin.users.edit.user.reset.user.password')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input name="email" type="email"
                               class="form-control"
                               placeholder="Email" value="{{old('email')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="@error('email') is-invalid @enderror"></div>
                    <div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="password"
                               placeholder="Password" name="password" id="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="@error('password') is-invalid @enderror"></div>
                    <div>
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="password"
                               placeholder="Confirm Password" name="password_confirmation" id="password_confirmation"
                               required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class=" @error('password_confirmation') is-invalid @enderror"></div>
                    <div>
                        @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Change password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a class="text-decoration-none" href="{{route('login')}}">Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
@push('app_script')
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#reset-password').validate({
                "rules": {
                    "ignore": [],
                    "email": {
                        "required": true,
                        "email": true
                    },
                    "password": {
                        "required": true,
                        "minlength": 8,
                        "pwcheck": true
                    },
                    "password_confirmation": {
                        "required": true,
                        "equalTo": "#password"
                    }
                },
                "messages": {
                    "email": {
                        "required": "Please enter user email",
                        "email": "Please enter valide email"
                    },
                    "password": {
                        "required": "Please enter valide password",
                        "minlength": "Password must be over 5 characters",
                        "pwcheck": "Password must contain one uppercase letter, one number, and one special character"
                    },
                    "password_confirmation": {
                        "required": "Please confirm entered password",
                        "equalTo": "Please confirm entered password"
                    }
                },
                "errorClass": "is-invalid",
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                }
            });
            $.validator.addMethod("pwcheck", function (value) {
                return /[A-Z]/.test(value)
                    && /[0-9]/.test(value)
                    && /[!@#$%^&*]/.test(value);
            });
        });
    </script>
@endpush
