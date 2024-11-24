<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Galery;
use App\Models\Slider;
use App\Models\ProfileSekolah;
use Illuminate\Support\Facades\Schema;
use App\Models\Message;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $profiles = ProfileSekolah::whereIn('id', [1, 2,3])->get(); 
        $informasiPosts = Post::where('category_id', 1)
            ->where('status', 'aktif')
            ->latest()
            ->get();
        
        $agendaPosts = Post::where('category_id', 2)
            ->where('status', 'aktif')
            ->latest()
            ->get();
        
        $frontend_galeries = Galery::with(['photos' => function($query) {
            $query->limit(4);
        }])->get();

        return view('welcome', compact('informasiPosts', 'agendaPosts', 'frontend_galeries', 'sliders', 'profiles'));
    }

    public function gallery()
{
    // Ambil semua data galeri beserta foto terkait
    $all_galeries = Galery::with('photos')->get();

    // Kirim data ke view
    return view('gallery.index', compact('all_galeries'));
}

public function informasiPage()
{
    $informasiPosts = Post::where('category_id', 1)
        ->where('status', 'aktif')
        ->latest()
        ->paginate(10); // Batasi dengan pagination

    return view('informasi.index', compact('informasiPosts'));
}

public function agendaPage()
{
    $agendaPosts = Post::where('category_id', 2)
        ->where('status', 'aktif')
        ->latest()
        ->paginate(10); // Batasi dengan pagination

    return view('agenda.index', compact('agendaPosts'));
}



    public function show($id)
    {
        $post = Post::findOrFail($id); // Pastikan menggunakan model Post
        return view('posts.detail', compact('post'));
    }

    public function showInformasi(Post $post)
    {
        // Memastikan hanya post dengan kategori informasi (category_id = 1) yang bisa diakses
        if ($post->category_id != 1 || $post->status != 'aktif') {
            abort(404);
        }
        
        // Eager load user dan galeri
        $post->load(['user', 'galeries.photos']);
        
        // Mengambil beberapa post terkait dengan eager loading user
        $relatedPosts = Post::with('user')
            ->where('category_id', 1)
            ->where('id', '!=', $post->id)
            ->where('status', 'aktif')
            ->latest()
            ->take(3)
            ->get();
        
        $postGaleries = $post->galeries()->with('photos')->get();
        
        return view('posts.show', compact('post', 'relatedPosts', 'postGaleries'));
    }

    public function showAgenda(Post $post)
    {
        // Memastikan hanya post dengan kategori agenda (category_id = 2) yang bisa diakses
        if ($post->category_id != 2 || $post->status != 'aktif') {
            abort(404);
        }
        
        // Eager load user dan galeri
        $post->load(['user', 'galeries.photos']);
        
        // Mengambil beberapa agenda terkait dengan eager loading user
        $relatedAgendas = Post::with('user')
            ->where('category_id', 2)
            ->where('id', '!=', $post->id)
            ->where('status', 'aktif')
            ->latest()
            ->take(3)
            ->get();
        
        $postGaleries = $post->galeries()->with('photos')->get();
        
        return view('posts.show-agenda', compact('post', 'relatedAgendas', 'postGaleries'));
    }

    public function search(Request $request)
{
    $keyword = $request->get('keyword');
    
    $posts = Post::where('status', 'aktif')
        ->where(function($query) use ($keyword) {
            $query->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('isi', 'like', "%{$keyword}%");
        })
        ->latest()
        ->paginate(10);
    
    return view('search', compact('posts', 'keyword'));
}


    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'status' => 'unread'
        ]);

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim!');
    }
}
