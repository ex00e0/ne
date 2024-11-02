<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'PostController@index')->name('index');
Route::post('login', [UserController::class, 'login'])->name('login');