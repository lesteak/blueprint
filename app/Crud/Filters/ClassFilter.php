<?php

namespace App\Crud\Filters;

use Yadda\Enso\Crud\Filters\BaseFilters\TextFilter;

class ClassFilter extends TextFilter
{
    /**
     * Columns to search in
     *
     * @var array
     */
    protected $columns = [
        'classes.name',
        'classes.slug',
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
        'help-text' => 'Class\' name or slug',
    ];
}
