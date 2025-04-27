@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@extends('layouts.app')
@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Transaksi Registrasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Transaksi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('main-content')
    <div id="transaction_data">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Data Registrasi Pasien</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Registrasi:</label>
                                    <p>{{ $registration->registration_date }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Pasien:</label>
                                    <p>{{ $registration->patient->first_name }} {{ $registration->patient->last_name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Asuransi:</label>
                                    <p>{{ $registration->insurance->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>No. Asuransi:</label>
                                    <p>{{ $registration->insurance_number }}</p>
                                </div>
                            </div>
                            <!-- Middle Column -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ruangan Layanan:</label>
                                    <p>{{ $registration->service_room->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Nama Penanggung Jawab:</label>
                                    <p>{{ $registration->responsible_person_name }}</p>
                                </div>
                                <div class="form-group">
                                    <label>No. HP Penanggung Jawab:</label>
                                    <p>{{ $registration->responsible_person_phone }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Email Penanggung Jawab:</label>
                                    <p>{{ $registration->responsible_email }}</p>
                                </div>
                            </div>
                            <!-- Right Column -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Hubungan dengan Pasien:</label>
                                    <p>{{ $registration->responsible_person_relationship }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Alamat Penanggung Jawab:</label>
                                    <p>{{ $registration->responsible_person_address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-info" data-toggle="modal" data-target="#addTransactionModal">
                            <i class="fas fa-plus"></i>
                            &nbsp;&nbsp;Tambah Tindakan
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="tableData" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tindakan</th>
                                    <th>Jumlah</th>
                                    <th>Fee Tindakan</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $index => $data)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data->treatment->name }}</td>
                                        <td>{{ $data->amount }}</td>
                                        <td>{{ number_format($data->treatment->fee, 0, ',', '.') }}</td>
                                        <td>{{ number_format($data->treatment->fee * $data->amount) }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-warning edit-btn"
                                                data-url="{{ route('transaction.update', $data->id) }}"
                                                data-name="{{ $data->treatment_id }}" data-amount="{{ $data->amount }}"
                                                data-toggle="modal" data-target="#editTransactionModal">
                                                <i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Edit
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                data-url="{{ route('transaction.destroy', $data->id) }}"
                                                data-toggle="modal" data-target="#deleteTransactionModal">
                                                <i class="fas fa-trash"></i>&nbsp;&nbsp;Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-3">
                            <h5 class="font-weight-bold">
                                Total Tindakan:
                                {{ number_format(
                                    $transactions->sum(function ($transaction) {
                                        return $transaction->treatment->fee * $transaction->amount;
                                    }),
                                    0,
                                    ',',
                                    '.',
                                ) }}
                            </h5>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- Modal Tambah Jenis Tindakan -->
                <div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="addTransactionForm" method="POST"
                            action="{{ route('transaction.store', $registration->id) }}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addTransactionModalLabel">Tambah Jenis Tindakan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="TransactionName" class="form-label">Nama Jenis Tindakan</label>
                                        <select class="form-control" id="TransactionName" name="treatment_id" required>
                                            <option value="">-- Pilih Jenis Tindakan --</option>
                                            @foreach ($treatments as $treatment)
                                                <option value="{{ $treatment->id }}">{{ $treatment->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="TransactionAmount" class="form-label">Jumlah Tindakan</label>
                                        <input type="number" class="form-control" id="TransactionAmount" name="amount"
                                            required>
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

                <!-- Modal Edit Jenis Tindakan -->
                <div class="modal fade" id="editTransactionModal" tabindex="-1"
                    aria-labelledby="editTransactionModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="editTransactionForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editTransactionModalLabel">Edit Jenis Tindakan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="editTransactionName" class="form-label">Nama Jenis Tindakan</label>
                                        <select class="form-control" id="editTransactionName" name="treatment_id"
                                            required>
                                            <option value="">-- Pilih Jenis Tindakan --</option>
                                            @foreach ($treatments as $treatment)
                                                <option value="{{ $treatment->id }}">{{ $treatment->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editTransactionAmount" class="form-label">Jumlah Tindakan</label>
                                        <input type="number" class="form-control" id="editTransactionAmount"
                                            name="amount" required>
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
                <div class="modal fade" id="deleteTransactionModal" tabindex="-1"
                    aria-labelledby="deleteTransactionModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteTransactionModalLabel">Hapus Jenis Tindakan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus jenis Tindakan ini?
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
            </div>
        </div>

    </div>

    <div class="row mb-2">
        <div class="col-12">
            <button class="btn btn-primary">
                <i class="fas fa-envelope"></i>&nbsp;&nbsp;Kirim Tagihan
            </button>
            <a href="{{ route('patient-registration.index') }}" class="btn btn-secondary">Kembali</a>
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
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });

            // Edit Document Type
            const editButtons = document.querySelectorAll('.edit-btn');
            const editModal = document.getElementById('editTransactionModal');
            const editForm = document.getElementById('editTransactionForm');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    const name = this.getAttribute('data-name');
                    const amount = this.getAttribute('data-amount');

                    editForm.setAttribute('action', url);
                    document.getElementById('editTransactionName').value = name;
                    document.getElementById('editTransactionAmount').value = amount;

                    $(editModal).modal('show'); // Use jQuery to show the modal
                });
            });

            // Delete Document Type
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const deleteModal = document.getElementById('deleteTransactionModal');
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
