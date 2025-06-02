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
                        <h3 class="card-title">Category</h3>
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
                    <form name="categoryForm" id="categoryForm" method="POST" enctype="multipart/form-data"
                        autocomplete="off"
                        @if (empty($category->id)) action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/' . $category->id) }}" @endif>
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="category_name">Category Name*</label>
                                <input type="text" id="category_name" name="category_name" class="form-control"
                                    rows="3" placeholder="Enter category name"
                                    value="{{ old('name', $category->name ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label>Category level*</label>
                                <select class="form-control" id="parent_id" name="parent_id"
                                    data-placeholder="Select a category level" style="width: 100%;">
                                    @foreach ($getCategories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ isset($category->parent_id) && $category->parent_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                        @if (!empty($cat->subCategories))
                                            @foreach ($cat->subCategories as $subCat)
                                                <option value="{{ $subCat->id }}"
                                                    {{ isset($category->parent_id) && $category->parent_id == $subCat->id ? 'selected' : '' }}>
                                                    &nbsp;&nbsp;&nbsp;&bullet; {{ $subCat->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                        @if (!empty($subCat->subCategories))
                                            {{-- Nested subcategories --}}
                                            @foreach ($subCat->subCategories as $subsubCat)
                                                <option value="{{ $subsubCat->id }}"
                                                    {{ isset($category->parent_id) && $category->parent_id == $subsubCat->id ? 'selected' : '' }}>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#x25E6; {{ $subsubCat->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Category Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                                @if (!empty($category->image))
                                    <div class="mt-3 mb-3"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <img style="width: 15%;"
                                            src="{{ asset('front/images/categories/' . $category->image) }}">
                                        <a class="confirmDelete" title="Delete Category Image" href="javascript:void(0);"
                                            record="category-image" recordid="{{ $category->id }}" <?php /* href="{{ url('admin/delete-category/' . $category->id) }}" */ ?>>
                                            <i class="fas fa-trash ml-4" style="color: #bb0101"></i>
                                        </a>
                                        <input type="hidden" name="current_image" value="{{ $category->image }}">
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="discount">Category Discount</label>
                                <input type="number" id="discount" name="discount" class="form-control" rows="3"
                                    placeholder="Enter discount" value="{{ old('discount', $category->discount ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Category Description</label>
                                <input type="text" id="description" name="description" class="form-control"
                                    rows="3" placeholder="Enter category description"
                                    value="{{ old('description', $category->description ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="url">Category Url*</label>
                                <input type="text" id="url" name="url" class="form-control" rows="3"
                                    placeholder="Enter category url" value="{{ old('url', $category->url ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" id="meta_title"
                                    placeholder="Enter page meta title"
                                    @if (!empty($category->meta_title)) value="{{ $category->meta_title }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea id="meta_description" name="meta_description" class="form-control" rows="3"
                                    placeholder="Enter page meta description">
@if (!empty($category->meta_description))
{{ $category->meta_description }}
@endif
</textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword">Meta Keywords</label>
                                <input type="text" name="meta_keyword" class="form-control" id="meta_keyword"
                                    placeholder="Enter page meta keywords"
                                    @if (!empty($category->meta_keyword)) value="{{ $category->meta_keyword }}" @endif>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"
                                style="background-color: #135964">Save</button>
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
