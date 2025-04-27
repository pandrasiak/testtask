<?php

function shortcode_recent_book_title() {
    $args = array(
        'post_type' => 'book',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        $query->the_post();
        return get_the_title();
    } else {
        return __( 'No books found', 'twenty-twenty-child' );
    }

    wp_reset_postdata();
}
add_shortcode( 'recent_book_title', 'shortcode_recent_book_title' );
