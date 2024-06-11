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


Route::get('/', [PostController::class, 'index']);
Route::get('/post/create', [PostController::class, 'create']);
Route::post('/post/create', [PostController::class, 'postCreate']);