<?php

add_action( 'wp_ajax_get_books', 'get_books_callback' );
add_action( 'wp_ajax_nopriv_get_books', 'get_books_callback' );


function get_books_callback() {
    $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;

    $args = array(
        'post_type' => 'book',
        'posts_per_page' => 5,
        'orderby' => 'title',
        'order' => 'ASC',
        'paged' => $paged,
    );

    $query = new WP_Query( $args );

    $books = array();

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) : $query->the_post();
            $books[] = array(
                'name'    => get_the_title(),
                'date'    => get_the_date(),
                'genre'   => get_the_term_list( get_the_ID(), 'book-genre', '', ', ' ),
                'excerpt' => get_the_excerpt(),
            );
        endwhile;
    }

    wp_reset_postdata();

    wp_send_json_success( $books );
}


function shortcode_load_more_btn() {
    ob_start();
    ?>

    <div class="c-load-more js-load-more">
        <template class="c-load-more__template js-load-more__template">
            <li class="book-item">
                <h3 class="book-title">{{name}}</h3>
                <p class="book-genre">{{genre}}</p>
                <p class="book-date">{{date}}</p>
                <p class="book-excerpt">{{excerpt}}</p>
            </li>
        </template>
        <div class="c-load-more__result js-load-more__result">
        </div>
        <a class="c-load-more__btn js-load-more__btn" data-next-page="1">Load posts via ajax</a>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode( 'load_more_btn', 'shortcode_load_more_btn' );

