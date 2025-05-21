@extends('admin.layout.layout')

@section('content')
    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">CMS Pages</h3>
                            @if ($pagesModule['add_access'] == 1 || $pagesModule['full_access'] == 1)
                                <a href="add-edit-cms-page" class="btn btn-primary float-right"
                                    style="background-color: #17a2b8">Add CMS Page</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="cmspages" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        {{-- <th>Description</th> --}}
                                        <th>URL</th>
                                        <th>Created on</th>
                                        @if ($pagesModule['edit_access'] == 1 || $pagesModule['full_access'] == 1)
                                            <th>Status</th>
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cmsPages as $cmsPage)
                                        <tr>
                                            <td>{{ $cmsPage->id }}</td>
                                            <td style="width: 30%">{{ $cmsPage->title }}</td>
                                            {{-- <td>{{ $cmsPage->description }}</td> --}}
                                            <td style="width: 30%">{{ $cmsPage->url }}</td>
                                            <td>{{ date('d-m-Y', strtotime($cmsPage->created_at)) }}</td>


                                            @if ($pagesModule['edit_access'] == 1 || $pagesModule['full_access'] == 1)
                                                <td class="text-center">
                                                    @if ($cmsPage->status == 1)
                                                        <a href="javascript:void(0);" class="updateCmsPageStatus"
                                                            id="page-{{ $cmsPage->id }}" page_id="{{ $cmsPage->id }}"
                                                            status="Active" style="color: #135964">
                                                            <i class="fas fa-toggle-on"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0);" class="updateCmsPageStatus"
                                                            id="page-{{ $cmsPage->id }}" page_id="{{ $cmsPage->id }}"
                                                            status="Inactive">
                                                            <i class="fas fa-toggle-off" style="color: grey;"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            @endif


                                            @if ($pagesModule['edit_access'] == 1 || $pagesModule['full_access'] == 1)
                                                <td class="text-center">
                                                    <a href="{{ url('admin/add-edit-cms-page/' . $cmsPage->id) }}">
                                                        <i class="fas fa-edit" style="color: #135964"></i>
                                                    </a>
                                            @endif
                                            @if ($pagesModule['full_access'] == 1)
                                                <form action="{{ url('admin/delete-cms-page/' . $cmsPage->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a class="confirmDelete" name="CMS Page" title="Delete CMS Page"
                                                        href="javascript:void(0);" record="cms-page"
                                                        recordid="{{ $cmsPage->id }}" <?php /* href="{{ url('admin/delete-cms-page/' . $cmsPage->id) }}" */ ?>>
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
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#cmspages").DataTable();
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
