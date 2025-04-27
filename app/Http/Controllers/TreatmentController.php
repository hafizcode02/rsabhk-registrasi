<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $treatments = Treatment::all();
        return view('treatment.index', compact('treatments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
        ]);

        Treatment::create($data);

        return redirect()->route('treatment.index')
            ->with('success', 'Jenis Tindakan berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
        ]);

        $insurance = Treatment::findOrFail($id);
        $insurance->update($data);

        return redirect()->route('treatment.index')
            ->with('success', 'Jenis Tindakan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $insurance = Treatment::findOrFail($id);
        $insurance->delete();

        return redirect()->route('treatment.index')
            ->with('success', 'Jenis Tindakan berhasil dihapus.');
    }
}
