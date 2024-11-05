<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/login', [UserController::class, 'show_login'])->name('show_login');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/reg', [UserController::class, 'show_reg'])->name('show_reg');
Route::post('/reg', [UserController::class, 'reg'])->name('reg');
Route::get('/exit', [UserController::class, 'exit'])->name('exit');

Route::get('/appl', [UserController::class, 'show_appl'])->name('show_appl');
Route::post('/appl', [UserController::class, 'appl'])->name('appl');

Route::get('/my_appl', [UserController::class, 'my_appl'])->name('my_appl');

// Route::group(['middleware' => ['auth', 'role'], 'prefix' => 'admin'], function()
// {
    Route::get('/admin/', [UserController::class, 'admin'])->name('admin');
    Route::get('/admin/posts', [UserController::class, 'admin_posts'])->name('admin_posts');
    Route::get('/admin/accept/{id}', [UserController::class, 'accept'])->name('accept');
    Route::get('/admin/reject/{id}', [UserController::class, 'reject'])->name('reject');

    Route::get('/admin/edit/{id}', [UserController::class, 'show_edit'])->name('show_edit');
    Route::get('/admin/create', [UserController::class, 'show_create'])->name('show_create');
    Route::post('/admin/create', [UserController::class, 'create'])->name('create');
    Route::post('/admin/edit', [UserController::class, 'edit'])->name('edit');
    Route::get('/admin/delete/{id}', [UserController::class, 'delete'])->name('delete');
// });