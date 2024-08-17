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
function add_img_wrapper_close()
{
  $fully_personalised = get_field('pers_photo_required') || get_field('pers_required');
  $optional_personalisation = get_field('pers_product') && !get_field('pers_required') && !get_field('pers_photo_required');

  if ($fully_personalised) echo '<p class="personalisation-notice">Personalised</p>';
  if ($optional_personalisation) echo '<p class="personalisation-notice">Optional personalisation</p>';

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
  $cols = 18;
  return $cols;
}


// define the woocommerce_pagination_args callback
function filter_woocommerce_pagination_args($array)
{
  $array = array(
    'base' => esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false)))),
    'format' => '',
    'current' => max(1, get_query_var('paged')),
    'prev_text' => '←',
    'next_text' => '→',
    'type' => 'list',
    'end_size' => 1,
    'mid_size' => 1
  );
  return $array;
};

// add the filter
add_filter('woocommerce_pagination_args', 'filter_woocommerce_pagination_args', 10, 1);
