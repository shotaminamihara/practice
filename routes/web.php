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


Route::get('/products_list', [App\Http\Controllers\PracticeController::class, 'showProducts_list'])->name('products_list');
Route::post('/products_list', [App\Http\Controllers\PracticeController::class, 'showProducts_search'])->name('products_search');
Route::delete('/products_list/{id}', [App\Http\Controllers\PracticeController::class, 'showProducts_delete'])->name('products_delete');
Route::get('/products_detail/{id}', [App\Http\Controllers\PracticeController::class, 'showProducts_detail'])->name('products_detail');
Route::post('/products_detail/{id}', [App\Http\Controllers\PracticeController::class, 'showProducts_edit'])->name('products_edit');
Route::get('/products_registration', [App\Http\Controllers\PracticeController::class, 'showProducts_registration'])->name('products_registration');
Route::post('/products_registration', [App\Http\Controllers\PracticeController::class, 'showProducts_registrations'])->name('products_registrations');
Route::get('/products_edit/{id}', [App\Http\Controllers\PracticeController::class, 'showCompanies_select'])->name('companies_select');
Route::post('/products_update/{id}', [App\Http\Controllers\PracticeController::class, 'showProducts_update'])->name('products_update');




Auth::routes();
Route::get('/home', [App\Http\Controllers\PracticeController::class, 'index'])->name('home');
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/', function () {return view('welcome');});
