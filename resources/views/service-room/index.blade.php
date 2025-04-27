@extends('layouts.app')

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Data Ruang Pelayanan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ruang Pelayanan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('main-content')
    <div class="card">
        <div class="card-header">
            <button class="btn btn-info" data-toggle="modal" data-target="#addServiceRoomModal">
                <i class="fas fa-plus"></i>
                &nbsp;&nbsp;Tambah Ruang Pelayanan
            </button>
        </div>
        <div class="card-body">
            <table id="tableData" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th> Ruang Pelayanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($service_rooms as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->name }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning edit-btn"
                                    data-url="{{ route('service-room.update', $data->id) }}"
                                    data-name="{{ $data->name }}" data-toggle="modal"
                                    data-target="#editServiceRoomModal">
                                    <i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Edit
                                </a>
                                <button type="button" class="btn btn-sm btn-danger delete-btn"
                                    data-url="{{ route('service-room.destroy', $data->id) }}" data-toggle="modal"
                                    data-target="#deleteServiceRoomModal">
                                    <i class="fas fa-trash"></i>&nbsp;&nbsp;Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- Modal Tambah Jenis Ruang Pelayanan -->
    <div class="modal fade" id="addServiceRoomModal" tabindex="-1" aria-labelledby="addServiceRoomModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="addServiceRoomForm" method="POST" action="{{ route('service-room.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addServiceRoomModalLabel">Tambah Jenis Ruang Pelayanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ServiceRoomName" class="form-label">Nama Jenis Ruang Pelayanan</label>
                            <input type="text" class="form-control" id="ServiceRoomName" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Jenis Ruang Pelayanan -->
    <div class="modal fade" id="editServiceRoomModal" tabindex="-1" aria-labelledby="editServiceRoomModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="editServiceRoomForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editServiceRoomModalLabel">Edit Jenis Ruang Pelayanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editServiceRoomName" class="form-label">Nama Jenis Ruang Pelayanan</label>
                            <input type="text" class="form-control" id="editServiceRoomName" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteServiceRoomModal" tabindex="-1" aria-labelledby="deleteServiceRoomModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteServiceRoomModalLabel">Hapus Jenis Ruang Pelayanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus jenis Ruang Pelayanan ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}",
                });
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Toast.fire({
                    icon: 'error',
                    title: "{{ session('error') }}",
                });
            });
        </script>
    @endif

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $("#tableData").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            // Edit Document Type
            const editButtons = document.querySelectorAll('.edit-btn');
            const editModal = document.getElementById('editServiceRoomModal');
            const editForm = document.getElementById('editServiceRoomForm');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    const name = this.getAttribute('data-name');

                    editForm.setAttribute('action', url);
                    document.getElementById('editServiceRoomName').value = name;

                    $(editModal).modal('show'); // Use jQuery to show the modal
                });
            });

            // Delete Document Type
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const deleteModal = document.getElementById('deleteServiceRoomModal');
            const deleteForm = document.getElementById('deleteForm');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    deleteForm.setAttribute('action', url);
                    $(deleteModal).modal('show'); // Use jQuery to show the modal
                });
            });
        });
    </script>
@endpush
