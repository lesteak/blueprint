<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('globalscopes')->group(function () {
    Route::resource('classes', \App\Http\Controllers\Api\ClassController::class)->only(['index']);
    Route::resource('locations', \App\Http\Controllers\Api\LocationController::class)->only(['index']);
    Route::resource('trainers', \App\Http\Controllers\Api\TrainerController::class)->only(['index']);
});
