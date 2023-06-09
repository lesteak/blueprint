<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Yadda\Enso\Blog\Facades\EnsoBlog;
use Yadda\Enso\Newsletter\Facades\EnsoNewsletter;

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

Route::get(
    '/sitemap.xml',
    function () {
        return response()->view('pages.sitemap')->header('Content-Type', 'text/xml');
    }
);

Auth::routes(['register' => false]);

Route::middleware(['holding-page', 'globalscopes'])->group(function () {
    Route::get('/')->uses([\App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Duplicate route for post-login/register redirection
    Route::get('home')->uses([\App\Http\Controllers\HomeController::class, 'redirect']);

    Route::prefix('classes')->name('classes.')->group(function () {
        Route::get('{class}')->uses([\App\Http\Controllers\ClassController::class, 'show'])->name('show');
    });

    Route::prefix('locations')->name('locations.')->group(function () {
        Route::get('{location}')->uses([\App\Http\Controllers\LocationController::class, 'show'])->name('show');
        Route::get('{location}/timetable')->uses([\App\Http\Controllers\LocationController::class, 'timetable'])->name('timetable');
    });

    Route::prefix('trainers')->name('trainers.')->group(function () {
        Route::get('{trainer}')->uses([\App\Http\Controllers\TrainerController::class, 'show'])->name('show');
    });

    EnsoNewsletter::routes();

    EnsoBlog::routes('articles', Yadda\Enso\Blog\Controllers\PostController::class, 'articles');

    Route::get('{page}')->uses([\App\Http\Controllers\PageController::class, 'show'])->name('pages.show');
});
