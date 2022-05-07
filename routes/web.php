<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/timeline', [HomeController::class, 'timeline'])->name('timeline');
Route::get('/create', [HomeController::class, 'create'])->name('create');
Route::get('/detail_post/{id}', [HomeController::class, 'detailPost'])->name('detailPost');
Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('edit');
Route::get('/others/{id}', [HomeController::class, 'others'])->name('others');
Route::get('/edit_profile', [HomeController::class, 'edit_profile'])->name('edit_profile');


Route::post('/store', [HomeController::class, 'store'])->name('store');
Route::post('/update', [HomeController::class, 'update'])->name('update');
Route::post('/update_profile', [HomeController::class, 'update_profile'])->name('update_profile');
Route::post('/destroy', [HomeController::class, 'destroy'])->name('destroy');
Route::post('/search', [HomeController::class, 'search'])->name('search');
Route::post('/search_by_user_id', [HomeController::class, 'searchByUserId'])->name('searchByUserId');
