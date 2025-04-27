<?php

namespace App\Http\Requests\ManagePatient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNewPatient extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'identity_number' => ['required', 'numeric', 'unique:patients,identity_number'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', Rule::in(['L', 'P'])],
            'blood_type' => ['required', Rule::in(['A', 'B', 'AB', 'O'])],
            'phone_number' => ['required', 'string', 'max:15'],
            'email' => ['required', 'email', 'unique:patients,email'],
            'address' => ['required', 'string'],
            'allergies' => ['required', 'string'],
            'current_medicines' => ['required', 'string'],
            'medical_history' => ['required', 'string'],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'identity_number.required' => 'NIK wajib diisi.',
            'identity_number.numeric' => 'NIK harus berupa angka.',
            'identity_number.unique' => 'NIK sudah terdaftar.',
            'first_name.required' => 'Nama depan wajib diisi.',
            'first_name.string' => 'Nama depan harus berupa teks.',
            'first_name.max' => 'Nama depan tidak boleh lebih dari 255 karakter.',
            'last_name.required' => 'Nama belakang wajib diisi.',
            'last_name.string' => 'Nama belakang harus berupa teks.',
            'last_name.max' => 'Nama belakang tidak boleh lebih dari 255 karakter.',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
            'birth_date.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'gender.in' => 'Jenis kelamin harus berupa Laki-Laki (L) atau Perempuan (P).',
            'blood_type.required' => 'Golongan darah wajib dipilih.',
            'blood_type.in' => 'Golongan darah harus berupa A, B, AB, atau O.',
            'phone_number.required' => 'Nomor HP wajib diisi.',
            'phone_number.string' => 'Nomor HP harus berupa teks.',
            'phone_number.max' => 'Nomor HP tidak boleh lebih dari 15 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'address.required' => 'Alamat wajib diisi.',
            'address.string' => 'Alamat harus berupa teks.',
            'allergies.required' => 'Alergi wajib diisi.',
            'allergies.string' => 'Alergi harus berupa teks.',
            'current_medicines.required' => 'Konsumsi obat saat ini wajib diisi.',
            'current_medicines.string' => 'Konsumsi obat saat ini harus berupa teks.',
            'medical_history.required' => 'Histori medis wajib diisi.',
            'medical_history.string' => 'Histori medis harus berupa teks.',
        ];
    }
}
