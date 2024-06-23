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


Route::get('/products_list', [App\Http\Controllers\Product_listController::class, 'showProducts_list'])->name('products_list');
Route::post('/products_list', [App\Http\Controllers\Product_listController::class, 'showProducts_search'])->name('products_search');
Route::delete('/products_list/{id}', [App\Http\Controllers\Product_listController::class, 'showProducts_delete'])->name('products_delete');
Route::get('/products/detail/{id}', [App\Http\Controllers\Product_detailController::class, 'showProducts_detail'])->name('products_detail');
Route::get('/products_registration', [App\Http\Controllers\Product_listController::class, 'showProducts_registration'])->name('products_registration');
Route::post('/products_registration', [App\Http\Controllers\Product_registrationController::class, 'showProducts_registration'])->name('products_registration');
Route::get('/products/update/{id}', [App\Http\Controllers\Product_detailController::class, 'showProducts_edit'])->name('products_edit');
Route::post('/products/update/{id}', [App\Http\Controllers\Product_updateController::class, 'showProducts_update'])->name('products_update');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/', function () {return view('welcome');});
