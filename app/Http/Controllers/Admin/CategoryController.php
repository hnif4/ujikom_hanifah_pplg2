<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan semua kategori
    public function index(Request $request)
{
    // Ambil query pencarian dari input
    $search = $request->query('q');

    // Jika ada query pencarian, filter data
    if ($search) {
        $categories = Category::where('nama', 'LIKE', "%{$search}%")->paginate(10);
    } else {
        // Jika tidak ada pencarian, ambil semua kategori
        $categories = Category::paginate(10);
    }

    return view('admin.categories.index', compact('categories', 'search'));
}

// Menampilkan detail kategori tertentu
public function show($id)
{
    $category = Category::findOrFail($id); // Mencari kategori berdasarkan ID
    return view('admin.categories.show', compact('category')); // Mengembalikan tampilan detail
}



    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        $categories = Category::all(); // Ambil semua data dari tabel categories
        return view('admin.categories.create', compact('categories'));
    }
    

    // Menyimpan kategori baru ke database
   // Menyimpan kategori baru ke database
   public function store(Request $request)
   {
       // Validasi input
       $request->validate([
           'nama' => 'required|string|max:255',
           'deskripsi' => 'nullable|string',
       ]);
   
       // Menyimpan kategori baru
       Category::create([
           'nama' => $request->nama,
           'deskripsi' => $request->deskripsi,
       ]);
   
       // Redirect ke halaman index dengan pesan sukses
       return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan');
   }
   


 // Show the edit form for the specified category
 public function edit($id)
 {
     $category = Category::findOrFail($id); // Find the category by ID
     return view('admin.categories.edit', compact('category')); // Return the edit view
 }

// Mengupdate kategori di database
public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ]);

    $category = Category::findOrFail($id);
    $category->update([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diupdate');
}


// Menghapus kategori dari database
public function destroy($id) {
    $category = Category::find($id);
    if ($category) {
        $category->delete();
        return response()->json(['status' => 'success']);
    }
    return response()->json(['status' => 'error', 'message' => 'Data not found.']);
}

}
