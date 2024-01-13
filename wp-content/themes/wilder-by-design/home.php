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
    $top_categories = get_field_object('top_categories');
    get_template_part('components/category-callouts', null, $top_categories);
    ?>
  </div>

  <?php
  get_template_part('components/partial-personalisation');
  ?>

  <div class="inner-wrapper">
    <?php
    $middle_categories = get_field_object('middle_categories');
    get_template_part('components/category-callouts', null, $middle_categories);
    ?>
  </div>

  <?php
  get_template_part('components/partial-personalisation');
  ?>

  <div class="inner-wrapper">
    <?php
    $bottom_categories = get_field_object('bottom_categories');
    get_template_part('components/category-callouts', null, $bottom_categories);
    ?>
  </div>
</main>

<?php
get_footer();
