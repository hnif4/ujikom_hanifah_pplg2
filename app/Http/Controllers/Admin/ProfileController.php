<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk menggunakan Query Builder

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        
        // Kirim data pengguna ke view
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Memperbarui informasi profil dan avatar pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Siapkan data untuk di-update
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Jika ada file avatar yang diunggah
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }
        
            // Simpan avatar baru
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $updateData['avatar'] = $avatarPath;
        }
        

        // Perbarui data pengguna menggunakan Query Builder
        DB::table('users')->where('id', $user->id)->update($updateData);

        return redirect()->back()->with('status', 'Profile has been updated.');
    }

    


}