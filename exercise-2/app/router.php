<?php
Controller('User');
Controller('Post');

//echo 'vào app/controller/router.php r';
Route::get('/', [UserController::class, 'index']);
Route::get('/user/create', [UserController::class, 'create']);
Route::post('/user/create', [UserController::class, 'postCreate']);
Route::get('user/edit/{id}', [UserController::class, 'edit']);
Route::post('user/post-edit/{id}', [UserController::class, 'postEdit']);

Route::get('user/delete/{id}', [UserController::class, 'delete']);


Route::get('/post/list', [PostController::class, 'index']);
Route::get('/post/create', [PostController::class, 'create']);
Route::post('/post/create', [PostController::class, 'postCreate']);
Route::get('post/edit/{id}', [PostController::class, 'edit']);
Route::post('post/post-edit/{id}', [PostController::class, 'postEdit']);
Route::get('post/delete/{id}', [PostController::class, 'delete']);