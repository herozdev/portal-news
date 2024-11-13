<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Models\Post;
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


Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/archive', [HomeController::class, 'archive'])->name('archive');

Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('category.show');

Route::get('/auth', [AdminController::class, 'auth'])->name('auth');
Route::get('/register', [AdminController::class, 'registration'])->name('registration');
Route::post('/store', [AdminController::class, 'store'])->name('store');