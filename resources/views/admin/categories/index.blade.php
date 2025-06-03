@extends('admin.layout.layout')

@section('content')
    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Categories</h3>

                            @if ($categoriesModule['add_access'] == 1 || $categoriesModule['full_access'] == 1)
                                <a href="add-edit-category" class="btn btn-primary float-right"
                                    style="background-color: #17a2b8">Add Category</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="category" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        {{-- <th>Description</th> --}}
                                        <th>Parent Category</th>
                                        <th>URL</th>
                                        <th>Created on</th>
                                        @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1)
                                            <th class="text-center">Status</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @if (isset($category->parentCategory->name))
                                                    {{ $category->parentCategory->name }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>

                                            <td style="width: 30%">{{ $category->url }}</td>
                                            <td>{{ date('d-m-Y', strtotime($category->created_at)) }}</td>


                                            @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1)
                                                <td class="text-center">
                                                    @if ($category->status == 1)
                                                        <a href="javascript:void(0);" class="updateCategoryStatus"
                                                            id="category-{{ $category->id }}"
                                                            category_id="{{ $category->id }}" status="Active"
                                                            style="color: #135964">
                                                            <i class="fas fa-toggle-on"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0);" class="updateCategoryStatus"
                                                            id="category-{{ $category->id }}"
                                                            category_id="{{ $category->id }}" status="Inactive">
                                                            <i class="fas fa-toggle-off" style="color: grey;"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            @endif


                                            @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1)
                                                <td class="text-center">
                                                    <a href="{{ url('admin/add-edit-category/' . $category->id) }}">
                                                        <i class="fas fa-edit" style="color: #135964"></i>
                                                    </a>
                                            @endif
                                            @if ($categoriesModule['full_access'] == 1)
                                                <form action="{{ url('admin/delete-category/' . $category->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a class="confirmDelete" name="Category" title="Delete Category"
                                                        href="javascript:void(0);" record="category"
                                                        recordid="{{ $category->id }}" <?php /* href="{{ url('admin/delete-category/' . $category->id) }}" */ ?>>
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
            $("#category").DataTable();
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
