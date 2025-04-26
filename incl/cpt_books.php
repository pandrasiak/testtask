<?php

function create_books_custom_post_type() {
    $labels = array(
        'name'                  => __('Books', 'text-domain'),
        'singular_name'         => __('Book', 'text-domain'),
        'menu_name'             => __('Library', 'text-domain'),
        'name_admin_bar'        => __('Book', 'text-domain'),
        'add_new'               => __('Add New', 'text-domain'),
        'add_new_item'          => __('Add New Book', 'text-domain'),
        'new_item'              => __('New Book', 'text-domain'),
        'edit_item'             => __('Edit Book', 'text-domain'),
        'view_item'             => __('View Book', 'text-domain'),
        'all_items'             => __('All Books', 'text-domain'),
        'search_items'          => __('Search Books', 'text-domain'),
        'parent_item_colon'     => __('Parent Books:', 'text-domain'),
        'not_found'             => __('No books found.', 'text-domain'),
        'not_found_in_trash'    => __('No books found in Trash.', 'text-domain'),
        'featured_image'        => __('Featured Image', 'text-domain'),
        'set_featured_image'    => __('Set featured image', 'text-domain'),
        'remove_featured_image' => __('Remove featured image', 'text-domain'),
        'use_featured_image'    => __('Use as featured image', 'text-domain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_in_rest'       => true, 
        'rewrite'            => array('slug' => 'library'),
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'taxonomies'         => array('book-genre'),
        'hierarchical'       => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_admin_bar'  => true,
        'menu_icon'          => 'dashicons-book',
    );

    register_post_type('book', $args);
}
add_action('init', 'create_books_custom_post_type');