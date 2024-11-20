<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Galery; // Pastikan Galery model sudah ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::with('galery')->paginate(10);
        return view('admin.photos.index', compact('photos'));
    }

    public function show($id)
    {
        $photo = Photo::with('galery')->findOrFail($id); // Load the photo along with the associated galery
        return view('admin.photos.show', compact('photo'));
    }


    public function create()
    {
        $galeries = Galery::all(); // Mengambil semua galeri
        return view('admin.photos.create', compact('galeries'));
    }

    public function store(Request $request)
{
    $request->validate([
        'judul_foto' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'galery_id' => 'required|exists:galery,id',
    ], [
        'image.max' => 'Gambar tidak boleh lebih dari 2 MB.',
    ]);

    $path = $request->file('image')->store('photos', 'public');

    Photo::create([
        'judul_foto' => $request->judul_foto,
        'isi_foto' => $path,
        'user_id' => Auth::id(),
        'galery_id' => $request->galery_id,
    ]);

    return redirect()->route('admin.photos.index')->with('success', 'Foto berhasil ditambahkan.');
}

    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        $galeries = Galery::all(); // Pastikan ini mengambil data yang benar
        return view('admin.photos.edit', compact('photo', 'galeries'));
    }


    public function update(Request $request, $id)
{
    $request->validate([
        'judul_foto' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'galery_id' => 'required|exists:galery,id',
    ], [
        'image.max' => 'Gambar tidak boleh lebih dari 2 MB.',
    ]);

    $photo = Photo::findOrFail($id);

    $photo->judul_foto = $request->judul_foto;
    $photo->galery_id = $request->galery_id;

    if ($request->hasFile('image')) {
        Storage::disk('public')->delete($photo->isi_foto);
        $path = $request->file('image')->store('photos', 'public');
        $photo->isi_foto = $path;
    }

    $photo->save();

    return redirect()->route('admin.photos.index')->with('success', 'Foto berhasil diperbarui.');
}

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        // Hapus gambar dari storage
        Storage::disk('public')->delete($photo->isi_foto);

        $photo->delete();

        return response()->json(['status' => 'success', 'message' => 'Foto berhasil dihapus.']);
    }
}
