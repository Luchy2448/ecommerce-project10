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
                        <h3 class="card-title">Product</h3>
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
                    <form name="productForm" id="productForm" method="POST" enctype="multipart/form-data"
                        autocomplete="off"
                        @if (empty($product->id)) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/' . $product->id) }}" @endif>
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category_id">Select Category</label>
                                <select class="form-control" id="category_id" name="category_id"
                                    data-placeholder="Select a category" style="width: 100%;">
                                    @foreach ($getCategories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                        @if (!empty($cat->subCategories))
                                            @foreach ($cat->subCategories as $subCat)
                                                <option value="{{ $subCat->id }}"
                                                    {{ old('category_id', $product->category_id ?? '') == $subCat->id ? 'selected' : '' }}>
                                                    &nbsp;&nbsp;&nbsp;&bullet; {{ $subCat->name }}
                                                </option>
                                                @if (!empty($subCat->subCategories))
                                                    @foreach ($subCat->subCategories as $subsubCat)
                                                        <option value="{{ $subsubCat->id }}"
                                                            {{ old('category_id', $product->category_id ?? '') == $subsubCat->id ? 'selected' : '' }}>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#x25E6;
                                                            {{ $subsubCat->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="product_name">Name</label>
                                <input type="text" id="product_name" name="product_name" class="form-control"
                                    rows="3" placeholder="Enter product name"
                                    value="{{ old('name', $product->name ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" id="code" name="code" class="form-control" rows="3"
                                    placeholder="Enter product code" value="{{ old('code', $product->code ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="color">Group code</label>
                                <select name="group_code" class="form-control">
                                    <option value="">Select group code</option>
                                    @foreach ($groupCodes as $code)
                                        <option value="{{ $code }}"
                                            {{ old('group_code', $product->group_code ?? '') == $code ? 'selected' : '' }}>
                                            {{ $code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="text" id="color" name="color" class="form-control" rows="3"
                                    placeholder="Enter product color" value="{{ old('color', $product->color ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="color">Family Color</label>
                                <select name="family_color" class="form-control">
                                    <option value="">Select family color</option>
                                    <option value="red"
                                        {{ old('family_color', $product->family_color ?? '') == 'red' ? 'selected' : '' }}>
                                        Red</option>
                                    <option value="blue"
                                        {{ old('family_color', $product->family_color ?? '') == 'blue' ? 'selected' : '' }}>
                                        Blue</option>
                                    <option value="green"
                                        {{ old('family_color', $product->family_color ?? '') == 'green' ? 'selected' : '' }}>
                                        Green</option>
                                    <option value="yellow"
                                        {{ old('family_color', $product->family_color ?? '') == 'yellow' ? 'selected' : '' }}>
                                        Yellow</option>
                                    <option value="black"
                                        {{ old('family_color', $product->family_color ?? '') == 'black' ? 'selected' : '' }}>
                                        Black</option>
                                    <option value="white"
                                        {{ old('family_color', $product->family_color ?? '') == 'white' ? 'selected' : '' }}>
                                        White</option>
                                    <option value="purple"
                                        {{ old('family_color', $product->family_color ?? '') == 'purple' ? 'selected' : '' }}>
                                        Purple</option>
                                    <option value="pink"
                                        {{ old('family_color', $product->family_color ?? '') == 'pink' ? 'selected' : '' }}>
                                        Pink</option>
                                    <option value="orange"
                                        {{ old('family_color', $product->family_color ?? '') == 'orange' ? 'selected' : '' }}>
                                        Orange</option>
                                    <option value="brown"
                                        {{ old('family_color', $product->family_color ?? '') == 'brown' ? 'selected' : '' }}>
                                        Brown</option>
                                    <option value="gray"
                                        {{ old('family_color', $product->family_color ?? '') == 'gray' ? 'selected' : '' }}>
                                        Gray</option>
                                    <option value="silver"
                                        {{ old('family_color', $product->family_color ?? '') == 'silver' ? 'selected' : '' }}>
                                        Silver</option>
                                    <option value="golden"
                                        {{ old('family_color', $product->family_color ?? '') == 'golden' ? 'selected' : '' }}>
                                        Golden</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="price">Price $</label>
                                <input type="number" id="price" name="price" class="form-control" rows="3"
                                    placeholder="Enter product price" value="{{ old('price', $product->price ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="discount">Product Discount %</label>
                                <input type="number" id="discount" name="discount" class="form-control"
                                    rows="3" placeholder="Enter discount"
                                    value="{{ old('discount', $product->discount ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="final_price">Final price $</label>
                                <input type="number" id="final_price" name="final_price" class="form-control"
                                    rows="3" placeholder="Enter product final price"
                                    value="{{ old('final_price', $product->final_price ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" id="stock" name="stock" class="form-control" rows="3"
                                    placeholder="Enter product stock" value="{{ old('stock', $product->stock ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Product Description</label>
                                <input type="text" id="description" name="description" class="form-control"
                                    rows="3" placeholder="Enter product description"
                                    value="{{ old('description', $product->description ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="wash_care">Product Wash_care</label>
                                <input type="text" id="wash_care" name="wash_care" class="form-control"
                                    rows="3" placeholder="Enter product wash_care"
                                    value="{{ old('wash_care', $product->wash_care ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="keywords">Product Keywords</label>
                                <input type="text" id="keywords" name="keywords" class="form-control"
                                    rows="3" placeholder="Enter product keywords"
                                    value="{{ old('keywords', $product->keywords ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="fabric">Product Fabric</label>
                                <select name="fabric" id="fabric" class="form-control">
                                    @foreach ($productsFilters['fabricArray'] as $fabric)
                                        <option value="{{ $fabric }}"
                                            {{ old('fabric', $product->fabric ?? '') == $fabric ? 'selected' : '' }}>
                                            {{ $fabric }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pattern">Product Pattern</label>
                                <select name="pattern" id="pattern" class="form-control">
                                    @foreach ($productsFilters['patternArray'] as $pattern)
                                        <option value="{{ $pattern }}"
                                            {{ old('pattern', $product->pattern ?? '') == $pattern ? 'selected' : '' }}>
                                            {{ $pattern }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sleeve">Product Sleeve</label>
                                <select name="sleeve" id="sleeve" class="form-control">
                                    @foreach ($productsFilters['sleeveArray'] as $sleeve)
                                        <option value="{{ $sleeve }}"
                                            {{ old('sleeve', $product->sleeve ?? '') == $sleeve ? 'selected' : '' }}>
                                            {{ $sleeve }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="size">Size</label>
                                <select name="size" id="size" class="form-control">
                                    @foreach ($productsFilters['sizeArray'] as $size)
                                        <option value="{{ $size }}"
                                            {{ old('size', $product->size ?? '') == $size ? 'selected' : '' }}>
                                            {{ $size }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fit">Product Fit</label>
                                <select name="fit" id="fit" class="form-control">
                                    @foreach ($productsFilters['fitArray'] as $fit)
                                        <option value="{{ $fit }}"
                                            {{ old('fit', $product->fit ?? '') == $fit ? 'selected' : '' }}>
                                            {{ $fit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="occasion">Product Occasion</label>
                                <select name="occasion" id="occasion" class="form-control">
                                    @foreach ($productsFilters['occasionArray'] as $occasion)
                                        <option value="{{ $occasion }}"
                                            {{ old('occasion', $product->occasion ?? '') == $occasion ? 'selected' : '' }}>
                                            {{ $occasion }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="weight">Product Weight</label>
                                <input type="number" id="weight" name="weight" class="form-control" rows="3"
                                    placeholder="Enter product weight"
                                    value="{{ old('weight', $product->weight ?? '') }}">
                            </div>



                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                                @if (!empty($product->image))
                                    <div class="mt-3 mb-3"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <img style="width: 15%;"
                                            src="{{ asset('front/images/products/' . $product->image) }}">
                                        <a class="confirmDelete" title="Delete Product Image" href="javascript:void(0);"
                                            record="product-image" recordid="{{ $product->id }}" <?php /* href="{{ url('admin/delete-product/' . $product->id) }}" */ ?>>
                                            <i class="fas fa-trash ml-4" style="color: #bb0101"></i>
                                        </a>
                                        <input type="hidden" name="current_image" value="{{ $product->image }}">
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="video">Video</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="video" class="custom-file-input" id="video">
                                        <label class="custom-file-label" for="video">Choose file</label>
                                    </div>
                                </div>
                                {{-- @if (!empty($product->video))
                                    <div class="mt-3 mb-3"
                                        style="display: flex; justify-content: center; align-items: center;">
                                        <img style="width: 15%;"
                                            src="{{ asset('front/videos/' . $product->video) }}">
                                        <a class="confirmDelete" title="Delete Product Video" href="javascript:void(0);"
                                            record="product-video" recordid="{{ $product->id }}" <?php /* href="{{ url('admin/delete-product/' . $product->id) }}" */ ?>>
                                            <i class="fas fa-trash ml-4" style="color: #bb0101"></i>
                                        </a>
                                        <input type="hidden" name="current_video" value="{{ $product->video }}">
                                    </div>
                                @endif --}}
                            </div>

                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" id="meta_title"
                                    placeholder="Enter meta title"
                                    @if (!empty($product->meta_title)) value="{{ $product->meta_title }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea id="meta_description" name="meta_description" class="form-control" rows="3"
                                    placeholder="Enter meta description">
                                @if (!empty($product->meta_description))
{{ $product->meta_description }}
@endif
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <input type="text" name="meta_keyword" class="form-control" id="meta_keyword"
                                    placeholder="Enter meta keywords"
                                    @if (!empty($product->meta_keyword)) value="{{ $product->meta_keyword }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="is_featured">Featured Item</label>
                                <br>
                                <input type="checkbox" name="is_featured" value="Yes" id="is_featured">
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
