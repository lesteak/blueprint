<?php

namespace App\Crud\Filters;

use Yadda\Enso\Crud\Filters\BaseFilters\TextFilter;

class TrainerFilter extends TextFilter
{
    /**
     * Columns to search in
     *
     * @var array
     */
    protected $columns = [
        'trainers.name',
        'trainers.slug',
    ];

    /**
     * Label to apply to the filter
     *
     * @var string
     */
    protected $label = 'Search';

    /**
     * Props to apply to the filter
     *
     * @var array
     */
    protected $props = [
        'placeholder' => 'Search...',
        'help-text' => 'Trainer\'s name or slug',
    ];
}
