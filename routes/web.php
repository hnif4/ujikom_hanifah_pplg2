<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GaleryController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\ProfileSekolahController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\PreventBackAfterLogout;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\HomeController;




// Route untuk halaman login (di luar grup admin)
Route::get('/', function () {
    return view('welcome');
});


//INI ADALAH ROUTE UNTUK FRONTEND 
Route::get('/', [HomeController::class, 'index']);




//INI ADALAH ROUTE UNTUK BACKEND
// Group route dengan prefix "admin"
Route::prefix('admin')->group(function () {
    // Group route dengan middleware "auth"
    Route::middleware(['auth',PreventBackAfterLogout::class])->group(function () {
        // Route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        Route::redirect('/home', '/admin/dashboard');
        //route resource categories
        Route::resource('categories', CategoryController::class, ['as' => 'admin']);
        
        //route resource Post
        Route::resource('/posts', PostsController::class, ['as' => 'admin']);
        //route resource Galery
        Route::resource('/galery', GaleryController::class, ['as' => 'admin']);
        //route resource Photo
        Route::resource('/photos', PhotoController::class, ['as' => 'admin']);
       
        //route resource Photo
        Route::resource('/profile_sekolah', ProfileSekolahController::class, ['as' => 'admin']);

        Route::resource('/users', UserController::class, ['as' => 'admin']);

        //route resource slider
        Route::resource('/slider', SliderController::class, ['except' => ['show','create', 'edit' , 'update'], 'as' => 'admin']);

        //route untuk massage
        Route::get('/message', [MessageController::class, 'index'])->name('admin.message.index');
        Route::get('/message/{id}', [MessageController::class, 'show'])->name('admin.message.show');
        // Route Profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
        Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('user-profile-information.update');
    });
});

Route::get('/informasi/{post}', [HomeController::class, 'showInformasi'])->name('informasi.show');

// Tambahkan route untuk detail agenda
Route::get('/agenda/{post}', [HomeController::class, 'showAgenda'])->name('agenda.show');

// Tambahkan route untuk pencarian
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::post('/contact', [HomeController::class, 'contact'])->name('contact.store');

Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery.index');
Route::get('/informasi', [HomeController::class, 'informasiPage'])->name('informasi.index');
Route::get('/agenda', [HomeController::class, 'agendaPage'])->name('agenda.index');