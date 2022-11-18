<?php

return [
    /**
     * Maximum number of related posts to show on a posts.show route
     */
    'max_related_posts' => env('MAX_RELATED_BLOG_POSTS', 3),

    /**
     * View from which to extend post views.
     *
     * This view must contain a 'content' section
     */
    'layout_view' => 'layouts.app',

    /**
     * XHR Route from which to fetch categories
     */
    'category_route' => 'json.categories.index',

    /**
     * Whether to update the post's author to the current user if it isn't
     * otherwise set whenever the post is saved.
     */
    'force_post_authors' => true,

    /**
     * Base route name for the blog
     */
    'public_route' => 'articles',

    /**
     * Image thumbnail sizes to return on XHR index requests.
     *
     * Keys are the names that will be used on the frontend
     * Values are Enso Media image preset names
     */
    'thumbnail_sizes' => [
        'default' => '768_x',
    ],
];
