<?php
/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */  

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
 }
 