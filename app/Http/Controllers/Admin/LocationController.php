<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use Yadda\Enso\Crud\Controller;
use Yadda\Enso\Crud\Traits\Controller\IsPublishable;

class LocationController extends Controller
{
    use IsPublishable;
}
