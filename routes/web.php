<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxShopController;

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
Route::get('/', [App\Http\Controllers\AjaxShopController::class, 'index'])->name('shop.index');
// Ajax
Route::post('fetchdata', [App\Http\Controllers\AjaxShopController::class, 'fetchData'])->name('shop.fetchdata');
Route::post('fetchdata2', [App\Http\Controllers\AjaxShopController::class, 'fetchData2'])->name('shop.fetchdata2');
Route::get('logs',[\Rap2hpoutre\LaravelLogViewer\LogViewerController::class,'index']);

Route::resource('item', App\Http\Controllers\AjaxShopController::class);



Auth::routes();//Forma de eliminar las rutas que nos sobran
//Route::get('/hom', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
