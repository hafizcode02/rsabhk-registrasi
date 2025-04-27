<?php

namespace App\Http\Requests\ManageRegistration;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNewRegistration extends FormRequest
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
            'registration_date' => ['required', 'date'],
            'patient_id' => ['required', 'exists:patients,id'],
            'insurance_id' => ['required', 'exists:insurances,id'],
            'insurance_number' => ['required', 'numeric'],
            'service_room_id' => ['required', 'exists:service_rooms,id'],
            'responsible_person_name' => ['required', 'string', 'max:255'],
            'responsible_person_phone' => ['required', 'string', 'max:15'],
            'responsible_email' => ['required', 'email', 'max:255'],
            'responsible_person_relationship' => ['required', 'string', 'max:100'],
            'responsible_person_address' => ['required', 'string', 'max:500'],
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
            'registration_date.required' => 'Tanggal registrasi wajib diisi.',
            'registration_date.date' => 'Tanggal registrasi harus berupa tanggal yang valid.',
            'patient_id.required' => 'Pasien wajib dipilih.',
            'patient_id.exists' => 'Pasien yang dipilih tidak valid.',
            'insurance_id.required' => 'Asuransi wajib dipilih.',
            'insurance_id.exists' => 'Asuransi yang dipilih tidak valid.',
            'insurance_number.required' => 'Nomor asuransi wajib diisi.',
            'insurance_number.string' => 'Nomor asuransi harus berupa teks.',
            'insurance_number.max' => 'Nomor asuransi tidak boleh lebih dari 20 karakter.',
            'service_room_id.required' => 'Ruangan layanan wajib dipilih.',
            'service_room_id.exists' => 'Ruangan layanan yang dipilih tidak valid.',
            'responsible_person_name.required' => 'Nama penanggung jawab wajib diisi.',
            'responsible_person_name.string' => 'Nama penanggung jawab harus berupa teks.',
            'responsible_person_name.max' => 'Nama penanggung jawab tidak boleh lebih dari 255 karakter.',
            'responsible_person_phone.required' => 'Nomor HP penanggung jawab wajib diisi.',
            'responsible_person_phone.string' => 'Nomor HP penanggung jawab harus berupa teks.',
            'responsible_person_phone.max' => 'Nomor HP penanggung jawab tidak boleh lebih dari 15 karakter.',
            'responsible_email.required' => 'Email penanggung jawab wajib diisi.',
            'responsible_email.email' => 'Email penanggung jawab harus berupa alamat email yang valid.',
            'responsible_email.max' => 'Email penanggung jawab tidak boleh lebih dari 255 karakter.',
            'responsible_person_relationship.required' => 'Hubungan dengan pasien wajib diisi.',
            'responsible_person_relationship.string' => 'Hubungan dengan pasien harus berupa teks.',
            'responsible_person_relationship.max' => 'Hubungan dengan pasien tidak boleh lebih dari 100 karakter.',
            'responsible_person_address.required' => 'Alamat penanggung jawab wajib diisi.',
            'responsible_person_address.string' => 'Alamat penanggung jawab harus berupa teks.',
            'responsible_person_address.max' => 'Alamat penanggung jawab tidak boleh lebih dari 500 karakter.',
        ];
    }
}
