<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProfileSekolah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileSekolahController extends Controller
{
    public function index()
    {

        $profiles = ProfileSekolah::paginate(10);
        
        return view('admin.profile_sekolah.index', compact('profiles'));
    }

    public function show(ProfileSekolah $profileSekolah)
{
    return view('admin.profile_sekolah.show', compact('profileSekolah'));
}


    public function create()
    {
        return view('admin.profile_sekolah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
        ]);

        ProfileSekolah::create($request->all());

        return redirect()->route('admin.profile_sekolah.index')->with('success', 'Profile sekolah berhasil ditambahkan.');
    }

    

    public function edit(ProfileSekolah $profileSekolah)
    {
        return view('admin.profile_sekolah.edit', compact('profileSekolah'));
    }

    public function update(Request $request, ProfileSekolah $profileSekolah)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
        ]);

        $profileSekolah->update($request->all());

        return redirect()->route('admin.profile_sekolah.index')->with('success', 'Profile sekolah berhasil diperbarui.');
    }

    public function destroy(ProfileSekolah $profileSekolah)
{
    try {
        $profileSekolah->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Profile sekolah berhasil dihapus!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Gagal menghapus profile sekolah!'
        ], 500);
    }
}

}
