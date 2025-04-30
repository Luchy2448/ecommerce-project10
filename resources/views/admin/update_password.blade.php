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
                            <li class="breadcrumb-item active">Update Admin Password</li>
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
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Admin Password</h3>
                            </div>
                            <!-- /.card-header -->


                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <!-- form start -->
                            <form method="post" action="{{ url('admin/update_password') }}">

                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="admin_email">Email address</label>
                                        <input class="form-control" id="admin_email"
                                            value="{{ Auth::guard('admin')->user()->email }}" disabled
                                            style="background-color: #666;">
                                    </div>

                                    <div class="form-group">
                                        <label for="current_pwd">Current Password</label>
                                        <input type="password" name="current_pwd" class="form-control" id="current_pwd"
                                            placeholder="Insert Current Password"><span id="verifyCurrentPwd"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_pwd">New Password</label>
                                        <input type="password" name="new_pwd" class="form-control" id="new_pwd"
                                            placeholder="Insert New Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_pwd">Confirm Password</label>
                                        <input type="password" name="confirm_pwd" class="form-control" id="confirm_pwd"
                                            placeholder="Confirm Password">
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
