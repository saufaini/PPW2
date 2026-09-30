<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/education', 'education')->name('education');


// Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
// Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
// Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
// Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/posts/trash', [PostController::class, 'trash'])->name('posts.trash');
Route::patch('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::delete('/posts/{id}/force', [PostController::class, 'forceDelete'])->name('posts.force-delete');
Route::resource('posts', PostController::class);
Route::get('/profile', function () {
    return view('profil', ['nama' => 'Saufa Aini Yusra', 'umur' => 19, 'kota' => 'Yogyakarta']);
})->name('profile');


