<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * API Post - Get all posts
     */
    public function index()
    {
        $posts = Post::with(['category', 'user', 'galeries'])->get();
        return response()->json($posts);
    }

    /**
     * API Post - Get post by ID
     */
    public function show($id)
    {
        $post = Post::with(['category', 'user', 'galeries'])
            ->where('id', $id)
            ->first();

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post);
    }

    /**
     * API Post - Create new post
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|string',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|string',
            'tanggal_posts' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan validasi',
                'errors' => $validator->errors(),
            ], 422);
        }

        $post = Post::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dibuat',
            'data' => $post,
        ], 201);
    }

    /**
     * API Post - Update post
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'image' => 'nullable|string',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|string',
            'tanggal_posts' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan validasi',
                'errors' => $validator->errors(),
            ], 422);
        }

        $post->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil diperbarui',
            'data' => $post,
        ], 200);
    }

    /**
     * API Post - Delete post
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dihapus',
        ], 200);
    }
}
