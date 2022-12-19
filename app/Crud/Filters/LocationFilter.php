<?php

namespace App\Crud\Filters;

use Yadda\Enso\Crud\Filters\BaseFilters\TextFilter;

class LocationFilter extends TextFilter
{
    /**
     * Columns to search in
     *
     * @var array
     */
    protected $columns = [
        'locations.name',
        'locations.slug',
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
        'help-text' => 'Location\'s name or slug',
    ];
}
