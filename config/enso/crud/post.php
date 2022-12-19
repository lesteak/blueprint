<?php

return [

    /**
     * Class of the Crud Config for Posts.
     */
    'config' => \App\Crud\PostCrud::class,

    /**
     * Class of the Crud Controller for Posts.
     */
    'controller' => \Yadda\Enso\Blog\Controllers\Admin\PostController::class,

    /**
     * Properties for the Ensō menu item for Posts.
     */
    'menuitem' => [
        'icon' => 'fa fa-files-o',
        'label' => 'Articles',
        'route' => ['admin.articles.index'],
    ],

    /**
     * Class of the Crud Model for Posts.
     */
    'model' => \App\Models\Post::class,

];
