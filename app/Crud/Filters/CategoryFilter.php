<?php

namespace App\Crud\Filters;

use Yadda\Enso\Crud\Filters\BaseFilters\TextFilter;

class CategoryFilter extends TextFilter
{
    /**
     * Columns to search in
     *
     * @var array
     */
    protected $columns = [
        'enso_categories.name',
        'enso_categories.slug',
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
        'help-text' => 'Category\'s name or slug',
    ];
}
