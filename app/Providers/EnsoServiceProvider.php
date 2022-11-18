<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EnsoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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
