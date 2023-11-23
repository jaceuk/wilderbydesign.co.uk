<?php get_header(); ?>

    <?php get_template_part('template-parts/page-header'); ?>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="page-content">
                        <h1><?php
                            /* translators: %s: search query. */
                            printf( esc_html__( 'Search Results for: %s', 'base' ), '<span>' . get_search_query() . '</span>' );
                        ?></h1>

                        <?php
                            if ( have_posts() ) : ?>

                        <?php
                                /* Start the Loop */
                                while ( have_posts() ) : the_post();
                        ?>
                                    <article id="post-<?php the_ID(); ?>">
                                        <h1><?php the_title(); ?></h1>
                                        <p class="date"><?php the_date(); ?></p>
                                        <?php the_content(); ?>
                                    </article><!-- #post-<?php the_ID(); ?> -->
                        <?php
                                endwhile;

                                the_posts_navigation();

                            else :
                                echo '<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>';
                            endif;
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
