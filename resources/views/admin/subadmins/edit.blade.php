@extends('admin.layout.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Subadmin header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header" style="background-color: #135964">
                        <h3 class="card-title">Sub Admin</h3>
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
                    <form name="subadminForm" id="subadminForm" method="POST" enctype="multipart/form-data"
                        autocomplete="off"
                        @if (empty($subadmin->id)) action="{{ url('admin/add-edit-subadmin') }}" @else action="{{ url('admin/add-edit-subadmin/' . $subadmin->id) }}" @endif>
                        @csrf
                        <div class="card-body">

                            <div class="form-group">

                                <label for="subadmin_email">Email*</label>

                                <input @if ($subadmin['id'] != '') disabled style="background-color: #e9e9e9;" @endif
                                    type="email" id="subadmin_email" name="subadmin_email" class="form-control"
                                    rows="3" placeholder="Enter subadmin email"
                                    value="{{ old('email', $subadmin->email ?? '') }}" autocomplete="nope"
                                    @if (!empty($subadmin->id))  @endif>
                            </div>
                            <div class="form-group">
                                <label for="subadmin_pwd">Password</label>
                                <input @if ($subadmin['subadmin_pwd'] != '') disabled style="background-color: #e9e9e9;" @endif
                                    type="password" name="subadmin_pwd" class="form-control" id="subadmin_pwd"
                                    placeholder="Insert password"
                                    value="{{ old('subadmin_pwd', $subadmin->password ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Enter subadmin name" value="{{ old('name', $subadmin->name ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile*</label>
                                <input type="number" name="mobile" class="form-control" id="mobile"
                                    placeholder="Enter subadmin mobile" min="10"
                                    value="{{ old('mobile', $subadmin->mobile ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        @if (!empty($subadmin->image))
                                            <a href="{{ url('admin/images/photos/' . $subadmin->image) }}" target="_blank">
                                                <span class="input-group-text">View Image</span>
                                            </a>
                                            <input type="hidden" name="current_image" value="{{ $subadmin->image }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- 
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label mb-3" for="exampleCheck1">Check me out</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Multiple</label>
                                    <select class="select2" multiple="multiple" data-placeholder="Select a State"
                                        style="width: 100%;">
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        p <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>

                            </div> --}}
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" style="background-color: #135964">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->


        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success_message'))

            Swal.fire({
                title: "Great!",
                text: "{{ session('success_message') }}",
                icon: "success",
                draggable: true
            });
        @endif
    </script>
    <script>
        @if (session('sweet_error_message'))
            {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "{{ session('sweet_error_message') }}",
                });
            }
        @endif
    </script>
@endsection
