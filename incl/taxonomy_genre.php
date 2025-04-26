<?php

function create_book_genre_taxonomy() {
    $labels = array(
        'name'              => __('Genres', 'text-domain'),
        'singular_name'     => __('Genre', 'text-domain'),
        'search_items'      => __('Search Genres', 'text-domain'),
        'all_items'         => __('All Genres', 'text-domain'),
        'parent_item'       => __('Parent Genre', 'text-domain'),
        'parent_item_colon' => __('Parent Genre:', 'text-domain'),
        'edit_item'         => __('Edit Genre', 'text-domain'),
        'update_item'       => __('Update Genre', 'text-domain'),
        'add_new_item'      => __('Add New Genre', 'text-domain'),
        'new_item_name'     => __('New Genre Name', 'text-domain'),
        'menu_name'         => __('Genre', 'text-domain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'book-genre'),
    );

    register_taxonomy('book-genre', array('book'), $args);
}
add_action('init', 'create_book_genre_taxonomy');