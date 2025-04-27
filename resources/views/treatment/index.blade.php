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
                    <h1 class="m-0">Manajemen Data Tindakan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tindakan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('main-content')
    <div class="card">
        <div class="card-header">
            <button class="btn btn-info" data-toggle="modal" data-target="#add">
                <i class="fas fa-plus"></i>
                &nbsp;&nbsp;Tambah Tindakan
            </button>
        </div>
        <div class="card-body">
            <table id="tableData" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tindakan</th>
                        <th>Harga Tindakan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($treatments as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->name }}</td>
                            <td>Rp. {{ number_format($data->fee) }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning edit-btn"
                                    data-url="{{ route('treatment.update', $data->id) }}" data-name="{{ $data->name }}"
                                    data-fee="{{ $data->fee }}" data-toggle="modal" data-target="#edit">
                                    <i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Edit
                                </a>
                                <button type="button" class="btn btn-sm btn-danger delete-btn"
                                    data-url="{{ route('treatment.destroy', $data->id) }}" data-toggle="modal"
                                    data-target="#delete">
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

    <!-- Modal Tambah Tindakan -->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addTreatmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addtreatmentForm" method="POST" action="{{ route('treatment.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTreatmentModalLabel">Tambah Tindakan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="treatmentName" class="form-label">Nama Tindakan</label>
                            <input type="text" class="form-control" id="treatmentName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="treatmentPrice" class="form-label">Harga Tindakan</label>
                            <input type="number" class="form-control" id="treatmentPrice" name="fee" required>
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

    <!-- Modal Edit Tindakan -->
    <div class="modal fade" id="editTreatmentModal" tabindex="-1" aria-labelledby="editTreatmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="edittreatmentForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTreatmentModalLabel">Edit Tindakan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edittreatmentName" class="form-label">Nama Tindakan</label>
                            <input type="text" class="form-control" id="edittreatmentName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edittreatmentPrice" class="form-label">Harga Tindakan</label>
                            <input type="number" class="form-control" id="edittreatmentPrice" name="fee" required>
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
    <div class="modal fade" id="deleteTreatmentModal" tabindex="-1" aria-labelledby="deleteTreatmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTreatmentModalLabel">Hapus Tindakan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Tindakan ini?
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
            const editModal = document.getElementById('editTreatmentModal');
            const editForm = document.getElementById('edittreatmentForm');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    const name = this.getAttribute('data-name');
                    const fee = this.getAttribute('data-fee');

                    editForm.setAttribute('action', url);
                    document.getElementById('edittreatmentName').value = name;
                    document.getElementById('edittreatmentPrice').value = fee;

                    $(editModal).modal('show'); // Use jQuery to show the modal
                });
            });

            // Delete Document Type
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const deleteModal = document.getElementById('deleteTreatmentModal');
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
