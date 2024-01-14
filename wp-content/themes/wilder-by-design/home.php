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
    $top_callouts = get_field_object('top_callouts');
    get_template_part('components/callouts', null, $top_callouts);
    ?>
  </div>

  <?php
  get_template_part('components/personalisation');
  ?>

  <div class="inner-wrapper">
    <?php
    $middle_callouts = get_field_object('middle_callouts');
    get_template_part('components/callouts', null, $middle_callouts);
    ?>
  </div>

  <?php
  get_template_part('components/partial-personalisation');
  ?>

  <div class="inner-wrapper">
    <?php
    $bottom_callouts = get_field_object('bottom_callouts');
    get_template_part('components/callouts', null, $bottom_callouts);
    ?>
  </div>
</main>

<?php
get_footer();
