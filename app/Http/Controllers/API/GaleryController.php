<?php

namespace App\Http\Controllers\Api;

use App\Models\Galery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GaleryController extends Controller
{
    /**
     * API Galery - Get all galleries
     */
    public function index()
    {
        // Mengambil semua galeri
        $galeries = Galery::with('post')->get();
        return response()->json($galeries);
    }

    /**
     * API Galery - Get gallery by id
     */
    public function show($id)
    {
        // Mengambil galeri berdasarkan ID
        $galery = Galery::with('post')->find($id);
        
        if (!$galery) {
            return response()->json(['message' => 'Galery not found'], 404);
        }

        return response()->json($galery);
    }

    /**
     * API Galery - Create new gallery
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan validasi',
                'errors' => $validator->errors(),
            ], 422);
        }

        $galery = Galery::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Galery berhasil dibuat',
            'data' => $galery,
        ], 201);
    }

    /**
     * API Galery - Update gallery
     */
    public function update(Request $request, $id)
    {
        $galery = Galery::find($id);
        if (!$galery) {
            return response()->json(['message' => 'Galery not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan validasi',
                'errors' => $validator->errors(),
            ], 422);
        }

        $galery->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Galery berhasil diupdate',
            'data' => $galery,
        ]);
    }

    /**
     * API Galery - Delete gallery
     */
    public function destroy($id)
    {
        $galery = Galery::find($id);
        if (!$galery) {
            return response()->json(['message' => 'Galery not found'], 404);
        }

        $galery->delete();

        return response()->json([
            'success' => true,
            'message' => 'Galery berhasil dihapus',
        ]);
    }
}
