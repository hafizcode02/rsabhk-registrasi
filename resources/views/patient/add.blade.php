@extends('layouts.app')
@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Pasien</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Pasien</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data Pasien</h3>
                </div>
                <form action="{{ route('patient-management.store') }}" method="POST">
                    @csrf
                    <div class="card-body" style="padding-bottom: 0.5rem">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NIK <strong class="text-danger">*</strong></label>
                                    <input name="identity_number" type="number" class="form-control"
                                        placeholder="Masukan NIK" value="{{ old('identity_number') }}" required>
                                    @error('identity_number')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Depan <strong class="text-danger">*</strong></label>
                                    <input name="first_name" type="text" class="form-control"
                                        placeholder="Masukan Nama Depan" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Belakang <strong class="text-danger">*</strong></label>
                                    <input name="last_name" type="text" class="form-control"
                                        placeholder="Masukan Nama Belakang" value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir <strong class="text-danger">*</strong></label>
                                    <input name="birth_date" type="date" class="form-control" placeholder="Tanggal Lahir"
                                        value="{{ old('birth_date') }}" required>
                                    @error('birth_date')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin <strong class="text-danger">*</strong></label>
                                    <select name="gender" class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-Laki
                                        </option>
                                        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                    @error('gender')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>No. HP <strong class="text-danger">*</strong></label>
                                    <input name="phone_number" type="text" class="form-control" placeholder="No. HP"
                                        value="{{ old('phone_number') }}" required>
                                    @error('phone_number')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Contact Email <strong class="text-danger">*</strong></label>
                                    <input name="email" type="email" class="form-control" placeholder="Masukan Email"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Golongan Darah <strong class="text-danger">*</strong></label>
                                    <select name="blood_type" class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="A" {{ old('blood_type') == 'A' ? 'selected' : '' }}>A </option>
                                        <option value="B" {{ old('blood_type') == 'B' ? 'selected' : '' }}>B
                                        </option>
                                        <option value="AB" {{ old('blood_type') == 'AB' ? 'selected' : '' }}>AB
                                        </option>
                                        <option value="O" {{ old('blood_type') == 'O' ? 'selected' : '' }}>O
                                        </option>
                                        <option value="Lainnya" {{ old('blood_type') == 'Lainnya' ? 'selected' : '' }}>
                                            Lainnya
                                        </option>
                                    </select>
                                    @error('gender')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat <strong class="text-danger">*</strong></label>
                                    <textarea class="form-control" name="address" cols="20" rows="3" placeholder="Masukan Alamat" required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alergi: <strong class="text-danger">*</strong></label>
                                    <textarea class="form-control" name="allergies" cols="20" rows="3" placeholder="Sebutkan alergi jika ada"
                                        required>{{ old('allergies') }}</textarea>
                                    @error('allergies')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Konsumsi Obat Saat Ini: <strong class="text-danger">*</strong></label>
                                    <textarea class="form-control" name="current_medicines" cols="20" rows="3"
                                        placeholder="Obat yang dikonsumsi saat ini, contoh : bodrex, almodipine" required>{{ old('current_medicines') }}</textarea>
                                    @error('current_medicines')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Histori Medis: <strong class="text-danger">*</strong></label>
                                    <textarea class="form-control" name="medical_history" cols="20" rows="3"
                                        placeholder="Histori medis pasien" required>{{ old('medical_history') }}</textarea>
                                    @error('medical_history')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="text-muted float-start ml-4">
                        <strong class="text-danger">*</strong> Wajib Diisi
                    </span>
                    <div class="card-footer mt-2">
                        <button type="button" class="btn btn-primary" onclick="history.back()">Kembali</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
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
@endpush
