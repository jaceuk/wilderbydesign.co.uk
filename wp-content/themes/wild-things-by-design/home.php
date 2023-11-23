<?php

/**
 * Template Name: Home
 */
?>

<?php
get_header();
?>

<?php
defined('ABSPATH') || exit;
get_header('shop');
do_action('woocommerce_before_main_content');


?>

<h2 class="section-heading">Featured</h2>

<?php
echo do_shortcode('[products limit="4" columns="4" orderby="id" order="DESC" visibility="featured"]');
?>

<h2 class="section-heading">Best sellers</h2>

<?php
echo do_shortcode('[products limit="8" columns="4" orderby="popularity" best_selling="true" category="mugs" ]');
?>

</main>

<?php
get_footer();
