@extends('layouts.app')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            height: 38px !important;
        }
    </style>
@endpush
@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Registrasi Pasien</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Registrasi Pasien</li>
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
                    <h3 class="card-title">Form Edit Registrasi Pasien</h3>
                </div>
                <form action="{{ route('patient-registration.update', $registration->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Registrasi <strong class="text-danger">*</strong></label>
                                    <input name="registration_date" type="date" class="form-control"
                                        value="{{ old('registration_date', $registration->registration_date) }}" required>
                                    @error('registration_date')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Pasien <strong class="text-danger">*</strong></label>
                                    <select name="patient_id" class="form-control select2" required>
                                        <option value="">-- Pilih Pasien --</option>
                                        @foreach ($patients as $patient)
                                            <option value="{{ $patient->id }}"
                                                {{ old('patient_id', $registration->patient_id) == $patient->id ? 'selected' : '' }}>
                                                {{ $patient->first_name }} {{ $patient->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('patient_id')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Asuransi <strong class="text-danger">*</strong></label>
                                    <select name="insurance_id" class="form-control" required>
                                        <option value="">-- Pilih Asuransi --</option>
                                        @foreach ($insurances as $insurance)
                                            <option value="{{ $insurance->id }}"
                                                {{ old('insurance_id', $registration->insurance_id) == $insurance->id ? 'selected' : '' }}>
                                                {{ $insurance->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('insurance_id')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>No. Asuransi <strong class="text-danger">*</strong></label>
                                    <input name="insurance_number" type="number" class="form-control"
                                        value="{{ old('insurance_number', $registration->insurance_number) }}" required>
                                    @error('insurance_number')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Ruangan Layanan <strong class="text-danger">*</strong></label>
                                    <select name="service_room_id" class="form-control" required>
                                        <option value="">-- Pilih Ruangan --</option>
                                        @foreach ($serviceRooms as $serviceRoom)
                                            <option value="{{ $serviceRoom->id }}"
                                                {{ old('service_room_id', $registration->service_room_id) == $serviceRoom->id ? 'selected' : '' }}>
                                                {{ $serviceRoom->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service_room_id')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Penanggung Jawab <strong class="text-danger">*</strong></label>
                                    <input name="responsible_person_name" type="text" class="form-control"
                                        value="{{ old('responsible_person_name', $registration->responsible_person_name) }}"
                                        required>
                                    @error('responsible_person_name')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>No. HP Penanggung Jawab <strong class="text-danger">*</strong></label>
                                    <input name="responsible_person_phone" type="text" class="form-control"
                                        value="{{ old('responsible_person_phone', $registration->responsible_person_phone) }}"
                                        required>
                                    @error('responsible_person_phone')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email Penanggung Jawab <strong class="text-danger">*</strong></label>
                                    <input name="responsible_email" type="email" class="form-control"
                                        value="{{ old('responsible_email', $registration->responsible_email) }}" required>
                                    @error('responsible_email')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Hubungan dengan Pasien <strong class="text-danger">*</strong></label>
                                    <input name="responsible_person_relationship" type="text" class="form-control"
                                        value="{{ old('responsible_person_relationship', $registration->responsible_person_relationship) }}"
                                        required>
                                    @error('responsible_person_relationship')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat Penanggung Jawab <strong class="text-danger">*</strong></label>
                                    <textarea name="responsible_person_address" class="form-control" rows="3" required>{{ old('responsible_person_address', $registration->responsible_person_address) }}</textarea>
                                    @error('responsible_person_address')
                                        <small style="color: red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" onclick="history.back()">Kembali</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "-- Pilih Pasien --",
                allowClear: true,
                width: '100%',
            });
        });
    </script>
@endpush
