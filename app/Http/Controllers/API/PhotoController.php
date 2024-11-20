<?php

namespace App\Http\Controllers\Api;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    /**
     * Menampilkan daftar foto.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // Mengambil foto terbaru
            $photos = Photo::latest()->get();

            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil diambil.',
                'data' => $photos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil foto: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menyimpan foto baru ke dalam penyimpanan.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul_foto' => 'required|string|max:255',
            'isi_foto' => 'required|string',
            'user_id' => 'required|integer',
            'galery_id' => 'required|integer',
        ]);

        try {
            // Membuat foto baru
            $photo = Photo::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil dibuat.',
                'data' => $photo
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat foto: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan foto berdasarkan ID.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Mencari foto berdasarkan ID
            $photo = Photo::find($id);

            if (!$photo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Foto tidak ditemukan.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil diambil.',
                'data' => $photo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kesalahan saat mengambil foto: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Memperbarui foto yang ada dalam penyimpanan.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul_foto' => 'sometimes|required|string|max:255',
            'isi_foto' => 'sometimes|required|string',
            'user_id' => 'sometimes|required|integer',
            'galery_id' => 'sometimes|required|integer',
        ]);

        try {
            // Mencari foto berdasarkan ID
            $photo = Photo::find($id);

            if (!$photo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Foto tidak ditemukan.'
                ], 404);
            }

            // Memperbarui foto
            $photo->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil diperbarui.',
                'data' => $photo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui foto: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus foto dari penyimpanan.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Mencari foto berdasarkan ID
            $photo = Photo::find($id);

            if (!$photo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Foto tidak ditemukan.'
                ], 404);
            }

            // Menghapus foto
            $photo->delete();

            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus foto: ' . $e->getMessage()
            ], 500);
        }
    }
}
