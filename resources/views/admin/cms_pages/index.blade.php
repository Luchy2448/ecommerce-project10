@extends('admin.layout.layout')

@section('content')
    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">CMS Pages</h3>
                            <a href="add-edit-cms-page" class="btn btn-primary float-right"
                                style="background-color: #17a2b8">Add CMS Page</a>
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
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cmsPages as $cmsPage)
                                        <tr>
                                            <td>{{ $cmsPage->id }}</td>
                                            <td>{{ $cmsPage->title }}</td>
                                            {{-- <td>{{ $cmsPage->description }}</td> --}}
                                            <td>{{ $cmsPage->url }}</td>
                                            <td>{{ $cmsPage->created_at }}</td>
                                            <td>
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
                                                {{-- <a href="#" class="btn btn-primary">Edit</a>
                                                <form action="#" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form> --}}
                                            </td>
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
@endsection
