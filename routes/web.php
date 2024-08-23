<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CommentsController;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


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


Auth::routes();

Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::resource('posts', PostController::class);
Route::resource('comments', CommentsController::class);


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
