@extends('admin.layout.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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
                        <h3 class="card-title">CMS Page</h3>
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
                    <form name="cmsForm" id="cmsForm" method="POST"
                        @if (empty($cmsPage->id)) action="{{ url('admin/add-edit-cms-page') }}" @else action="{{ url('admin/add-edit-cms-page/' . $cmsPage->id) }}" @endif>
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title*</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Enter page title"
                                    @if (!empty($cmsPage->title)) value="{{ $cmsPage->title }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="url">URL*</label>
                                <input type="text" name="url" class="form-control" id="url"
                                    placeholder="Enter page URL"
                                    @if (!empty($cmsPage->url)) value="{{ $cmsPage->url }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="description">Description*</label>
                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter page description">
@if (!empty($cmsPage->description))
{{ $cmsPage->description }}
@endif
</textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" id="meta_title"
                                    placeholder="Enter page meta title"
                                    @if (!empty($cmsPage->meta_title)) value="{{ $cmsPage->meta_title }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea id="meta_description" name="meta_description" class="form-control" rows="3"
                                    placeholder="Enter page meta description">
@if (!empty($cmsPage->meta_description))
{{ $cmsPage->meta_description }}
@endif
</textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword">Meta Keywords</label>
                                <input type="text" name="meta_keyword" class="form-control" id="meta_keyword"
                                    placeholder="Enter page meta keywords"
                                    @if (!empty($cmsPage->meta_keyword)) value="{{ $cmsPage->meta_keyword }}" @endif>
                            </div>
                            {{--  <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
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
                                        <option>California</option>
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
                            <button type="submit" class="btn btn-primary" style="background-color: #135964">Submit</button>
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
@endsection
