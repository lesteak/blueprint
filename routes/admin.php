<?php

use Illuminate\Support\Facades\Route;
use Yadda\Enso\Facades\EnsoCrud;


EnsoCrud::crudRoutes('pages', 'page', 'pages');

Route::get('/')->uses([\App\Http\Controllers\Admin\DashboardController::class, 'index']);
