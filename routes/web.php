<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('post.index');
});

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\PostController::class, 'index']);
Route::resource('post', App\Http\Controllers\PostController::class);
Route::resource('comment', App\Http\Controllers\CommentController::class);
Route::get('home', [App\Http\Controllers\PostController::class, 'index']);
Route::put('user/update', [App\Http\Controllers\HomeController::class, 'update'])->name('user.update');
Route::resource('admin', App\Http\Controllers\AdministrationController::class);

//Route::resource('user', App\Http\Controllers\UserController::class);