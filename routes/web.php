<?php

use App\Http\Controllers\PostController; 
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/education', 'education')->name('education');

// Route::view('/projects', 'projects')->name('projects'); //ini route statis, jadi dihapus (16 Sep [17.27])
Route::get('/projects', [ProjectController::class, 'index'])->name('projects'); 
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create'); 
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store'); 
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');











Route::resource('newposts', PostController::class);

//ditaruh di atas get post supaya tidak bentrok dengan /posts/{id} yang mungkin dibuat nanti).
Route::get('/posts/create', [PostController::class, 'create']);

Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); 
