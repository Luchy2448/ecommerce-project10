@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Update Admin Details</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header" style="background-color: #135964">
                                <h3 class="card-title">Update Admin Details</h3>
                            </div>
                            <!-- /.card-header -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <!-- form start -->
                            <form method="post" action="{{ url('admin/update-details') }}" enctype="multipart/form-data">

                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="admin_email">Email address</label>
                                        <input class="form-control" id="admin_email"
                                            value="{{ Auth::guard('admin')->user()->email }}" disabled
                                            style="background-color: #e9e9e9;">
                                    </div>

                                    <div class="form-group">
                                        <label for="admin_name">Name</label>
                                        <input type="text" name="admin_name" class="form-control" id="admin_name"
                                            placeholder="Insert your name" value="{{ Auth::guard('admin')->user()->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_mobile">Mobile</label>
                                        <input type="text" name="admin_mobile" class="form-control" id="admin_mobile"
                                            placeholder="Insert mobile number"
                                            value="{{ Auth::guard('admin')->user()->mobile }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="admin_image">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="admin_image" class="custom-file-input"
                                                    id="admin_image">
                                                <label class="custom-file-label" for="admin_image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                @if (!empty(Auth::guard('admin')->user()->image))
                                                    <a href="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}"
                                                        target="_blank">
                                                        <span class="input-group-text"
                                                            style="background-color : #135964; color: white;   border-top-left-radius: 0;   border-bottom-left-radius: 0; border: 1px solid #135964">View
                                                            Image</span>
                                                    </a>
                                                    <input type="hidden" name="current_image"
                                                        value="{{ Auth::guard('admin')->user()->image }}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"
                                        style="background-color: #135964">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success_message'))
            Swal.fire({
                // title: "¡Éxito!",
                text: "{{ session('success_message') }}",
                icon: "success",
                draggable: true
            });
        @endif
    </script>
@endsection
