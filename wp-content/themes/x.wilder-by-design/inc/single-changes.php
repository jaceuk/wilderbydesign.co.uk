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

// remove additional information and description tabs from single product page
add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);
function woo_remove_product_tabs($tabs)
{
  unset($tabs['additional_information']);
  unset($tabs['description']);
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
      // non-color attribute buttons
      // $checked = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'], sanitize_title($option), false) : checked($args['selected'], $option, false);
      $radios .= "<button class=\"variation-button\" data-name=\"{$name}\" data-value=\"{$option}\">{$option}";
    }
  }

  $radios .= '</button>';

  return $html . $radios;
}

/** Show variable prices just above the variations */
function move_variation_price()
{
  remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);
  add_action('woocommerce_before_variations_form', 'woocommerce_single_variation', 10);
}
add_action('woocommerce_before_add_to_cart_form', 'move_variation_price');

/*
 * Content before product meta
 */
add_action('woocommerce_product_meta_start', 'add_content_before_product_meta');
function add_content_before_product_meta()
{
  get_template_part('components/product-meta');
}
