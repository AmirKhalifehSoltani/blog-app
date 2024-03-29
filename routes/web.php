<?php

use App\Http\Controllers\Client\ArticleController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'do_login'])->name('do_login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('articles', ArticleController::class)->except('destroy')->middleware('auth:web');



Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'do_login'])->name('do_login');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::resource('articles', AdminArticleController::class)->only(['index', 'show', 'destroy'])->middleware('auth:admin');
    Route::patch('articles/{article}/publish', [AdminArticleController::class, 'publish'])->name('articles.publish')->middleware('auth:admin');
    Route::get('articles_trash', [AdminArticleController::class, 'trash_list'])->name('articles.trash_list')->middleware('auth:admin');
    Route::patch('articles/{article}/restore', [AdminArticleController::class, 'restore'])->name('articles.restore')->withTrashed()->middleware('auth:admin');
});
