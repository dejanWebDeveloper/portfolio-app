@push('head_link')
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #f6d365;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }
    </style>
@endpush
@extends('admin._layouts._layout')
@section('content')
    <section class="vh-100" style="background-color: #f4f5f7; font-size: 20px">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-12 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white"
                                 style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="{{$user->userImageUrl()}}"
                                     alt="Avatar" class="img-fluid my-5" style="width: 300px;"/>
                                <h5>{{$user->name}}</h5>
                                <p>Blogger</p>
                                <a class="text-decoration-none text-white"
                                   href="{{route('admin.users.edit.user.page')}}"><i class="far fa-edit mb-5"></i></a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email</h6>
                                            <p class="text-muted">{{$user->email}}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Phone</h6>
                                            <p class="text-muted">{{$user->phone}}</p>
                                        </div>
                                    </div>
                                    <h6>Status</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Profile created:</h6>
                                            <p class="text-muted">{{$user->created_at->diffForHumans()}}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Status</h6>
                                            <p class="text-muted">
                                                {!! $user->status
                                                    ? '<span class="badge badge-success">Enabled</span>'
                                                    : '<span class="badge badge-danger">Disabled</span>' !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
