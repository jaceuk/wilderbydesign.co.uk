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

  foreach ($categories as $category) {
    // skip if category is a collection
    $cat_id =  $category->term_id;
  }

  $tags = get_the_terms($post->ID, 'product_tag');

  // show the product description
  $content .= get_field('description_for_the_single_product_page', 'product_cat_' . $cat_id);

  // show the design description
  if (!empty($tags) && !is_wp_error($tags)) {
    foreach ($tags as $tag) {
      $tag_type = get_field('tag_type',  $tag->taxonomy . '_' . $tag->term_id);
      if (strtolower($tag_type) === 'design') {
        $content .= wpautop($tag->description);
      }
    }
  }

  // show the product bullet points
  $content .= '<h3>' . get_field('product_details_title', 'option') . '</h3>';
  $content .= get_field('bullet_points_for_the_single_product_page', 'product_cat_' . $cat_id);
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

/********
// change variations from select list to buttons
 ********/
add_filter('woocommerce_dropdown_variation_attribute_options_html', 'rudr_radio_variations', 20, 2);
function rudr_radio_variations($html, $args)
{

  // in wc_dropdown_variation_attribute_options() they also extract all the array elements into variables
  $options   = $args['options'];
  $product   = $args['product'];
  $attribute = $args['attribute'];
  $name      = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title($attribute);
  $id        = $args['id'] ? $args['id'] : sanitize_title($attribute);
  $class     = $args['class'];

  if (empty($options) || !$product) {
    return $html;
  }

  // HTML for our radio buttons
  $radios = '<div class="variation-buttons">';

  // taxonomy-based attributes
  if (taxonomy_exists($attribute)) {

    $terms = wc_get_product_terms(
      $product->get_id(),
      $attribute,
      array(
        'fields' => 'all',
      )
    );

    foreach ($terms as $term) {
      if (in_array($term->slug, $options, true)) {
        $colour = get_field('colour', 'term_' . $term->term_id);
        $text = $colour ? '' : $term->name;
        $class = $colour ? 'colour' : '';
        $radios .= '<button class="variation-button ' . $class . '" data-name="' . $name . '" data-value="' . $term->slug . '" style="background: ' . $colour . '">' . $text;
      }
    }
    // individual product attributes
  } else {
    foreach ($options as $option) {
      // $checked = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'], sanitize_title($option), false) : checked($args['selected'], $option, false);
      $radios .= "<button class=\"variation-button\" data-name=\"{$name}\" data-value=\"{$option}\">{$option}";
    }
  }

  $radios .= '</button>';

  return $html . $radios;
}


/* Dynamic Button for Simple & Variable Product */
/**
 * Main Functions
 */
// function sbw_wc_add_buy_now_button_single()
// {
//   global $product;
//   printf('<button id="sbw_wc-adding-button" type="submit" name="sbw-wc-buy-now" value="%d" class="single_add_to_cart_button buy_now_button button alt">%s</button>', $product->get_ID(), esc_html__('Buy Now', 'sbw-wc'));
// }
// add_action('woocommerce_after_add_to_cart_button', 'sbw_wc_add_buy_now_button_single');
// /*** Handle for click on buy now ***/
// function sbw_wc_handle_buy_now()
// {
//   if (!isset($_REQUEST['sbw-wc-buy-now'])) {
//     return false;
//   }
//   WC()->cart->empty_cart();
//   $product_id = absint($_REQUEST['sbw-wc-buy-now']);
//   $quantity = absint($_REQUEST['quantity']);
//   if (isset($_REQUEST['variation_id'])) {
//     $variation_id = absint($_REQUEST['variation_id']);
//     WC()->cart->add_to_cart($product_id, $quantity, $variation_id);
//   } else {
//     WC()->cart->add_to_cart($product_id, $quantity);
//   }
//   wp_safe_redirect(wc_get_checkout_url());
//   exit;
// }
// add_action('wp_loaded', 'sbw_wc_handle_buy_now');
