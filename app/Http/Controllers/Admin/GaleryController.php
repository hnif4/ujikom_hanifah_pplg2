<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galery; // Ensure Galery model exists
use App\Models\Post; // Add Post model
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    // Display all galleries
    public function index(Request $request)
    {
        // Ambil query pencarian dari input
        $search = $request->query('q');

        // Jika ada query pencarian, filter data
        if ($search) {
            $galeries = Galery::where('judul', 'LIKE', "%{$search}%")
                ->orWhere('deskripsi', 'LIKE', "%{$search}%")
                ->with('post') // Mengambil post yang terkait
                ->paginate(10);
        } else {
            // Jika tidak ada pencarian, ambil semua galeri
            $galeries = Galery::with('post')->paginate(10);
        }

        return view('admin.galery.index', compact('galeries', 'search'));
    }

    public function show($id)
    {
        $galery = Galery::with('post')->findOrFail($id); // Find the gallery with the related post

        return view('admin.galery.show', compact('galery')); // Return a view for showing gallery details
    }


    // Display form to create a new gallery
    public function create()
    {
        $posts = Post::all(); // Get all posts
        return view('admin.galery.create', compact('posts')); // Send posts to view
    }

    // Store a new gallery in the database
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'post_id' => 'nullable|exists:posts,id', // Validate post_id as nullable
        ]);

        Galery::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'post_id' => $request->post_id, // Ensure post_id is passed correctly
        ]);

        return redirect()->route('admin.galery.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    // Display the form to edit a specific gallery
    public function edit($id)
    {
        $galery = Galery::findOrFail($id); // Find gallery by ID
        $posts = Post::all(); // Get all posts
        return view('admin.galery.edit', compact('galery', 'posts')); // Send posts to view
    }

    // Update a gallery in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'post_id' => 'nullable|exists:posts,id', // Validate post_id as nullable
        ]);

        $galery = Galery::findOrFail($id);
        $galery->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'post_id' => $request->post_id, // Ensure post_id is passed correctly
        ]);

        return redirect()->route('admin.galery.index')->with('success', 'Galeri berhasil diupdate');
    }

    // Delete a gallery from the database
    public function destroy($id)
    {
        $galery = Galery::find($id);
        if ($galery) {
            $galery->delete();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error', 'message' => 'Data not found.']);
    }
}
