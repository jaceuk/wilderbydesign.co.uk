<?php
// remove add to cart button from archive page
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');

// add personalisation options to products on archive page
// https://bradley-davis.com/add-wrapper-around-images-woocommerce-archive-pages/
function add_img_wrapper_start()
{
  echo '<div class="archive-img-wrap">';
}
add_action('woocommerce_before_shop_loop_item_title', 'add_img_wrapper_start', 5, 2);
// Close the div that we just added
function add_img_wrapper_close()
{
  global $post;
  $tags = get_the_terms($post->ID, 'product_tag');
  $personalised = 0;
  $optional_personalisation = 0;

  foreach ($tags as $tag) {
    if ($tag->slug === 'personalised') {
      $personalised = 1;
    }

    if ($tag->slug !== 'personalised' && $tag->slug === 'optional-personalisation') {
      $optional_personalisation = 1;
    }
  }

  if ($personalised) {
    echo '<p class="personalisation-notice">Fully personalised</p>';
  }

  if ($optional_personalisation) {
    echo '<p class="personalisation-notice">Optional personalisation</p>';
  }
  echo '</div>';
}
add_action('woocommerce_before_shop_loop_item_title', 'add_img_wrapper_close', 12, 2);

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);

function new_loop_shop_per_page($cols)
{
  // $cols contains the current number of products per page based on the value stored on Options –> Reading
  // Return the number of products you wanna show per page.
  $cols = 16;
  return $cols;
}
