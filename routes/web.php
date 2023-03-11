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
    return view('review.index');
});

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\ReviewController::class, 'index']);
Route::get('review/film', [App\Http\Controllers\ReviewController::class, 'film'])->name('film');
Route::get('review/book', [App\Http\Controllers\ReviewController::class, 'book'])->name('book');
Route::get('review/record', [App\Http\Controllers\ReviewController::class, 'record'])->name('record');
Route::resource('review', App\Http\Controllers\ReviewController::class);
Route::get('home', [App\Http\Controllers\ReviewController::class, 'index']);
Route::put('user/update', [App\Http\Controllers\HomeController::class, 'update'])->name('user.update');
Route::resource('admin', App\Http\Controllers\AdministrationController::class);

//Route::resource('user', App\Http\Controllers\UserController::class);