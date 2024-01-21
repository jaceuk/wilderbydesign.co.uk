<?php

/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Rude_by_Design
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */

function rude_by_design_woocommerce_setup()
{
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 300,
			'single_image_width'    => 800,
			'gallery_thumbnail_image_width' => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'rude_by_design_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function rude_by_design_woocommerce_scripts()
{
	wp_enqueue_style('rude-by-design-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION);

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style('rude-by-design-woocommerce-style', $inline_font);
}
add_action('wp_enqueue_scripts', 'rude_by_design_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function rude_by_design_woocommerce_active_body_class($classes)
{
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter('body_class', 'rude_by_design_woocommerce_active_body_class');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function rude_by_design_woocommerce_related_products_args($args)
{
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args($defaults, $args);

	return $args;
}
add_filter('woocommerce_output_related_products_args', 'rude_by_design_woocommerce_related_products_args');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('rude_by_design_woocommerce_wrapper_before')) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function rude_by_design_woocommerce_wrapper_before()
	{
?>
		<main id="primary" class="inner-wrapper">
		<?php
	}
}
add_action('woocommerce_before_main_content', 'rude_by_design_woocommerce_wrapper_before');

if (!function_exists('rude_by_design_woocommerce_wrapper_after')) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function rude_by_design_woocommerce_wrapper_after()
	{
		?>
		</main><!-- #main -->
<?php
	}
}
add_action('woocommerce_after_main_content', 'rude_by_design_woocommerce_wrapper_after');

// disable sidebar
function disable_woo_commerce_sidebar()
{
	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
}
add_action('init', 'disable_woo_commerce_sidebar');

// remove product meta from single product page
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// remove additional information tab from single product page
add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);
function woo_remove_product_tabs($tabs)
{
	unset($tabs['additional_information']);
	return $tabs;
}

// hide downloads link in the account section
function custom_my_account_menu_items($items)
{
	unset($items['downloads']);
	return $items;
}
add_filter('woocommerce_account_menu_items', 'custom_my_account_menu_items');


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
	$term_id =  $categories[0]->term_id;

	$content .= '<h3>' . get_field('product_details_title', 'option') . '</h3>';
	$content .= get_field('description_for_the_single_product_page', 'product_cat_' . $term_id);
	$content .= get_field('made_to_order_message', 'option');

	return $content;
}

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

// add personalisation section to the order confirmation page
add_action('woocommerce_thankyou', 'personalisation', 10, 2);

function personalisation($order_id)
{
	echo '<section class="woocommerce-personalisation">
	<h2>Personalisation</h2>
	<p>If your order contains a personalised item that requires a photo you\'ll need to email your photo along with your order number to info@wilderbydesign.co.uk.</p>
	<p>Please check our FAQ for more details on <a href="/faq#send-photo">how to get your photo to us</a>.</p>
</section>';
}


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
	echo '<div class="label-container"><label>Name (optional)</label></div><input name="name" value="' . $value . '">';
	echo '<p class="small">Please enter the name you\' like printed on your item. Leave this empty if you\'d rather not have a name.</p>';

	// get parent category
	global $post;
	$tags = get_the_terms($post->ID, 'product_tag');

	foreach ($tags as $tag) {
		if (str_contains($tag->slug, 'personalised')) {
			echo '<p class="small semi-bold">Getting your photo to us</p>';
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


// remove add to cart button from archive page
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
