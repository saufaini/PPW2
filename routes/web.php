<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// publik
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/education', 'education')->name('education');
Route::view('/profile-saya', 'profile-saya')
    ->middleware('auth')
    ->name('profile.saya');
Route::get('/profil', function () {
    return view('profil', ['nama' => 'Saufa Aini Yusra', 'umur' => 19, 'kota' => 'Yogyakarta']);
})->name('profile');

// bawaan Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// wajib login
Route::middleware(['auth', 'admin'])->group(function () {    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // route post. trash HARUS sebelum resource
    Route::get('/posts/trash', [PostController::class, 'trash'])->name('posts.trash');
    Route::patch('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('/posts/{id}/force', [PostController::class, 'forceDelete'])->name('posts.force-delete');
    Route::resource('posts', PostController::class);
});

require __DIR__.'/auth.php';