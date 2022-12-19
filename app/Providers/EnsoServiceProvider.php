<?php

namespace App\Providers;

use App\Crud\Handlers\FlexibleField;
use App\Http\Resources\PostListResource;
use App\Models\Post;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Yadda\Enso\Blog\Contracts\Post as PostContract;
use Yadda\Enso\Blog\Contracts\PostResource;
use Yadda\Enso\Crud\Contracts\FlexibleFieldHandler;
use Yadda\Enso\Facades\EnsoMenu;

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
        $this->app->bind(PostContract::class, Post::class);
        $this->app->bind(PostResource::class, PostListResource::class);
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

        EnsoMenu::addItems([
            Config::get('enso.crud.class.menuitem'),
            Config::get('enso.crud.location.menuitem'),
            Config::get('enso.crud.post.menuitem'),
            Config::get('enso.crud.trainer.menuitem'),
        ]);
    }
}
