<?php

use Illuminate\Support\Facades\Route;
use Yadda\Enso\Facades\EnsoCrud;


EnsoCrud::crudRoutes('articles', 'post', 'articles');
EnsoCrud::crudRoutes('classes', 'class', 'classes');
EnsoCrud::crudRoutes('locations', 'location', 'locations');
EnsoCrud::crudRoutes('pages', 'page', 'pages');
EnsoCrud::crudRoutes('trainers', 'trainer', 'trainers');

Route::get('/')->uses([\App\Http\Controllers\Admin\DashboardController::class, 'index']);
