<?php
get_header(); 

$term = get_queried_object();

$args = array(
    'post_type' => 'book',
    'posts_per_page' => get_option('posts_per_page'),
    'tax_query' => array(
        array(
            'taxonomy' => 'book-genre',
            'field'    => 'id',
            'terms'    => $term->term_id,
        ),
    ),
    'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
);

$query = new WP_Query( $args );
?>

<section class="c-genre-list">
    <div class="c-genre-list__container">
        <h1 class="c-genre-list__title"><?php printf( __( 'Books in the "%s" Genre', 'twenty-twenty-child' ), $term->name ); ?></h1>

        <?php
        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post(); ?>

                <article class="c-genre-item">
                    
                    <a class="c-genre-item__link" href="<?php the_permalink(); ?>"></a>

                    <div class="c-genre-item__row">

                        <div class="c-genre-item__image">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <img src="<?php the_post_thumbnail_url( 'book-image' ); ?>" alt="<?php the_title(); ?>" loading="lazy">
                            <?php endif; ?>
                        </div>

                        <div class="c-genre-item__info">

                            <h2 class="c-genre-item__title"><?php the_title(); ?></h2>

                            <div class="c-genre-item__genre">
                                <?php 
                                $terms = get_the_terms( get_the_ID(), 'book-genre' );
                                if ( $terms && ! is_wp_error( $terms ) ) : 
                                    $genres = array();
                                    foreach ( $terms as $term ) {
                                        $genres[] = $term->name;
                                    }
                                    echo sprintf( __( 'Genre: %s', 'twenty-twenty-child' ), implode( ', ', $genres ) );
                                endif;
                                ?>
                            </div>

                            <div class="c-genre-item__excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            <div class="c-genre-item__date">
                                <?php printf( __( 'Published on: %s', 'twenty-twenty-child' ), get_the_date() ); ?>
                            </div>

                        </div>
                    </div>
                </article>

            <?php endwhile;

            echo '<div class="c-pagination">';
            echo paginate_links( array(
                'total' => $query->max_num_pages,
            ) );
            echo '</div>';

        else :
            echo '<p>' . __( 'No books found in this genre.', 'twenty-twenty-child' ) . '</p>';
        endif;

        wp_reset_postdata();
        ?>
    </div>
</section>

<?php get_footer(); ?>
