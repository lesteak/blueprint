<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Yadda\Enso\Blog\Facades\EnsoBlog;

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

Auth::routes(['register' => false]);

Route::group(['middleware' => 'holding-page'], function () {
    Route::get('/')->uses([\App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Duplicate route for post-login/register redirection
    Route::get('home')->uses([\App\Http\Controllers\HomeController::class, 'redirect']);

    EnsoBlog::routes('articles', Yadda\Enso\Blog\Controllers\PostController::class, 'articles');

    Route::get('{page}')->uses([\App\Http\Controllers\PageController::class, 'show'])->name('pages.show');
});
