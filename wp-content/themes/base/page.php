<?php get_header(); ?>

    <section class="page">

        <?php
            if ( have_posts() ) :

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

            else :
                echo '<p>Sorry, there is no post.</p>';
            endif;
        ?>

    </section>

<?php
get_footer();
