<?php

/**
 * Rude by Design functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Rude_by_Design
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '2.6.1');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function rude_by_design_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Rude by Design, use a find and replace
		* to change 'rude-by-design' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('rude-by-design', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'rude_by_design_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rude_by_design_content_width()
{
	$GLOBALS['content_width'] = apply_filters('rude_by_design_content_width', 640);
}
add_action('after_setup_theme', 'rude_by_design_content_width', 0);

/**
 * Add support for menus.
 *
 */
add_theme_support('menus');

add_action('init', 'register_my_menus');

function register_my_menus()
{
	register_nav_menus(
		array(
			'home-and-living-menu' => __('Home & Living Menu'),
			'clothing-menu' => __('Clothing Menu')
		)
	);
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wilder_by_design_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Product Filters', 'wilder-by-design'),
			'id'            => 'product-filters',
			'description'   => esc_html__('Add widgets here.', 'wilder-by-design'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'wilder_by_design_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function custom_scripts()
{
	wp_enqueue_style('custom-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_script('custom-main', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true);
}
add_action('wp_enqueue_scripts', 'custom_scripts');

// remove admin bar
add_filter('show_admin_bar', '__return_false');

// prevent empty search
add_filter('posts_search', function ($search, \WP_Query $q) {
	if (!is_admin() && empty($search) && $q->is_search() && $q->is_main_query())
		$search .= " AND 0=1 ";

	return $search;
}, 10, 2);


/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}


// Facebook compatibility
function fb_opengraph()
{
	global $post;

	if (!$post) return;

	if (is_product() || is_product_category()) {
		if (has_post_thumbnail($post->ID)) {
			$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
			$img_src = $img_src[0];
		} else {
			$img_src = get_stylesheet_directory_uri() . '/img/opengraph_image.jpg';
		}
		if ($excerpt = $post->post_excerpt) {
			$excerpt = strip_tags($post->post_excerpt);
			$excerpt = str_replace("", "'", $excerpt);
		} else {
			$excerpt = get_bloginfo('description');
		}
?>

		<meta property="og:title" content="<?php echo the_title(); ?>" />
		<meta property="og:description" content="<?php echo $excerpt; ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="<?php echo the_permalink(); ?>" />
		<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>" />
		<meta property="og:image" content="<?php echo $img_src; ?>" />

<?php
	} else {
		return;
	}
}
add_action('wp_head', 'fb_opengraph', 5);

// change variabe price format
function asnp_woocommerce_format_price_range($price, $from, $to)
{
	return sprintf(__('From: %s', 'woocommerce'), is_numeric($from) ? wc_price($from) : $from);
}
add_filter('woocommerce_format_price_range', 'asnp_woocommerce_format_price_range', 100, 3);

require get_template_directory() . '/inc/global-vars.php';

// Add shipping class to products admin dashbaord
add_filter('manage_edit-product_columns', 'add_admin_products_shipping_class_column', 999);
function add_admin_products_shipping_class_column($columns)
{
	$columns['shipping_class'] = __('Shipping Class', 'woocommerce');
	return $columns;
}

add_action('manage_product_posts_custom_column', 'get_admin_products_shipping_class_column_content', 10, 2);
function get_admin_products_shipping_class_column_content($column, $product_id)
{
	if ($column === 'shipping_class') {
		global $post, $product;

		if (is_a($product, 'WC_Product')) {
			$shipping_class_id = (int) $product->get_shipping_class_id();
			$shipping_class    = get_term($shipping_class_id, 'product_shipping_class');

			echo ! is_wp_error($shipping_class) ? $shipping_class->name : '<em>n/a</em>';
		}
	}
}

/*
 * Tell WP Super Cache to cache requests with the cookie "wmc_current_currency"
 * separately from other visitors.
 */

// function add_wpsc_curcy_cookie()
// {
// 	do_action('wpsc_add_cookie', 'wmc_current_currency');
// }
// add_action('init', 'add_wpsc_curcy_cookie');

// set default currency
// function get_curcy_default_country()
// {
// 	if (class_exists('WOOCS')) {
// 		global $WOOCS;

// 		// Get user's country based on WooCommerce geolocation
// 		$user_country = WC_Geolocation::geolocate_ip();

// 		if (!empty($user_country['country'])) {
// 			return $user_country['country'] === 'GB' ? 'GBP' : 'USD';
// 		}
// 	}

// 	return 'USD'; // Fallback default country if CURCY fails
// }

// // Example usage: Echoing the detected country
// add_shortcode('curcy_detected_country', function () {
// 	return get_curcy_default_country();
// });


/**
 * @snippet       View Thank You Page @ Edit Order Admin
 * @how-to        businessbloomer.com/woocommerce-customization
 * @author        Rodolfo Melogli, Business Bloomer
 * @compatible    WooCommerce 9
 * @community     https://businessbloomer.com/club/
 */

// add_filter('woocommerce_order_actions', 'bbloomer_show_thank_you_page_order_admin_actions', 9999, 2);

// function bbloomer_show_thank_you_page_order_admin_actions($actions, $order)
// {
// 	if ($order->has_status(wc_get_is_paid_statuses())) {
// 		$actions['view_thankyou'] = 'Display thank you page';
// 	}
// 	return $actions;
// }

// add_action('woocommerce_order_action_view_thankyou', 'bbloomer_redirect_thank_you_page_order_admin_actions');

// function bbloomer_redirect_thank_you_page_order_admin_actions($order)
// {
// 	$url = add_query_arg('adm', $order->get_customer_id(), $order->get_checkout_order_received_url());
// 	wp_safe_redirect($url);
// 	exit;
// }

// add_filter('determine_current_user', 'bbloomer_admin_becomes_user_if_viewing_thank_you_page');

// function bbloomer_admin_becomes_user_if_viewing_thank_you_page($user_id)
// {
// 	if (! empty($_GET['adm'])) {
// 		$user_id = wc_clean(wp_unslash($_GET['adm']));
// 	}
// 	return $user_id;
// }
// add_filter('woocommerce_order_received_verify_known_shoppers', '__return_false');

/**
 * Add current page URL to WPForms entry and email.
 */
// add_action('wpforms_process', function ($fields, $entry, $form_data) {

// 	// Get the current page URL.
// 	$page_url = home_url(add_query_arg([], $_SERVER['REQUEST_URI']));

// 	// Add it to the entry fields.
// 	$fields['page_url'] = [
// 		'name'  => 'Page URL',
// 		'value' => esc_url($page_url),
// 	];

// 	// Save it back to the process data so it's included in emails and entries.
// 	wpforms()->process->fields = $fields;
// }, 10, 3);


function pw_bulk_edit_custom_columns($columns)
{
	$columns[] = array(
		'name' => 'GBP price',
		'type' => 'text',
		'table' => 'meta',
		'field' => '_regular_price_wmcp',
		'visibility' => 'both',
		'readonly' => false,
		'sortable' => 'false'
	);

	$columns[] = array(
		'name' => 'GBP sale price',
		'type' => 'text',
		'table' => 'meta',
		'field' => '_sale_price_wmcp',
		'visibility' => 'both',
		'readonly' => false,
		'sortable' => 'false'
	);

	return $columns;
}
add_filter('pwbe_product_columns', 'pw_bulk_edit_custom_columns');
