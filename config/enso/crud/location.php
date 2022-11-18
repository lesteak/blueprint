<?php

return [

    /**
     * Class of the Crud Config for Locations.
     */
    'config' => App\Crud\LocationCrud::class,

    /**
     * Class of the Crud Controller for Locations.
     */
    'controller' => \App\Http\Controllers\Admin\LocationController::class,

    /**
     * Whether to add a clone button the Locations index actions
     */
    'enable_cloning' => false,

    /**
     * Properties for the Ensō menu item for Locations.
     */
    'menuitem' => [
        'icon' => 'fa fa-map-marker',
        'label' => 'Locations',
        'route' => ['admin.locations.index'],
    ],

    /**
     * Class of the Crud Model for Locations.
     */
    'model' => App\Models\Location::class,

    /**
     * Modules for the Description WysiwygField
     */
    'modules' => [
        'toolbar' => [
            ['bold', 'italic', 'underline', 'strike', 'link'],
            [['list' => 'ordered'], ['list' => 'bullet']],
            ['clean'],
        ],
    ],

];
