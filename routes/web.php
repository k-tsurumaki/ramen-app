<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowingController;

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

Route::get('/', function(){
    return view('welcome');
});

Auth::routes();


// Route::get('/redirect', [LoginController::class, 'redirect'])->name('redirect');
// Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
// Route::get('/', [HomeController::class, 'index'])->name('index');
// Route::get('/', [LoginController::class, 'redirect'])->name('redirect');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/friend_posts', [HomeController::class, 'friend_posts'])->name('friend_posts');
Route::get('/timeline', [HomeController::class, 'timeline'])->name('timeline');
Route::get('/create', [HomeController::class, 'create'])->name('create');
Route::get('/register_shop_profile', [HomeController::class, 'register_shop_profile'])->name('register_shop_profile');
Route::get('/detail_post/{id}', [HomeController::class, 'detail_post'])->name('detail_post');
Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('edit');
Route::get('/others/{id}', [HomeController::class, 'others'])->name('others');
Route::get('/edit_profile', [HomeController::class, 'edit_profile'])->name('edit_profile');
Route::get('/edit_shop_profile/{id}', [HomeController::class, 'edit_shop_profile'])->name('edit_shop_profile');
Route::get('/shop/{id}', [HomeController::class, 'shop'])->name('shop');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/search_in_shop_page', [HomeController::class, 'search_in_shop_page'])->name('search_in_shop_page');
Route::get('/like/{post}', [LikeController::class, 'like'])->name('like');
Route::get('/unlike/{post}', [LikeController::class, 'unlike'])->name('unlike');
Route::get('/liked_posts', [HomeController::class, 'liked_posts'])->name('liked_posts');
Route::get('/following/{user}', [FollowingController::class, 'following'])->name('following');
Route::get('/unfollowing/{user}', [FollowingController::class, 'unfollowing'])->name('unfollowing');
Route::get('/following_list/{user}', [FollowingController::class, 'following_list'])->name('following_list');
Route::get('/follower_list/{user}', [FollowingController::class, 'follower_list'])->name('follower_list');
Route::get('/like_ranking/{id}', [HomeController::class, 'like_ranking'])->name('like_ranking');


Route::post('/store', [HomeController::class, 'store'])->name('store');
Route::post('/store_shop', [HomeController::class, 'store_shop'])->name('store_shop');
Route::post('/update', [HomeController::class, 'update'])->name('update');
Route::post('/update_profile', [HomeController::class, 'update_profile'])->name('update_profile');
Route::post('/update_shop_profile', [HomeController::class, 'update_shop_profile'])->name('update_shop_profile');
Route::post('/destroy', [HomeController::class, 'destroy'])->name('destroy');
Route::post('/search', [HomeController::class, 'search'])->name('search');
Route::post('/search_in_shop_page', [HomeController::class, 'search_in_shop_page'])->name('search_in_shop_page');
