<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Menampilkan data profil pengguna.
     *
     * @return void
     */
    public function index()
    {
        // Mengembalikan data profil pengguna dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Profil Pengguna',
            'data' => auth()->guard('api')->user(),
        ], 200);
    }

    /**
     * Memperbarui data profil pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function update(Request $request)
    {
        // Validasi input untuk memastikan nama dan email diperlukan
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->guard('api')->user()->id,
        ]);
    
        if ($validator->fails()) {
            // Mengembalikan kesalahan validasi jika ada
            return response()->json($validator->errors(), 400);
        }
    
        // Mengambil data profil pengguna
        $user = User::whereId(auth()->guard('api')->user()->id)->first();
    
        // Memperbarui dengan mengunggah avatar
        if ($request->file('avatar')) {
            // Menghapus gambar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete('avatars/' . basename($user->avatar));
            }
    
            // Mengunggah gambar baru
            $image = $request->file('avatar');
            $image->storeAs('avatars', $image->hashName(), 'public');
    
            // Memperbarui data pengguna dengan nama, email, dan avatar baru
            $user->update([
                'name' => $request->name,
                'email' => $request->email, // Tambahkan email di sini
                'avatar' => $image->hashName(),
            ]);
        } else {
            // Memperbarui hanya nama dan email jika tidak ada avatar yang diunggah
            $user->update([
                'name' => $request->name,
                'email' => $request->email, // Tambahkan email di sini
            ]);
        }
    
        // Mengembalikan respons JSON setelah berhasil memperbarui profil
        return response()->json([
            'success' => true,
            'message' => 'Profil Pengguna Berhasil Diperbarui!',
            'data' => $user,
        ], 201);
    }
    

    /**
     * Memperbarui kata sandi pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function updatePassword(Request $request)
    {
        // Validasi input untuk memastikan kata sandi diperlukan dan konfirmasi sama
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            // Mengembalikan kesalahan validasi jika ada
            return response()->json($validator->errors(), 400);
        }

        // Mengambil data pengguna
        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        // Memperbarui kata sandi dengan kata sandi yang telah di-hash
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Mengembalikan respons JSON setelah berhasil memperbarui kata sandi
        return response()->json([
            'success' => true,
            'message' => 'Kata Sandi Berhasil Diperbarui!',
            'data' => $user,
        ], 201);
    }
}
