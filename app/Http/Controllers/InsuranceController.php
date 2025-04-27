<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $insurances = Insurance::all();
        return view('insurance.index', compact('insurances'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Insurance::create($request->all());

        return redirect()->route('insurance.index')
            ->with('success', 'Jenis Asuransi berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $insurance = insurance::findOrFail($id);
        $insurance->update($request->all());

        return redirect()->route('insurance.index')
            ->with('success', 'Jenis Asuransi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $insurance = insurance::findOrFail($id);
        $insurance->delete();

        return redirect()->route('insurance.index')
            ->with('success', 'Jenis Asuransi berhasil dihapus.');
    }
}
