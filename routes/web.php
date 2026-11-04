<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostGalleryController;

// publik
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/education', 'education')->name('education');
Route::view('/experience', 'experience')->name('experience');
Route::view('/profile-saya', 'profile-saya')
    ->middleware('auth')
    ->name('profile.saya');
Route::get('/profil', function () {
    return view('profil', ['nama' => 'Saufa Aini Yusra', 'umur' => 19, 'kota' => 'Yogyakarta']);
})->name('profile');

// bawaan Breeze
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// wajib login
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    

    // route post. trash HARUS sebelum resource
    Route::get('/posts/trash', [PostController::class, 'trash'])->name('posts.trash');
    Route::patch('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('/posts/{id}/force', [PostController::class, 'forceDelete'])->name('posts.force-delete');
    Route::resource('posts', PostController::class);

    Route::post('/posts/{post}/gallery', [PostGalleryController::class, 'store'])->name('posts.gallery.store');
    Route::delete('/posts/{post}/gallery/{image}', [PostGalleryController::class, 'destroy'])->name('posts.gallery.destroy');
});

require __DIR__.'/auth.php';

