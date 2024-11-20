<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\Message;
use App\Models\Photo;
use App\Models\Post;

class DashboardController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
{
    // Menghitung jumlah data di tabel Posts
    $Posts = Post::count();


    // Menghitung jumlah data di tabel Galery 
    $galery = Galery::count();

    // Menghitung jumlah data di tabel Galery 
    $photo = Photo::count();

     // Menghitung jumlah data di tabel Massage
    $message = Message::count();

   




    return view('admin.dashboard.index', compact( 'Posts', 'galery','photo','message'));
}

}
