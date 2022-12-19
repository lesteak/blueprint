<?php

namespace App\Crud\Filters;

use Yadda\Enso\Crud\Filters\BaseFilters\TextFilter;

class ArticleFilter extends TextFilter
{
    /**
     * Columns to search in
     *
     * @var array
     */
    protected $columns = [
        'enso_posts.title',
        'enso_posts.slug',
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
        'help-text' => 'Article\'s title or slug',
    ];
}
