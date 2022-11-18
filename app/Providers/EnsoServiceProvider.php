<?php

namespace App\Providers;

use App\Crud\Handlers\FlexibleField;
use Illuminate\Support\ServiceProvider;
use Yadda\Enso\Crud\Contracts\FlexibleFieldHandler;

class EnsoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
                $this->app->bind(FlexibleFieldHandler::class, FlexibleField::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('enso', \App\Http\Middleware\RestrictCmsAccess::class);
    }
}
