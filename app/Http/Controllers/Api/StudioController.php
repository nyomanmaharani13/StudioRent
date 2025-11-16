<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    // Tampilkan semua studio
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Studio::all()
        ]);
    }

    // Tambah studio
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'capacity' => 'required|integer',
            'price_per_hour' => 'required|numeric',
        ]);

        $studio = Studio::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Studio berhasil ditambahkan',
            'data' => $studio
        ], 201);
    }

    // Detail studio
    public function show($id)
    {
        $studio = Studio::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $studio
        ]);
    }

    // Update studio
    public function update(Request $request, $id)
    {
        $studio = Studio::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'description' => 'nullable|string',
            'capacity' => 'sometimes|integer',
            'price_per_hour' => 'sometimes|numeric',
        ]);

        $studio->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Studio berhasil diperbarui',
            'data' => $studio
        ]);
    }

    // Hapus studio
    public function destroy($id)
    {
        $studio = Studio::findOrFail($id);
        $studio->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Studio berhasil dihapus'
        ]);
    }
}
