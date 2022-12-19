<?php

return [

    /**
     * Class of the Crud Config for Users.
     */
    'config' => App\Crud\ClassCrud::class,

    /**
     * Class of the Crud Controller for Users.
     */
    'controller' => \App\Http\Controllers\Admin\ClassController::class,

    /**
     * Whether to add a clone button the Users index actions
     */
    'enable_cloning' => false,

    /**
     * Properties for the Ensō menu item for Users.
     */
    'menuitem' => [
        'icon' => 'fa fa-calendar-check-o',
        'label' => 'Classes',
        'route' => ['admin.classes.index'],
    ],

    /**
     * Class of the Crud Model for Users.
     */
    'model' => App\Models\ClassModel::class,

];
