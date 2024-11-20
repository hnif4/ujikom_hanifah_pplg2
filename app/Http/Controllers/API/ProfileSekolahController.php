<?php

namespace App\Http\Controllers\Api;

use App\Models\ProfileSekolah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileSekolahController extends Controller
{
    /**
     * Menampilkan daftar semua profil sekolah.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = ProfileSekolah::all();
        return response()->json([
            'success' => true,
            'data' => $profiles,
        ]);
    }

    /**
     * Menampilkan profil sekolah berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = ProfileSekolah::find($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profil sekolah tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $profile,
        ]);
    }

    /**
     * Menambahkan profil sekolah baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $profile = ProfileSekolah::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Profil sekolah berhasil ditambahkan.',
            'data' => $profile,
        ], 201);
    }

    /**
     * Memperbarui profil sekolah yang ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profile = ProfileSekolah::find($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profil sekolah tidak ditemukan.',
            ], 404);
        }

        $request->validate([
            'judul' => 'string|max:255',
            'isi' => 'string',
        ]);

        $profile->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Profil sekolah berhasil diperbarui.',
            'data' => $profile,
        ]);
    }

    /**
     * Menghapus profil sekolah berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = ProfileSekolah::find($id);

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profil sekolah tidak ditemukan.',
            ], 404);
        }

        $profile->delete();

        return response()->json([
            'success' => true,
            'message' => 'Profil sekolah berhasil dihapus.',
        ]);
    }
}
