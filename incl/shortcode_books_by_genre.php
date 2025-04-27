<?php

function shortcode_books_by_genre( $atts ) {
    
    $atts = shortcode_atts( array(
        'genre' => '',
    ), $atts );

    if ( empty( $atts['genre'] ) ) {
        return __( 'Please specify a genre ID.', 'twenty-twenty-child' );
    }

    $args = array(
        'post_type' => 'book',
        'posts_per_page' => 5,
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'book-genre',
                'field'    => 'term_id',
                'terms'    => $atts['genre'],
            ),
        ),
    );

    $query = new WP_Query( $args );

    ob_start();

    if ( $query->have_posts() ) {
        echo '<ul class="books-by-genre">';

        while ( $query->have_posts() ) : $query->the_post();
            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        endwhile;

        echo '</ul>';
    } else {
        echo __( 'No books found in this genre.', 'twenty-twenty-child' );
    }

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode( 'books_by_genre', 'shortcode_books_by_genre' );
