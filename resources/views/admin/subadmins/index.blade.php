@extends('admin.layout.layout')

@section('content')
    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sub Admins</h3>
                            <a href="add-edit-subadmin" class="btn btn-primary float-right"
                                style="background-color: #17a2b8">Add
                                Sub Admin</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="cmspages" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Created on</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subadmins as $subadmin)
                                        <tr>
                                            <td>{{ $subadmin->id }}</td>
                                            <td>{{ $subadmin->name }}</td>
                                            <td>{{ $subadmin->mobile }}</td>
                                            <td>{{ $subadmin->email }}</td>
                                            <td>{{ $subadmin->type }}</td>

                                            <td>{{ date('d-m-Y', strtotime($subadmin->created_at)) }}</td>
                                            <td class="text-center">
                                                @if ($subadmin->status == 1)
                                                    <a href="javascript:void(0);" class="updateSubadminStatus"
                                                        id="subadmin-{{ $subadmin->id }}"subadmin_id="{{ $subadmin->id }}"
                                                        status="Active" style="color: #135964">
                                                        <i class="fas fa-toggle-on"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0);" class="updateSubadminStatus"
                                                        id="subadmin-{{ $subadmin->id }}"subadmin_id="{{ $subadmin->id }}"
                                                        status="Inactive">
                                                        <i class="fas fa-toggle-off" style="color: grey;"></i>
                                                    </a>
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url('admin/add-edit-subadmin/' . $subadmin->id) }}">
                                                    <i class="fas fa-edit" style="color: #135964"></i>
                                                </a>
                                                <form action="{{ url('admin/subadmin-delete/' . $subadmin->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="confirmDelete" name="Subadmin" title="Delete Sub Admin"
                                                        href="javascript:void(0);" record="subadmin"
                                                        recordid="{{ $subadmin->id }}" <?php /* href="{{ url('admin/subadmin-delete/' . $subadmin->id) }}" */ ?>>
                                                        <i class="fas fa-trash" style="color: #135964"></i>
                                                    </a>
                                                </form>
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
            $("#subadmins").DataTable();
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
@endsection
