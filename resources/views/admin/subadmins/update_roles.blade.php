@extends('admin.layout.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Subadmin header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subadmins</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Subadmins</li>
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
                        <h3 class="card-title">{{ $title }}</h3>
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
                    <form name="subadminForm" id="subadminForm" method="POST" autocomplete="off"
                        action="{{ url('admin/update-role/' . $id) }}">
                        @csrf
                        <input type="hidden" name="subadmin_id" value="{{ $id }}">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name">Cms Pages: </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="cms_pages[view]" value="1"
                                    {{ isset($role) && $role->view_access == 1 ? 'checked' : '' }}>
                                <label class="form-check-label mb-3">View Access</label>

                                <br>

                                <input type="checkbox" class="form-check-input" name="cms_pages[add]" value="1"
                                    {{ isset($role) && $role->add_access == 1 ? 'checked' : '' }}>
                                <label class="form-check-label mb-3">View/ Add Access</label>
                                <br>
                                <input type="checkbox" class="form-check-input" name="cms_pages[edit]" value="1"
                                    {{ isset($role) && $role->edit_access == 1 ? 'checked' : '' }}>
                                <label class="form-check-label mb-3">View/ Edit Access</label>
                                <br>
                                <input type="checkbox" class="form-check-input" name="cms_pages[full]" value="1"
                                    {{ isset($role) && $role->full_access == 1 ? 'checked' : '' }}>
                                <label class="form-check-label mb-3">Full Access</label>
                            </div>

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
