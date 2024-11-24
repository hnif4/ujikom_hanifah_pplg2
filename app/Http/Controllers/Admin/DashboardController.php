<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\Message;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display dashboard page
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Menghitung jumlah data
        $Posts = Post::count();
        $galery = Galery::count();
        $photo = Photo::count();
        $message = Message::count();

        // Mengambil 5 pesan terbaru
        $recentMessages = Message::latest()->take(5)->get();

        return view('admin.dashboard.index', compact(
            'Posts', 
            'galery',
            'photo',
            'message',
            'recentMessages'
        ));
    }
}
