<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('guest')->group(function () {
    Route::get('/register/create', [UserController::class, 'register'])->name('register.create');
    Route::post('/register', [UserController::class, 'registerAction'])->name('register');
    Route::get('/login/create', [UserController::class, 'login'])->name('login.create');
    Route::post('/login', [UserController::class, 'loginAction'])->name('login');
   
    Route::get('/', [ PostController::class, 'index'])->name('index');



});

Route::middleware('auth')->group(function () {
   
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::resource('posts', PostController::class);
    Route::post('/comments/post/{post_id}', [ CommentController::class, 'store'])->name('comment.store');
    Route::resource('comments', CommentController::class);
    Route::resource('likes', LikeController::class);
    

});