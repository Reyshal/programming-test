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

Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('home');
Route::get('/create', [App\Http\Controllers\PagesController::class, 'create'])->name('create');
Route::get('/create/{id}', [App\Http\Controllers\PagesController::class, 'create'])->name('update');
Route::post('/create', [App\Http\Controllers\PagesController::class, 'save'])->name('save');
Route::get('/delete/{id}', [App\Http\Controllers\PagesController::class, 'delete'])->name('delete');
Route::get('/detail/{id}', [App\Http\Controllers\PagesController::class, 'detail'])->name('detail');
