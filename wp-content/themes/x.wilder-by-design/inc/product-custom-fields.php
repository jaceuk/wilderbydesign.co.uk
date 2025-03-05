<?php

/**
 * @snippet       Add input field to products - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 8
 * @community     https://businessbloomer.com/club/
 */

use const Avifinfo\UNDEFINED;

// -----------------------------------------
// 1. Show custom input field above Add to Cart

add_action('woocommerce_after_add_to_cart_quantity', 'bbloomer_product_add_on', 9);

function bbloomer_product_add_on()
{
  $value = isset($_POST['personalisation']) ? sanitize_text_field($_POST['personalisation']) : '';


  // get parent category
  global $post;
  $tags = get_the_terms($post->ID, 'product_tag');

  $pers_product = get_field('pers_product');
  $pers_required = get_field('pers_required') ? 'Required' : 'Optional';
  $pers_instructions = get_field('pers_instructions');
  $pers_max_characters = get_field('pers_max_characters') ? get_field('pers_max_characters') : 144;
  $pers_photo_required = get_field('pers_photo_required');
  $required = get_field('pers_required') ? 'required' : null;

  if ($pers_product == 1) {
    echo '<div class="personalisation-callout">';
    echo '<div class="label-container"><label for="personalisation">Personalisation (' . $pers_required . ')</label></div>';
    echo '<p class="small">' . $pers_instructions . '</p>';
    echo '<div>';
    echo '<textarea id="personalisation" name="personalisation" rows="4" maxlength="' . $pers_max_characters . '" ' . $required . '>' . $value . '</textarea>';
    echo '<p class="small">Max. ' . $pers_max_characters . ' characters</p>';
    echo '</div>';

    if ($pers_photo_required == 1) {
      echo '<p class="label">Getting your photo to us (required)</p>';
      echo '<p class="small">When you have completed your purchase you\'ll need to email your photo along with your order number.</p>';
      echo '<p class="small">Please check our FAQ for more details on <a href="/faq#send-photo">how to get your photo to us</a>.</p>';
    }

    echo '</div>';
  }
}

// -----------------------------------------
// 2. Throw error if custom input field empty

// add_filter('woocommerce_add_to_cart_validation', 'bbloomer_product_add_on_validation', 10, 3);

// function bbloomer_product_add_on_validation($passed, $product_id, $qty)
// {
// 	if (isset($_POST['name']) && sanitize_text_field($_POST['name']) == '') {
// 		wc_add_notice('Custom Text Add-On is a required field', 'error');
// 		$passed = false;
// 	}
// 	return $passed;
// }

// -----------------------------------------
// 3. Save custom input field value into cart item data

add_filter('woocommerce_add_cart_item_data', 'bbloomer_product_add_on_cart_item_data', 10, 2);

function bbloomer_product_add_on_cart_item_data($cart_item, $product_id)
{
  if (isset($_POST['personalisation'])) {
    $cart_item['personalisation'] = sanitize_text_field($_POST['personalisation']);
  }
  return $cart_item;
}

// -----------------------------------------
// 4. Display custom input field value @ Cart

add_filter('woocommerce_get_item_data', 'bbloomer_product_add_on_display_cart', 10, 2);

function bbloomer_product_add_on_display_cart($data, $cart_item)
{
  if (isset($cart_item['personalisation'])) {
    $data[] = array(
      'name' => 'Personalisation',
      'value' => sanitize_text_field($cart_item['personalisation'])
    );
  }
  return $data;
}

// -----------------------------------------
// 5. Save custom input field value into order item meta

add_action('woocommerce_add_order_item_meta', 'bbloomer_product_add_on_order_item_meta', 10, 2);

function bbloomer_product_add_on_order_item_meta($item_id, $values)
{
  if (!empty($values['personalisation'])) {
    wc_add_order_item_meta($item_id, 'Personalisation', $values['personalisation'], true);
  }
}

// -----------------------------------------
// 7. Display custom input field value into order emails

add_filter('woocommerce_email_order_meta_fields', 'bbloomer_product_add_on_display_emails');

function bbloomer_product_add_on_display_emails($fields)
{
  $fields['name'] = 'Personalisation';
  return $fields;
}
