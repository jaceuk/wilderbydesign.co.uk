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
  $fully_personalised = 0;

  foreach ($tags as $tag) {
    if (str_contains($tag->slug, 'personalised')) {
      $fully_personalised = 1;
    }
  }

  if ($fully_personalised) {
    echo '<p class="personalisation-notice">Fully personalised</p>';
  } else {
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

// Show the regular price in product card if item is on sale
function custom_template_loop_price()
{
  global $product;

  if (is_a($product, 'WC_Product')) {
    echo '<span class="price">';

    if ($product->is_type('variable')) {
      $regular_price = $product->get_variation_regular_price('min');

      echo '<span class="price-prefix">From </span><span class="woocommerce-Price-amount amount">';

      if ($product->is_on_sale()) {
        $sale_price = $product->get_variation_sale_price('min');
        echo '<bdi><del><span class="woocommerce-Price-currencySymbol">£</span>' . $regular_price . '</del></bdi> <bdi><span class="woocommerce-Price-currencySymbol">£</span>' . $sale_price . '</bdi>';
      } else {
        echo '<bdi><span class="woocommerce-Price-currencySymbol">£</span>' . $regular_price . '</bdi>';
      }

      echo '</span>';
    } else {
      $regular_price = $product->get_regular_price('min');

      echo '<span class="woocommerce-Price-amount amount">';

      if ($product->is_on_sale()) {
        $sale_price = $product->get_sale_price();
        echo '<bdi><del><span class="woocommerce-Price-currencySymbol">£</span>' . $regular_price . '</del></bdi> <bdi><span class="woocommerce-Price-currencySymbol">£</span>' . $sale_price . '</bdi>';
      } else {
        echo '<bdi><span class="woocommerce-Price-currencySymbol">£</span>' . $regular_price . '</bdi>';
      }

      echo '</span>';
    }

    echo '</span>';
  }

  remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
  remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
}
add_action('woocommerce_after_shop_loop_item_title', 'custom_template_loop_price', 5);

// replace single product price with new snippet
add_action('woocommerce_single_product_summary', 'custom_template_loop_price', 6);
