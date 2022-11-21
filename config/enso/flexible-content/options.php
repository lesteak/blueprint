<?php

use App\Crud\Rows\CtasRow;
use App\Crud\Rows\EnquiryButtonRow;
use App\Crud\Rows\FeatureRow;
use App\Crud\Rows\FullHeroRow;

return [

    /**
     * Selections are used to populate checkbox fields in flexible content.
     */
    'default-component' => [
        'button_components' => [
            'pointy' => true,
        ],
        'divider' => [
            'bottom' => false,
        ],
    ],

    'components' => [
        'button_components' => [
            'pointy' => 'Pointy Button',
        ],
        'divider' => [
            'bottom' => 'Bottom',
        ],
    ],

    /**
     * Selections are used to populate single-select fields in flexible content.
     */
    'default-selection' => [
        'background' => 'light',
        'more_content' => 'see_all',
    ],

    'selections' => [
        'background' => [
            'light' => 'Light',
            'dark' => 'Dark',
        ],
        'more_content' => [
            'none' => 'None',
            'see_all' => 'See All Link',
            'load_more' => 'Load More Button',
        ]
    ],

    'rows' => [
        'articles' => \App\Crud\Rows\ArticlesRow::class,
        'button' => \App\Crud\Rows\ButtonRow::class,
        'carousel' => \App\Crud\Rows\CarouselRow::class,
        'classes' => \App\Crud\Rows\ClassesRow::class,
        'cta' => \App\Crud\Rows\CtaRow::class,
        'ctas' => \App\Crud\Rows\CtasRow::class,
        'enquirybutton' => \App\Crud\Rows\EnquiryButtonRow::class,
        'feature' => \App\Crud\Rows\FeatureRow::class,
        'features' => \App\Crud\Rows\FeaturesRow::class,
        'fullhero' => \App\Crud\Rows\FullHeroRow::class,
        'hero' => \App\Crud\Rows\HeroRow::class,
        'quote' => \App\Crud\Rows\QuoteRow::class,
        'text' => \App\Crud\Rows\TextRow::class,
        'textimage' => \App\Crud\Rows\TextImageRow::class,
        'textvideo' => \App\Crud\Rows\TextVideoRow::class,
        'trainers' => \App\Crud\Rows\TrainersRow::class,
    ],

];
