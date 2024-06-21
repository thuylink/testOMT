<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth', 'check.usertype'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.layout.layout_main');
    })->name('admin.dashboard'); // Đặt tên route là auth.dashboard
});

//QL người dùng
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('users.index');

//QL bài viết
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/show-post/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/edit-post/{id}', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/update-post/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/delete-post/{id}', [PostController::class, 'destroy'])->name('posts.destroy');


