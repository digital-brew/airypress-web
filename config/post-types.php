<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Post Types
    |--------------------------------------------------------------------------
    |
    | Post types to be registered with Extended CPTs
    | <https://github.com/johnbillion/extended-cpts>
    |
    */

    'post_types' => [
        'doc' => [
            'menu_icon' => 'dashicons-book-alt',
            'menu_position' => 21,
            'supports' => ['title', 'editor', 'excerpt', 'revisions', 'page-attributes'],
            'show_in_rest' => true,
            'has_archive' => true,
            'archive' => [
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'nopaging' => true,
            ],
            'admin_cols' => [
                'menu_order' => [
                    'title' => 'Order',
                    'post_field' => 'menu_order',
                    'default' => 'ASC',
                ],
                'source' => [
                    'title' => 'Source file',
                    'meta_key' => '_docs_source',
                ],
                'updated' => [
                    'title' => 'Updated',
                    'post_field' => 'post_modified',
                    'date_format' => 'Y-m-d H:i',
                ],
            ],
            'names' => [
                'singular' => 'Doc',
                'plural' => 'Docs',
                'slug' => 'docs',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Taxonomies
    |--------------------------------------------------------------------------
    |
    | Taxonomies to be registered with Extended CPTs library
    | <https://github.com/johnbillion/extended-cpts>
    |
    */

    'taxonomies' => [],
];
