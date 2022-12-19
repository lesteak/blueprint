<?php

return [

    /**
     * Class of the Crud Config for Trainers.
     */
    'config' => App\Crud\TrainerCrud::class,

    /**
     * Class of the Crud Controller for Trainers.
     */
    'controller' => \App\Http\Controllers\Admin\TrainerController::class,

    /**
     * Whether to add a clone button the Trainers index actions
     */
    'enable_cloning' => false,

    /**
     * Properties for the Ensō menu item for Trainers.
     */
    'menuitem' => [
        'icon' => 'fa fa-graduation-cap',
        'label' => 'Trainers',
        'route' => ['admin.trainers.index'],
    ],

    /**
     * Class of the Crud Model for Trainers.
     */
    'model' => App\Models\Trainer::class,

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
