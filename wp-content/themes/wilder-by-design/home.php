<?php

/**
 * Template Name: Home
 */

get_header();

defined('ABSPATH') || exit;
get_header('shop');
?>

<main>

  <div class="inner-wrapper">
    <header>
      <?php the_title('<h1>', '</h1>'); ?>
    </header>

    <?php
    get_template_part('components/highlights');

    get_template_part('components/animals');
    ?>
  </div>

  <?php
  get_template_part('components/newsletter-signup');
  ?>

  <div class="inner-wrapper">
    <h2 class="section-heading">Featured</h2>
    <?php
    echo do_shortcode('[products limit="4" columns="4" orderby="id" order="DESC" visibility="featured"]');
    ?>

  </div>
</main>

<?php
get_footer();
