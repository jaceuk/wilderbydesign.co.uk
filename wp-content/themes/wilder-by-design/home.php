<?php

/**
 * Template Name: Home
 */

get_header();

defined('ABSPATH') || exit;
get_header('shop');
?>

<main>
  <?php
  get_template_part('components/hero');
  get_template_part('components/benefits-slim');
  get_template_part('components/best-sellers');
  get_template_part('components/collections');
  get_template_part('components/personalised-gifts');
  ?>
</main>

<?php
get_footer();
