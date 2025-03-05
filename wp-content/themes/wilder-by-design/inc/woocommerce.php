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

// add ability to attach field groups to attribute terms
// Adds a custom rule type.
add_filter('acf/location/rule_types', function ($choices) {
	$choices[__("Other", 'acf')]['wc_prod_attr'] = 'WC Product Attribute';
	return $choices;
});

// Adds custom rule values.
add_filter('acf/location/rule_values/wc_prod_attr', function ($choices) {
	foreach (wc_get_attribute_taxonomies() as $attr) {
		$pa_name = wc_attribute_taxonomy_name($attr->attribute_name);
		$choices[$pa_name] = $attr->attribute_label;
	}
	return $choices;
});

// Matching the custom rule.
add_filter('acf/location/rule_match/wc_prod_attr', function ($match, $rule, $options) {
	if (isset($options['taxonomy'])) {
		if ('==' === $rule['operator']) {
			$match = $rule['value'] === $options['taxonomy'];
		} elseif ('!=' === $rule['operator']) {
			$match = $rule['value'] !== $options['taxonomy'];
		}
	}
	return $match;
}, 10, 3);

// Get 5 star reviews
// USAGE: [woo_reviews] or [woo_reviews limit="3"] for 3 random reviews for example.
function get_random_five_stars_products_reviews($atts)
{
	// Extract shortcode attributes
	extract(shortcode_atts(array(
		'limit' => 5, // number of reviews to be displayed by default
	), $atts, 'woo_reviews'));

	$comments = get_comments(array(
		'status'      => 'approve',
		'post_status' => 'publish',
		'post_type'   => 'product',
		'meta_query'  => array(array(
			'key'     => 'rating',
			'value'   => '5',
		)),
	));

	shuffle($comments);

	$comments = array_slice($comments, 0, $limit);

	$html = '<ul class="products-reviews">';
	foreach ($comments as $comment) {
		$rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
		$html .= '<li class="review">';
		$html .= '<div>' . get_the_title($comment->comment_post_ID) . '</div>';
		if ($rating > 4) $html .= wc_get_rating_html($rating);
		$html .= '<div>' . $comment->comment_content . '</div>';
		$html .= "<div>Posted By :" . $comment->comment_author . " On " . $comment->comment_date . "</div>";
		$html .= '</li>';
	}
	return $html . '</ul>';
}
add_shortcode('woo_reviews', 'get_random_five_stars_products_reviews');

function privacy_terms_notice()
{
	$html = '<div><small>';
	$html .= 'By placing this order, you agree to our <a href="/terms-of-service">Terms of Service</a> and understand our <a href="/privacy-policy">Privacy Policy</a>.';
	echo $html . '</small></div>';
}
add_action('woocommerce_review_order_before_submit', 'privacy_terms_notice', 10);

require get_template_directory() . '/inc/product-custom-fields.php';
require get_template_directory() . '/inc/archive-changes.php';
require get_template_directory() . '/inc/single-changes.php';
require get_template_directory() . '/inc/order-confirmation-changes.php';




// function remove_image_zoom_support()
// {
// 	remove_theme_support('wc-product-gallery-zoom');
// 	remove_theme_support('wc-product-gallery-lightbox');
// 	remove_theme_support('wc-product-gallery-slider');
// }
// add_action('wp', 'remove_image_zoom_support', 100);


function get_best_selling_products_last_2_months($limit = 10)
{
	global $wpdb;

	// Get the date for two months ago
	$date_from = date('Y-m-d H:i:s', strtotime('-6 months'));

	// SQL query to get the best-selling product IDs in the last 2 months
	$best_selling_products = $wpdb->get_col(
		$wpdb->prepare("
					SELECT order_item_meta.meta_value as product_id
					FROM {$wpdb->prefix}woocommerce_order_items as order_items
					JOIN {$wpdb->prefix}woocommerce_order_itemmeta as order_item_meta
							ON order_items.order_item_id = order_item_meta.order_item_id
					JOIN {$wpdb->prefix}posts AS posts
							ON order_items.order_id = posts.ID
					WHERE order_item_meta.meta_key = '_product_id'
							AND posts.post_type = 'shop_order'
							AND posts.post_status IN ('wc-completed', 'wc-processing')
							AND posts.post_date >= %s
					GROUP BY order_item_meta.meta_value
					ORDER BY COUNT(order_item_meta.meta_value) DESC
					LIMIT %d
			", $date_from, $limit)
	);

	if (empty($best_selling_products)) {
		return new WP_Query(); // Return empty query if no products found
	}

	// WP_Query to get product details
	$query = new WP_Query([
		'post_type'      => 'product',
		'posts_per_page' => $limit,
		'post__in'       => $best_selling_products,
		'orderby'        => 'post__in', // Maintain order of best sellers
	]);

	return $query;
}
