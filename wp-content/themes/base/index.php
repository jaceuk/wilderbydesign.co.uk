<?php get_header(); ?>

    <section class="posts">

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
                    echo '<p>Sorry, there are no posts.</p>';
                endif;
            ?>

    </section>

<?php
get_footer();
