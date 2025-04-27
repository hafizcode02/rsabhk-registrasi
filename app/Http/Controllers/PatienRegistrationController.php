<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManageRegistration\StoreNewRegistration;
use App\Http\Requests\ManageRegistration\UpdateRegistration;
use App\Models\Insurance;
use App\Models\PatienRegistration;
use App\Models\Patient;
use App\Models\ServiceRoom;
use Illuminate\Http\Request;

class PatienRegistrationController extends Controller
{
    public function index()
    {
        $registrations = PatienRegistration::with(['user', 'patient', 'insurance', 'service_room'])->get();
        return view('registration.index', compact('registrations'));
    }

    public function create()
    {
        $patients = Patient::all();
        $insurances = Insurance::all();
        $serviceRooms = ServiceRoom::all();
        return view('registration.add', compact('patients', 'insurances', 'serviceRooms'));
    }

    public function store(StoreNewRegistration $request)
    {
        $validatedData = $request->validated();
        $data = [
            'registration_date' => $validatedData['registration_date'],
            'patient_id' => $validatedData['patient_id'],
            'insurance_id' => $validatedData['insurance_id'],
            'insurance_number' => $validatedData['insurance_number'],
            'service_room_id' => $validatedData['service_room_id'],
            'responsible_person_name' => $validatedData['responsible_person_name'],
            'responsible_person_phone' => $validatedData['responsible_person_phone'],
            'responsible_email' => $validatedData['responsible_email'],
            'responsible_person_relationship' => $validatedData['responsible_person_relationship'],
            'responsible_person_address' => $validatedData['responsible_person_address'],
            'user_id' => auth()->id(),
        ];

        PatienRegistration::create($data);


        return redirect()->route('patient-registration.index')->with('success', 'Pendaftaran pasien berhasil.');
    }

    public function edit($id)
    {
        $registration = PatienRegistration::findOrFail($id);
        $patients = Patient::all();
        $insurances = Insurance::all();
        $serviceRooms = ServiceRoom::all();

        return view('registration.edit', compact('registration', 'patients', 'insurances', 'serviceRooms'));
    }

    public function update(UpdateRegistration $request, $id)
    {
        $registration = PatienRegistration::findOrFail($id);
        $validatedData = $request->validated();
        $data = [
            'registration_date' => $validatedData['registration_date'],
            'patient_id' => $validatedData['patient_id'],
            'insurance_id' => $validatedData['insurance_id'],
            'insurance_number' => $validatedData['insurance_number'],
            'service_room_id' => $validatedData['service_room_id'],
            'responsible_person_name' => $validatedData['responsible_person_name'],
            'responsible_person_phone' => $validatedData['responsible_person_phone'],
            'responsible_email' => $validatedData['responsible_email'],
            'responsible_person_relationship' => $validatedData['responsible_person_relationship'],
            'responsible_person_address' => $validatedData['responsible_person_address'],
            'user_id' => auth()->id(),
        ];

        $registration->update($data);

        return redirect()->route('patient-registration.index')->with('success', 'Pendaftaran pasien berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $registration = PatienRegistration::findOrFail($id);
        $registration->delete();

        return redirect()->route('patient-registration.index')->with('success', 'Pendaftaran pasien berhasil dihapus.');
    }
}
