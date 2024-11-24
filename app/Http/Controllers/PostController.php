<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Galery;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $relatedPosts = Post::where('id', '!=', $id)
                            ->where('category_id', $post->category_id)
                            ->take(3)
                            ->get();
        
        // Ambil gallery yang terkait dengan post ini
        $postGaleries = Galery::whereHas('posts', function($query) use ($post) {
            $query->where('posts.id', $post->id);
        })->with('photos')->get();

        // Jika post adalah agenda, gunakan view show-agenda
        if($post->category_id == 2) { // Sesuaikan dengan ID kategori agenda
            return view('posts.show-agenda', compact('post', 'relatedPosts', 'postGaleries'));
        }

        // Jika bukan agenda, gunakan view show biasa
        return view('posts.show', compact('post', 'relatedPosts', 'postGaleries'));
    }
} 