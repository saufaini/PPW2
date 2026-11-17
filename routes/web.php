<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostGalleryController;
use App\Http\Controllers\BlogController;

use App\Http\Controllers\ContactController;

use App\Http\Controllers\ContactAdminController;



// publik
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/education', 'education')->name('education');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/contact', [ContactController::class, 'create'])->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('contact.store');

Route::view('/experience', 'experience')->name('experience');
Route::view('/profile-saya', 'profile-saya')
    ->middleware('auth')
    ->name('profile.saya');
Route::get('/profil', function () {
    return view('profil', ['nama' => 'Saufa Aini Yusra', 'umur' => 19, 'kota' => 'Yogyakarta']);
})->name('profile');





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


    Route::get('/contacts', [ContactAdminController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [ContactAdminController::class, 'show'])->name('contacts.show');
});

require __DIR__.'/auth.php';

