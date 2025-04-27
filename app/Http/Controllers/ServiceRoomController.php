<?php

namespace App\Http\Controllers;

use App\Models\ServiceRoom;
use Illuminate\Http\Request;

class ServiceRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service_rooms = ServiceRoom::all();
        return view('service-room.index', compact('service_rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ServiceRoom::create($data);

        return redirect()->route('service-room.index')
            ->with('success', 'Ruang Pelayanan berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $service_rooms = ServiceRoom::findOrFail($id);
        $service_rooms->update($data);

        return redirect()->route('service-room.index')
            ->with('success', 'Ruang Pelayanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service_rooms = ServiceRoom::findOrFail($id);
        $service_rooms->delete();

        return redirect()->route('service-room.index')
            ->with('success', 'Ruang Pelayanan berhasil dihapus.');
    }
}
