<?php

/**
 * @snippet       Add input field to products - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 8
 * @community     https://businessbloomer.com/club/
 */

// -----------------------------------------
// 1. Show custom input field above Add to Cart

add_action('woocommerce_after_add_to_cart_quantity', 'bbloomer_product_add_on', 9);

function bbloomer_product_add_on()
{
  $value = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
  echo '<div class="personalisation-callout">';
  echo '<p>Personalisation</p>';
  echo '<div class="label-container"><label>Name (optional)</label></div><input name="name" value="' . $value . '">';
  echo '<p class="small">Please enter the name you\' like printed on your item. Leave this empty if you\'d rather not have a name.</p>';

  // get parent category
  global $post;
  $tags = get_the_terms($post->ID, 'product_tag');

  foreach ($tags as $tag) {
    if (str_contains($tag->slug, 'personalised')) {
      echo '<p class="label">Getting your photo to us (required)</p>';
      echo '<p class="small">When you have completed your purchase you\'ll need to email your photo along with your order number to info@wilderbydesign.co.uk..</p>';
      echo '<p class="small">Please check our FAQ for more details on <a href="/faq#send-photo">how to get your photo to us</a>.</p>';
    }
  }

  echo '</div>';
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
  if (isset($_POST['name'])) {
    $cart_item['name'] = sanitize_text_field($_POST['name']);
  }
  return $cart_item;
}

// -----------------------------------------
// 4. Display custom input field value @ Cart

add_filter('woocommerce_get_item_data', 'bbloomer_product_add_on_display_cart', 10, 2);

function bbloomer_product_add_on_display_cart($data, $cart_item)
{
  if (isset($cart_item['name'])) {
    $data[] = array(
      'name' => 'Name',
      'value' => sanitize_text_field($cart_item['name'])
    );
  }
  return $data;
}

// -----------------------------------------
// 5. Save custom input field value into order item meta

add_action('woocommerce_add_order_item_meta', 'bbloomer_product_add_on_order_item_meta', 10, 2);

function bbloomer_product_add_on_order_item_meta($item_id, $values)
{
  if (!empty($values['name'])) {
    wc_add_order_item_meta($item_id, 'Name', $values['name'], true);
  }
}

// -----------------------------------------
// 7. Display custom input field value into order emails

add_filter('woocommerce_email_order_meta_fields', 'bbloomer_product_add_on_display_emails');

function bbloomer_product_add_on_display_emails($fields)
{
  $fields['name'] = 'Name';
  return $fields;
}