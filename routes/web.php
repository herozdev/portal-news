<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/auth', [AdminController::class, 'auth'])->name('auth');
    Route::get('/register', [AdminController::class, 'registration'])->name('registration');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::post('/auth', [AdminController::class, 'authenticate']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('auth');
    Route::post('/logout', [AdminController::class, 'logout']);
});


Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/archive', [HomeController::class, 'archive'])->name('archive');

Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
