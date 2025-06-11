@extends('admin.layout.layout')

@section('content')
    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Products</h3>

                            @if ($productsModule['add_access'] == 1 || $productsModule['full_access'] == 1)
                                <a href="add-edit-product" class="btn btn-primary float-right"
                                    style="background-color: #17a2b8">Add Product</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="product" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Color</th>
                                        <th>Category</th>
                                        <th>Parent Category</th>
                                        <th>Size</th>
                                        <th>Price</th>

                                        <th>Created on</th>
                                        @if ($productsModule['edit_access'] == 1 || $productsModule['full_access'] == 1)
                                            <th class="text-center">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product->color }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>
                                                @if (!empty($product->category->parentCategory))
                                                    {{ $product->category->parentCategory->name }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $product->size }}</td>
                                            <td>{{ $product->price }}</td>

                                            <td>{{ date('d-m-Y', strtotime($product->created_at)) }}</td>


                                            @if ($productsModule['edit_access'] == 1 || $productsModule['full_access'] == 1)
                                                <td class="text-center">
                                                    @if ($product->status == 1)
                                                        <a href="javascript:void(0);" class="updateProductStatus"
                                                            id="product-{{ $product->id }}"
                                                            product_id="{{ $product->id }}" status="Active"
                                                            style="color: #135964">
                                                            <i class="fas fa-toggle-on"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0);" class="updateProductStatus"
                                                            id="product-{{ $product->id }}"
                                                            product_id="{{ $product->id }}" status="Inactive">
                                                            <i class="fas fa-toggle-off" style="color: grey;"></i>
                                                        </a>
                                                    @endif
                                            @endif


                                            @if ($productsModule['edit_access'] == 1 || $productsModule['full_access'] == 1)
                                                <a href="{{ url('admin/add-edit-product/' . $product->id) }}">
                                                    <i class="fas fa-edit" style="color: #135964"></i>
                                                </a>
                                            @endif
                                            @if ($productsModule['full_access'] == 1)
                                                <form action="{{ url('admin/delete-product/' . $product->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a class="confirmDelete" name="Product" title="Delete Product"
                                                        href="javascript:void(0);" record="product"
                                                        recordid="{{ $product->id }}" <?php /* href="{{ url('admin/delete-product/' . $product->id) }}" */ ?>>
                                                        <i class="fas fa-trash" style="color: #135964"></i>
                                                    </a>
                                                </form>
                                                </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@section('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <!-- Categorie specific script -->
    <script>
        $(function() {
            $("#product").DataTable();
        });
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
