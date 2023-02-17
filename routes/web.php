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
//no ajax SPA
Route::get('/', [App\Http\Controllers\AjaxYateController::class, 'index'])->name('index');
// Ajax
Route::resource('index', App\Http\Controllers\AjaxYateController::class);
Route::get('item', [App\Http\Controllers\AjaxYateController::class, 'items'])->name('yate.items');

Route::post('upload', [App\Http\Controllers\AjaxYateController::class, 'upload'])->name('upload');     //sube el archivo




Auth::routes();//Forma de eliminar las rutas que nos sobran
//Route::get('/hom', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
