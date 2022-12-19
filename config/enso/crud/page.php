<?php

return [

    /**
     * Class of the Crud Config for Pages.
     */
    'config' => App\Crud\Page::class,

    /**
     * Class of the Crud Controller for Pages.
     */
    'controller' => App\Http\Controllers\Admin\PageController::class,

    /**
     * Whether to add a clone button the Pages index actions
     */
    'enable_cloning' => false,

    /**
     * Properties for the Ensō menu item for Pages.
     */
    'menuitem' => [
        'icon' => 'fa fa-file-o',
        'label' => 'Pages',
        'route' => ['admin.pages.index'],
    ],

    /**
     * Class of the Crud Model for Pages.
     */
    'model' => App\Models\Page::class,

    /**
     * Records where the frontend identifier should not be editable by regular admins
     */
    'protected_records' => [
        'about',
        'contact',
        'class',
        'classes',
        'holding-page',
        'home',
        'location',
        'locations',
        'trainer',
        'trainers',
        'timetable',
    ],

    /**
     * Custom template definitions
     */
    'templated_records' => [],

];
