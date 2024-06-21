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

require 'web_admin.php';
require 'web_user.php';

//Route::get('/', function () {
//    return view('auth/dashboard');
//});
//
//
//Route::get('/forget-password', [RegisterController::class, 'forgetPass'])->name('customer.forgetPass');
//Route::post('/forget-password', [RegisterController::class, 'postForgetPass'])->name('customer.postForgetPass');
//
//Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
//Route::post('/register', [RegisterController::class, 'register']);
//
//Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');
//
//Route::post('/login', [RegisterController::class, 'login']);
//
//Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');
//
//Route::get('test-mail', [RegisterController::class, 'testMail'])->name('test-mail');
//
//
//Route::get('send-mail', [RegisterController::class, 'sendWelcomeEmail']);
//
//Route::middleware(['auth', 'check.usertype'])->group(function () {
//    Route::get('/admin/dashboard', function () {
//        return view('admin.layout.layout_main');
//    })->name('auth.dashboard'); // Đặt tên route là auth.dashboard
//});
//
//
//Route::middleware(['auth'])->group(function () {
//    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
//    Route::get('/user/homepage', function () {
//        return view('user.homepage');
//    })->name('user.homepage'); // Đặt tên route là auth.dashboard
//});
//
//Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
//Route::post('/users', [UserController::class, 'store'])->name('users.store');
//Route::get('/users', [UserController::class, 'index'])->name('users.index');
//
//
//Route::get('/user/homepage', [UserController::class, 'index'])->name('user.homepage');
//
//Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
//Route::get('/show-post/{id}', [PostController::class, 'show'])->name('posts.show');
//Route::get('/edit-post/{id}', [PostController::class, 'edit'])->name('posts.edit');
//Route::put('/update-post/{id}', [PostController::class, 'update'])->name('posts.update');
//Route::delete('/delete-post/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
//
//Route::get('show-post/{id}', [UserController::class, 'show'])->name('posts.show');
//Route::post('/posts/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
//Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
//Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
//
//
