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
add_filter('woocommerce_pagination_args', 'filter_woocommerce_pagination_args', 10, 1);

// show random thumnail from product gallery
// function modify_woocommerce_product_get_image($image, $product, $size, $attr)
// {
//   $image_ids = $product->get_gallery_image_ids();
//   if ($image_ids) {
//     $image_ids = array_merge($image_ids, array($product->get_image_id()));
//     $key = array_rand($image_ids);
//     $id = $image_ids[$key];
//     $image = wp_get_attachment_image($id, $size, false, $attr);
//   }
//   return $image;
// }
// add_filter('woocommerce_product_get_image', 'modify_woocommerce_product_get_image', 99, 4);


// show a random variation thumbnail for variable products
// remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
// add_action('woocommerce_before_shop_loop_item_title', 'set_product_image', 10);

// function set_product_image()
// {
//   global $product;

//   if ($product->is_type('variable')) {
//     // image of first variation
//     $default_image = '';
//     $variation_ids = $product->get_visible_children();
//     $rand_variation_id = $variation_ids[array_rand($variation_ids)];
//     $variation = wc_get_product($rand_variation_id);
//     $default_image = $variation->get_image(array(300, 300));

//     echo $default_image;
//   } else if ($product->is_type('simple')) {
//     if (has_post_thumbnail()) {
//       echo $product->get_image(array(300, 300));
//     }
//   }
// }