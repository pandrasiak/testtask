<?php
/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */ 

define('TEMPLATE_DIR', get_stylesheet_directory().'/');

require_once(TEMPLATE_DIR.'incl/cpt_books.php');
require_once(TEMPLATE_DIR.'incl/taxonomy_genre.php');
require_once(TEMPLATE_DIR.'incl/shortcode_most_recent_book_title.php');
require_once(TEMPLATE_DIR.'incl/shortcode_books_by_genre.php');
require_once(TEMPLATE_DIR.'incl/ajax_get_books.php');

add_action( 'wp_enqueue_scripts', 'twenty_twenty_child_style' );
function twenty_twenty_child_style() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/dist/style.css', array('parent-style') );

	wp_enqueue_script(
		'child-custom-js', 
		get_stylesheet_directory_uri() . '/dist/main.js',
		array('jquery'),
		filemtime( get_stylesheet_directory() . '/dist/main.js' ),
		true 
	);

	wp_localize_script( 'child-custom-js', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}

function custom_image_sizes() {
    add_image_size( 'book-image', 523, 523, true );
}
add_action( 'after_setup_theme', 'custom_image_sizes' );

 