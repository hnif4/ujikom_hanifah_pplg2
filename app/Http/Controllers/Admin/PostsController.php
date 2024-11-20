<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    // Tampilkan daftar post
    public function index(Request $request)
    {
        $query = Post::query();

        // Fitur pencarian berdasarkan judul
        if ($request->has('q')) {
            $query->where('judul', 'like', '%' . $request->query('q') . '%');
        }

        $posts = $query->paginate(10); // Pagination
        return view('admin.posts.index', compact('posts'));
    }

    // Tampilkan detail post
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    // Form untuk membuat post baru
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    // Simpan post baru
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_posts' => 'required|date',
            'status' => 'required|string|in:aktif,tidak aktif',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'isi.required' => 'Isi wajib diisi.',
            'image.required' => 'Gambar wajib diunggah.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.max' => 'Ukuran file gambar tidak boleh lebih dari 2MB.',
        ]);

        // Simpan file gambar
        $path = $request->file('image')->store('posts', 'public');

        // Simpan data ke database
        Post::create([
            'judul' => $validatedData['judul'],
            'isi' => $validatedData['isi'],
            'tanggal_posts' => $validatedData['tanggal_posts'],
            'status' => $validatedData['status'],
            'user_id' => Auth::id(),
            'category_id' => $validatedData['category_id'],
            'image' => $path,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil ditambahkan!');
    }

    // Form edit post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    // Update data post
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
    
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal_posts' => 'required|date',
            'status' => 'required|string|in:aktif,tidak aktif',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Nullable karena bisa tidak ada gambar
        ]);
    
        // Perbarui gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            // Simpan gambar baru
            $post->image = $request->file('image')->store('posts', 'public');
        }
    
        // Update data lainnya
        $post->update(array_merge($validatedData, [
            // Jangan overwrite gambar jika tidak ada gambar baru
            'image' => $post->image ?? $post->image,
        ]));
    
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diperbarui.');
    }
    

    // Hapus post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Hapus gambar jika ada
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return response()->json(['status' => 'success', 'message' => 'Post berhasil dihapus!']);
    }
}
