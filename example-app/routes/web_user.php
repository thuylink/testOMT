<?php

use App\Models\Post;
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


Route::get('/', function () {
    return view('auth/dashboard');
});

//Quên MK
Route::get('/forget-password', [RegisterController::class, 'forgetPass'])->name('customer.forgetPass');
Route::post('/forget-password', [RegisterController::class, 'postForgetPass'])->name('customer.postForgetPass');

//REGISTER, LOGIN, LOGOUT
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisterController::class, 'login']);
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

//Route::middleware(['auth'])->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/', function () {
        $posts = Post::all();
        return view('user.homepage', compact('posts'));
    })->name('user.homepage'); // Đặt tên route là auth.dashboard
//});

//Route::get('/user/homepage', [UserController::class, 'index'])->name('user.homepage-2');

//QL cmt
Route::post('/posts/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');



