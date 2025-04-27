<?php

get_header();

if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); ?>

        <article class="c-single-book">
            <div class="c-single-book__container">
                <h1 class="c-single-book__title"><?php the_title(); ?></h1>

                <div class="c-single-book__image">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <img src="<?php the_post_thumbnail_url( 'full' ); ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                </div>

                <div class="c-single-book__info">

                    <div class="c-single-book__genre">
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

                    <div class="c-single-book__date">
                        <p><?php printf( __( 'Published on: %s', 'twenty-twenty-child' ), get_the_date() ); ?></p>
                    </div>
                    
                </div>

                <div class="c-single-book__content">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>

    <?php endwhile;
endif;

get_footer();
