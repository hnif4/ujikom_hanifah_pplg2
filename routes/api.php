<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\GaleryController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\ProfileSekolahController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SliderController;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Container\Attributes\Auth;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Api Register
 */
Route::post('/register/admin', [RegisterController::class, 'registerUser']);

/**
 * Api Login
 */
Route::post('/login/admin', [LoginController::class, 'loginUser']); //untuk admin

/**
 * Api Logout
 */
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);


/**
 * Api categories
 */
Route::apiResource('categories', CategoryController::class);
/**
 * Api Post
 *
 */
Route::apiResource('posts', PostController::class);
/**
 * Api Galery
 *
 */
Route::apiResource('galeries', GaleryController::class); //route otomatis untuk semua metode yang diperlukan (index, store, show, update, destroy)

/**
 * Api Photo
 */

 Route::apiResource('photos', PhotoController::class);
/**
 * Api Profile Sekolah
 */
 Route::apiResource('profile-sekolah', ProfileSekolahController::class);

 /**
 * API Slider
 */
Route::apiResource('sliders', SliderController::class);
 /**
 * Api Profile User
 */
// Routes untuk autentikasi pengguna
Route::middleware('auth:api')->group(function () {
    Route::get('profile', [ProfileController::class, 'index']);
    Route::put('profile', [ProfileController::class, 'update']);
    Route::put('profile/password', [ProfileController::class, 'updatePassword']);
});

// Routes untuk autentikasi tamu
Route::middleware('auth:api_guest')->group(function () {
    Route::get('guest/profile', [ProfileController::class, 'index']);
    Route::put('guest/profile', [ProfileController::class, 'update']);
    Route::put('guest/profile/password', [ProfileController::class, 'updatePassword']);
});

