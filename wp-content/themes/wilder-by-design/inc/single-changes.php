<?php

/**
 * @snippet       Add "Quantity:" before Add to Cart Button - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 8
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

add_action('woocommerce_before_add_to_cart_quantity', 'bbloomer_echo_qty_front_add_cart', 10);

function bbloomer_echo_qty_front_add_cart()
{
  global $product;
  if ($product->get_min_purchase_quantity() == $product->get_max_purchase_quantity()) return;
  echo '<label>Quantity: </label>';
}

/**
 * Automatically add product details below the description
 */
add_filter('the_content', 'woocommerce_custom_product_description', 20, 1);
function woocommerce_custom_product_description($content)
{
  // Only for woocommerce single product pages
  if (!is_product())
    return $content;

  // get parent category
  global $post;
  $categories = get_the_terms($post->ID, 'product_cat');
  $cat_id =  $categories[0]->term_id;

  $tags = get_the_terms($post->ID, 'product_tag');

  // show the design description
  if (!empty($tags) && !is_wp_error($tags)) {
    foreach ($tags as $tag) {
      $tag_type = get_field('tag_type',  $tag->taxonomy . '_' . $tag->term_id);
      if (strtolower($tag_type) === 'design') {
        $content .= wpautop($tag->description);
      }
    }
  }

  // show the product the category description
  $content .= '<h3>' . get_field('product_details_title', 'option') . '</h3>';
  $content .= get_field('description_for_the_single_product_page', 'product_cat_' . $cat_id);
  $content .= get_field('made_to_order_message', 'option');

  return $content;
}

// Show description tab even if there is no description
function woocommerce_default_description($content)
{
  $empty = empty($content) || trim($content) === '';
  if (is_product() && $empty) {
    $content = ' ';
  }
  return $content;
}
add_filter('the_content', 'woocommerce_default_description');

function rmg_woocommerce_default_product_tabs($tabs)
{
  if (empty($tabs['description'])) {
    $tabs['description'] = array(
      'title'    => __('Description', 'woocommerce'),
      'priority' => 10,
      'callback' => 'woocommerce_product_description_tab',
    );
  }
  return $tabs;
}
add_filter('woocommerce_product_tabs', 'rmg_woocommerce_default_product_tabs');

// remove additional information tab from single product page
add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);
function woo_remove_product_tabs($tabs)
{
  unset($tabs['additional_information']);
  return $tabs;
}
